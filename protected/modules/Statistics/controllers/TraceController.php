<?php

class TraceController extends GController {

    private $pageSize = 10;
    private $cat34_titles = "序号,组别,合计,0类,1类,2类,3类,4类,5类,6类\n";
    private $cat34_title_keys = array('group_name','total','a0','a1','a2','a3','a4','a5','a6');
    private $timeanalyse_titles = "序号,下次联系时间,0类,1类,2类,3类,4类,5类,6类,7类,8类,9类\n";
    private $timeanalyse_title_keys = array('next_time','a0','a1','a2','a3','a4','a5','a6','a7','a8','a9');
    private $trans_titles = "序号,成交师,合计,10类,11类,12类,13类,14类,15类,16类,17类,17类%\n";
    private $trans_title_keys = array('name','total','a10','a11','a12','a13','a14','a15','a16','a17','total17');
    private $workanalyse_titles = "序号,日期,工号,姓名,呼出次数,呼出时长,首次通话时间\n";
    private $workanalyse_title_keys = array('dial_time','eno','name','dial_num','dial_long','min_time');
    private $newresource_titles = "序号,部门,合计,未处理的分类,未处理的分类%,3/4/5类,3/4/5类%,10类,10类%,0类,0类%,1类,1类%,2类,2类%,3类,3类%,4类,4类%,5类,5类%,6类,6类%\n";
    private $newresource_title_keys = array('dept_name','total','a','at','b','bt','c','ct','a0','a0t','a1','a1t','a2','a2t','a3','a3t','a4','a4t','a5','a5t','a6','a6t');

    /**
     * 成交师开14,15,17类跟踪分析 
     */
    public function actionTrans() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");
        if (empty($search)) {
            $curdate = date("Y-m-d");
            $search['stime'] = $curdate." 00:00:00";
            $search['etime'] = $curdate." 23:59:59";
            $search['ctype'] = '14';
            $search['dept'] = '';
            $search['group'] = '';
        }
        $ctype = $search['ctype'];
        $offset = ($page - 1) * $this->pageSize;
        $wherestr = "";
        $priv=Userinfo::getPrivCondiForReport();
         
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and t.convt_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $ietime = strtotime($search['etime']);
            $wherestr = $wherestr . " and t.convt_time<=$ietime";
        }
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and t.dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and t.group_id=" . $search['group'];
        }
        $sql = <<<EOF
select tb.name,sum(a10) a10,sum(a11) a11,sum(a12) a12,sum(a13) a13,sum(a14) a14,sum(a15) a15,sum(a16) a16,sum(a17) a17,sum(num) as total, (select count(*) from c_trans_cust_info where eno=tb.eno and cust_type=17) as total17 from ( 
select t.name,t.eno, 
case when cust_type_1=10 then 1 else 0 end as a10,
case when cust_type_1=11 then 1 else 0 end as a11,
case when cust_type_1=12 then 1 else 0 end as a12,
case when cust_type_1=13 or cust_type_2 = 13 then 1 else 0 end as a13,
case when cust_type_1=14 or cust_type_2 = 14 then 1 else 0 end as a14,
case when cust_type_1=15 or cust_type_2 = 15 then 1 else 0 end as a15,
case when cust_type_1=16 then 1 else 0 end as a16 ,
case when cust_type_1='N' then 1 else 0 end as a17,
  case when cust_type_1<>'N' then 1 else 0 end as num
   from (
SELECT 
    distinct c.cust_id, c.cust_type_1,cust_type_2, u.name, u.dept_id,u.group_id, c.convt_time,u.eno
FROM
    c_cust_convt_detail c left join c_users u on c.user_id = u.id 
WHERE  c.lib_type = 2
        AND  c.cust_type_2 =$ctype $priv
union all 
SELECT 
     distinct c.cust_id,'N' cust_type_1,cust_type_2, u.name, u.dept_id,u.group_id, c.convt_time,u.eno
FROM
    c_cust_convt_detail c left join c_users u on c.user_id = u.id  
WHERE
        c.lib_type = 2
        AND  c.cust_type_2 =17  $priv       
        
        ) t where 1=1 $wherestr
) tb where 1=1 group by  tb.name
EOF;

        $cnt = 0;
        $result1 = Yii::app()->db->createCommand("select count(*) as cnt from ($sql) tmp")->queryRow(true);
        if($result1&&  is_array($result1)){
            $cnt = $result1['cnt'];
        }
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "成交师开14-15-17类跟踪分析.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','GBK',$this->trans_titles);
            $c=1;
            foreach($res as $record){
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($this->trans_title_keys,$this->calTransRecord($record)));
                $c++;
            } 
        } else {
            $pages = new CPagination($cnt);
            //获取查询的条数
            $pages->pageSize = $this->pageSize;
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $offset);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll();

            $data = array(
                'pages' => $pages,
                'total' => $cnt,
                'list' => $res,
                'search' => $search,
            );
            $this->render("trans", $data);
        }
    }
    private function calTransRecord($v){
        $newRecord = $v;
        $newRecord['total17']=$v['total17']==0?'0%':number_format(100*$v['a17']/$v['total17'],2).'%';
        return $newRecord;
    }

    /**
     * 获取部门数组 
     */
    public function getDeptArr() {
        $deptarr = DeptInfo::model()->findAll();
        $dept_empty = new DeptInfo();
        $dept_empty->id = "";
        $dept_empty->name = '--请选择部门--';
        $deptarr = array_merge(array($dept_empty), $deptarr);
        return CHtml::listData($deptarr, "id", "name");
    }

    public function getGroupArr($deptid) {
        $sql = "select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
        $grouparr = DeptGroup::model()->findAllBySql($sql, array(':dept_id' => $deptid));
        $group_empty = new DeptGroup();
        $group_empty->group_id = 0;
        $group_empty->group_name = '--请选择组别--';
        $grouparr = array_merge(array($group_empty), $grouparr);
        return CHtml::listData($grouparr, 'group_id', 'group_name');
    }

    /**
     * 新分资源跟踪报表 
     */
    public function actionNewResource() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");
        if (empty($search)) {
            $curdate = date("Y-m-d");
            $search['stime'] = $curdate." 00:00:00";
            $search['etime'] = $curdate." 23:59:59";
            $search['dept'] = '';
        }
        $offset = ($page - 1) * $this->pageSize;
        $param = array();
        if (!empty($search['stime']))
            $param['stime'] = $search['stime'];
        if (!empty($search['etime']))
            $param['etime'] = $search['etime'];
        if (!empty($search['dept']))
            $param['dept'] = $search['dept'];
        $wherestr = "";
        $priv=Userinfo::getPrivCondiForReport();
        if (!empty($param['stime'])) {
            $istime = strtotime($param['stime']);
            $wherestr = $wherestr . " and t.assign_time>$istime";
        }
        if (!empty($param['etime'])) {
            $ietime = strtotime($param['etime']);
            $wherestr = $wherestr . " and t.assign_time<$ietime";
        }
        if (!empty($param['dept'])) {
            $wherestr = $wherestr . " and t.dept_id=" . $param['dept'];
        }
        $sql = <<<EOF
select d.name as dept_name,sum(a) a,sum(b) b,sum(c) c,sum(a0)
a0,sum(a1) a1,sum(a2) a2,sum(a3) a3,sum(a4) a4,sum(a5) a5,sum(a6)
a6,sum(num) total from (
select t.dept_id,t.cust_type_2,
case when t.cust_type_2 = 'N' then 1 else 0 end as a,
case when t.cust_type_2 = 3 or t.cust_type_2=4 or t.cust_type_2=5 then 1 else 0 end as b,
case when t.cust_type_2 = 10 then 1 else 0 end as c,
case when t.cust_type_2 = '0' then 1 else 0 end as a0,
case when t.cust_type_2 = 1  then 1 else 0 end as a1,
case when t.cust_type_2 = 2  then 1 else 0 end as a2,
case when t.cust_type_2 = 3  then 1 else 0 end as a3,
case when t.cust_type_2 = 4  then 1 else 0 end as a4,
case when t.cust_type_2 = 5  then 1 else 0 end as a5,
case when t.cust_type_2 = 6  then 1 else 0 end as a6,
1 as num 
from ( 
SELECT 
     'N' AS cust_type_2, u.name, u.dept_id,a.assign_time  
FROM
    c_customer_info a left join c_users u on a.eno = u.eno
    
WHERE
    1=1 AND cust_type = 0 $priv
UNION ALL SELECT 
     c.cust_type_2, u.name, u.dept_id ,c.convt_time as assign_time
FROM
    c_cust_convt_detail c left join c_users u on c.user_id = u.id
    
WHERE
    1=1 AND c.lib_type = 1
        AND c.cust_type_1 = 0 $priv
) t where 1=1 $wherestr
) tb,c_dept_info d where tb.dept_id=d.id group by d.name
EOF;
        $criteria = new CDbCriteria();
        $result1 = Yii::app()->db->createCommand("select count(*) as cnt from ($sql) tmp")->queryRow(true);
        if($result1&&  is_array($result1)){
            $cnt = $result1['cnt'];
        }
        
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "新分资源分析.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','GBK',$this->newresource_titles);
            $c=1;
            foreach($res as $record){
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($this->newresource_title_keys,$this->calNewResourceRecord($record)));
                $c++;
            } 
        } else { 
            //获取查询的条数
            $pages = new CPagination($cnt);
            $pages->params = $param;
            $pages->pageSize = $this->pageSize;
            $pages->applyLimit($criteria);
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll(); 
            $data = array(
                'pages' => $pages,
                'total' => $cnt,
                'list' =>  $res,
                'search' => $search,
            );
            $this->render("newresource", $data);
        }
    }
    private function calNewResourceRecord($v){
        $newRecord = $v;
        $newRecord['at']=$v['total']==0?'0%':number_format(100*$v['a']/$v['total'],2).'%';
        $newRecord['bt']=$v['total']==0?'0%':number_format(100*$v['b']/$v['total'],2).'%';
        $newRecord['ct']=$v['total']==0?'0%':number_format(100*$v['c']/$v['total'],2).'%';
        $newRecord['a0t']=$v['total']==0?'0%':number_format(100*$v['a0']/$v['total'],2).'%';
        $newRecord['a1t']=$v['total']==0?'0%':number_format(100*$v['a1']/$v['total'],2).'%';
        $newRecord['a2t']=$v['total']==0?'0%':number_format(100*$v['a2']/$v['total'],2).'%';
        $newRecord['a3t']=$v['total']==0?'0%':number_format(100*$v['a3']/$v['total'],2).'%';
        $newRecord['a4t']=$v['total']==0?'0%':number_format(100*$v['a4']/$v['total'],2).'%';
        $newRecord['a5t']=$v['total']==0?'0%':number_format(100*$v['a5']/$v['total'],2).'%';
        $newRecord['a6t']=$v['total']==0?'0%':number_format(100*$v['a6']/$v['total'],2).'%'; 
        return $newRecord;
    }
    /**
     * 开3，开4跟踪分析
     */
    public function actionCat34() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");

        if (empty($search)) {
            $curdate = date("Y-m-d");
            $search['stime'] = $curdate." 00:00:00";
            $search['etime'] = $curdate." 23:59:59";
            $search['ctype'] = '3';
            $search['dept'] = '';
            $search['group'] = '';
        }
        $ctype = $search['ctype'];
        $offset = ($page - 1) * $this->pageSize;
        $wherestr = "";
        $priv=Userinfo::getPrivCondiForReport();
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and t.convt_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $ietime = strtotime($search['etime']);
            $wherestr = $wherestr . " and t.convt_time<=$ietime";
        }
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and t.dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and t.group_id=" . $search['group'];
        }
        $sql = <<<EOF
select tb.group_name,sum(a0) as a0,sum(a1) as a1,sum(a2) as a2,sum(a3) as a3,sum(a4) as a4,sum(a5) as a5,sum(a6) as a6,sum(num) as total from (
select t.group_name,
case when t.cust_type_1 = 0 then 1 else 0 end as a0,
case when t.cust_type_1 = 1 then 1 else 0 end as a1,
case when t.cust_type_1 = 2 then 1 else 0 end as a2,
case when t.cust_type_1 = 3 or t.cust_type_2 = 3 then 1 else 0 end as a3,
case when t.cust_type_1 = 4 or t.cust_type_2 = 4 then 1 else 0 end as a4,
case when t.cust_type_1 = 5 then 1 else 0 end as a5,
case when t.cust_type_1 = 6 then 1 else 0 end as a6,
1 as num from (
SELECT DISTINCT
    c.cust_id,
    c.cust_type_1, 
    c.cust_type_2,
    c.convt_time,
    u.dept_id,
    u.group_id,
    g.name AS group_name
FROM
    c_cust_convt_detail c,
    c_users u,
    c_group_info g
WHERE
    c.user_id = u.id AND u.group_id = g.id
        AND c.cust_type_2 = $ctype
        AND c.lib_type = 1 $priv
) t where 1=1 $wherestr
) tb where 1=1 group by tb.group_name
EOF;
        $criteria = new CDbCriteria();
        $result1 = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result1->rowCount);

        //获取查询的条数
        $pages->pageSize = $this->pageSize;
        $pages->applyLimit($criteria);
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "开3-开4跟踪分析.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','GBK',$this->cat34_titles);
            $c=1;
            foreach($res as $record){
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($this->cat34_title_keys,$record));
                $c++;
            } 
        } else {
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll();
            $data = array(
                'pages' => $pages,
                'total' => $result1->rowCount,
                'list' => $res,
                'search' => $search,
            );
            $this->render("cat34", $data);
        }
    }

    /**
     * 安排时间分布
     */
    public function actionTimeanalyse() {
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");
        if (empty($search)) {
            $search['dept'] = '';
            $search['group'] = '';
        }
        $wherestr = "";
        $curTime = date('Y-m-d');
        $BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
        $endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
        $stime = strtotime($curTime);
        $etime = strtotime($endDate);
        $priv=Userinfo::getPrivCondiForReport();
        $wherestr = $wherestr . " and next_time>=$stime";
        $wherestr = $wherestr . " and next_time<=$etime";
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and group_id=" . $search['group'];
        }
        $sql = <<<EOF
select from_unixtime(tb.next_time,'%Y-%m-%d') as next_time,sum(a0) as a0,sum(a1) as a1,sum(a2) as a2,sum(a3) as a3,sum(a4) as a4,sum(a5) as a5,sum(a6) as a6
,sum(a7) as a7,sum(a8) as a8,sum(a9) as a9,sum(num) as total from (
select t.next_time,
case when t.cust_type=0 then 1 else 0 end as a0,
case when t.cust_type=1 then 1 else 0 end as a1,
case when t.cust_type=2 then 1 else 0 end as a2,
case when t.cust_type=3 then 1 else 0 end as a3,
case when t.cust_type=4 then 1 else 0 end as a4,
case when t.cust_type=5 then 1 else 0 end as a5,
case when t.cust_type=6 then 1 else 0 end as a6,
case when t.cust_type=7 then 1 else 0 end as a7,
case when t.cust_type=8 then 1 else 0 end as a8,
case when t.cust_type=9 then 1 else 0 end as a9,
1 as num from(
SELECT 
    c.next_time, c.cust_type, u.dept_id, u.group_id 
FROM
    c_customer_info c left join c_users u on c.eno=u.eno  
WHERE
    1=1 $priv
) t where 1=1 $wherestr

) tb where 1=1 group by FROM_UNIXTIME(tb.next_time, '%Y-%m-%d')
union all 
select '各成熟度资源占比' as next_time, (select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=0 $priv $wherestr) as a0,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=1 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=2 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=3 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=4 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=5 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=6 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=7 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=8 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=9 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno $priv $wherestr) as total
from c_customer_info where id =1 
union all 
select '各成熟度人均库存' as next_time, (select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=0 $wherestr) as a0,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=1 $priv $wherestr) as a1,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=2 $priv $wherestr) as a2,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=3 $priv $wherestr) as a3,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=4 $priv $wherestr) as a4,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=5 $priv $wherestr) as a5,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=6 $priv $wherestr) as a6,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=7 $priv $wherestr) as a7,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=8 $priv $wherestr) as a8,
(select count(*) from c_customer_info c,c_users u where c.eno=u.eno and c.cust_type=9 $priv $wherestr) as a9,
1 as total
from c_customer_info where id =1
EOF;


        $result = Yii::app()->db->createCommand($sql);
        $res = $result->queryAll();
        $days = count($res);
        if ($isexcel) { 
            $filename = "安排时间分布.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','GBK',$this->timeanalyse_titles);
            $c=1;
            foreach($res as $record){
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($this->timeanalyse_title_keys,$this->calRecordForTimeAnalyse($record,$days)));
                $c++;
            } 
        } else {
            $data = array(
                'list' => $res,
                'search' => $search,
                'days' => $days
            );
            $this->render("timeanalyse", $data);
        }
    }
    private function calRecordForTimeAnalyse($v,$days){
        $newRecord = $v;
        if($v['next_time']=='各成熟度资源占比'){
            $newRecord['a0']=number_format($v['total']==0?'0':100*$v['a0']/$v['total'],2)."%";
            $newRecord['a1']=number_format($v['total']==0?'0':100*$v['a1']/$v['total'],2)."%";
            $newRecord['a2']=number_format($v['total']==0?'0':100*$v['a2']/$v['total'],2)."%";
            $newRecord['a3']=number_format($v['total']==0?'0':100*$v['a3']/$v['total'],2)."%";
            $newRecord['a4']=number_format($v['total']==0?'0':100*$v['a4']/$v['total'],2)."%";
            $newRecord['a5']=number_format($v['total']==0?'0':100*$v['a5']/$v['total'],2)."%";
            $newRecord['a6']=number_format($v['total']==0?'0':100*$v['a6']/$v['total'],2)."%";
            $newRecord['a7']=number_format($v['total']==0?'0':100*$v['a7']/$v['total'],2)."%";
            $newRecord['a8']=number_format($v['total']==0?'0':100*$v['a8']/$v['total'],2)."%";
            $newRecord['a9']=number_format($v['total']==0?'0':100*$v['a9']/$v['total'],2)."%";
        }else if($v['next_time']=='各成熟度人均库存'){
            $newRecord['a0']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a1']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a2']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a3']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a4']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a5']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a6']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a7']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a8']=number_format($days==0?"0":$v['a0']/$days,2);
            $newRecord['a9']=number_format($days==0?"0":$v['a0']/$days,2);
        } 
        return $newRecord;
    }

    /**
     * 话务员工作统计
     */
    public function actionWorkanalyse() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");
        $param = array();
        if (empty($search)) {
            $curdate = date("Y-m-d");
            $search['stime'] = $curdate." 00:00:00";
            $search['etime'] = $curdate." 23:59:59";
            $search['dept'] = '';
            $search['group'] = '';
			$search['mintimes'] = '';
			$search['maxtimes'] = '';
        }else{
            $param["search[stime]"]=$search['stime'];
            $param["search[etime]"]=$search['etime'];
            $param["search[dept]"]=$search['dept'];
            $param["search[group]"]=$search['group'];
            $param["search[mintimes]"]=$search['mintimes'];
            $param["search[maxtimes]"]=$search['maxtimes'];
        }
        $offset = ($page - 1) * $this->pageSize;
        $priv=Userinfo::getPrivCondiForReport();
        
        $wherestr = "";
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and d.dial_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $ietime = strtotime($search['etime']);
            $wherestr = $wherestr . " and d.dial_time<=$ietime";
        }
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and u.dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and u.group_id=" . $search['group'];
        }
		if (!empty($search['mintimes'])) {
            $wherestr = $wherestr . " and d.dial_long>={$search['mintimes']}";
        }
		if (!empty($search['maxtimes'])) {
            $wherestr = $wherestr . " and d.dial_long<={$search['maxtimes']}";
        }
		
        $sql = <<<EOF
SELECT 
    t.eno,
    t.name,
    FROM_UNIXTIME(t.dial_time, '%Y-%m-%d %H:%i:%s') AS dial_time,
    COUNT(*) AS dial_num,
    SUM(t.dial_long) AS dial_long,
    FROM_UNIXTIME(MIN(t.dial_time), '%Y-%m-%d %H:%i:%s') AS min_time
FROM
    (SELECT 
        d.userid,
            u.name,
            u.eno,
            u.dept_id,
            u.group_id,
            d.dial_time,
            d.dial_long
    FROM
        crm.c_dial_detail_p d left join c_users u on d.userid = u.id
    WHERE
        1=1 and d.userid>0 $wherestr $priv ) t
WHERE
    1 = 1 
GROUP BY t.eno , t.name
EOF;
        
        $cnt=0;
        $result1 = Yii::app()->db->createCommand("select count(*) as cnt from ($sql) tmp")->queryRow(true);
        if($result1&&  is_array($result1)){
            $cnt=$result1['cnt'];
        }
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "话务员工作统计.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','GBK',$this->workanalyse_titles);
            $c=1;
            foreach($res as $record){
                $record['dial_long']=  gmstrftime('%H:%M:%S',$record['dial_long']);
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($this->workanalyse_title_keys,$record));
                $c++;
            } 
        } else {
            $pages = new CPagination($cnt);
            $pages->params = $param;
            //获取查询的条数
            $pages->pageSize = $this->pageSize;
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $offset);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll();

            $data = array(
                'pages' => $pages,
                'total' => $cnt,
                'list' => $res,
                'search' => $search,
            );
            $this->render("workanalyse", $data);
        }
    }

    public function actionTest() {
        echo date('Y-m-d H:i:s', '1434703757');
        echo "<br>";
        echo date('Y-m-d H:i:s', '1436357700');
    }

}
