<?php

class TraceController extends GController {

    private $pageSize = 10;
    private $cat34_titles = "序号,组别,合计,0类,1类,2类,3类,4类,5类,6类\n";
    private $cat34_title_keys = array('group_name','total','a0','a1','a2','a3','a4','a5','a6');

    /**
     * 成交师开14,15,17类跟踪分析 
     */
    public function actionTrans() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        if (empty($search)) {
            $search['stime'] = '';
            $search['etime'] = '';
            $search['ctype'] = '14';
            $search['dept'] = '';
            $search['group'] = '';
        }
        $ctype = $search['ctype'];
        $offset = ($page - 1) * $this->pageSize;
        $wherestr = "";
        $priv=UserInfo::getPrivCondiForReport();
         
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and t.convt_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $istime = strtotime($search['etime']);
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
    c_cust_convt_detail c,
    c_users u 
WHERE
    c.user_id = u.id AND c.lib_type = 2
        AND  c.cust_type_2 =$ctype $priv
union all 
SELECT 
     distinct c.cust_id,'N' cust_type_1,cust_type_2, u.name, u.dept_id,u.group_id, c.convt_time,u.eno
FROM
    c_cust_convt_detail c,
    c_users u 
WHERE
    c.user_id = u.id AND c.lib_type = 2
        AND  c.cust_type_2 =17  $priv       
        
        ) t where 1=1 $wherestr
) tb where 1=1 group by  tb.name
EOF;

        $result1 = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result1->rowCount);

        //获取查询的条数
        $pages->pageSize = $this->pageSize;
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $offset);
        $result->bindValue(':limit', $pages->pageSize);
        $res = $result->queryAll();

        $data = array(
            'pages' => $pages,
            'total' => $result1->rowCount,
            'list' => $res,
            'search' => $search,
        );
        $this->render("trans", $data);
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
        if (empty($search)) {
            $search['stime'] = '';
            $search['etime'] = '';
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
        $priv=UserInfo::getPrivCondiForReport();
        if (!empty($param['stime'])) {
            $istime = strtotime($param['stime']);
            $wherestr = $wherestr . " and t.assign_time>$istime";
        }
        if (!empty($param['etime'])) {
            $istime = strtotime($param['etime']);
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
    c_customer_info a,
    c_users u
WHERE
    a.eno = u.eno AND cust_type = 0 $priv
UNION ALL SELECT 
     c.cust_type_2, u.name, u.dept_id ,c.convt_time as assign_time
FROM
    c_cust_convt_detail c,
    c_users u
WHERE
    c.user_id = u.id AND c.lib_type = 1
        AND c.cust_type_1 = 0 $priv
) t where 1=1 $wherestr
) tb,c_dept_info d where tb.dept_id=d.id group by d.name
EOF;
        $criteria = new CDbCriteria();
        $result1 = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result1->rowCount);

        //获取查询的条数
        $pages->pageSize = $this->pageSize;
        $pages->applyLimit($criteria);
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
        $this->render("newresource", $data);
    }

    /**
     * 开3，开4跟踪分析
     */
    public function actionCat34() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $isexcel = Yii::app()->request->getParam("isexcel");

        if (empty($search)) {
            $search['stime'] = '';
            $search['etime'] = '';
            $search['ctype'] = '3';
            $search['dept'] = '';
            $search['group'] = '';
        }
        $ctype = $search['ctype'];
        $offset = ($page - 1) * $this->pageSize;
        $wherestr = "";
        $priv=UserInfo::getPrivCondiForReport();
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and t.convt_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $istime = strtotime($search['etime']);
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
            echo iconv('utf-8','gb2312',$this->cat34_titles);
            $c=1;
            foreach($res as $record){
                echo $c.",".iconv('utf-8','gb2312',Utils::array_to_string($this->cat34_title_keys,$record));
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
        $priv=UserInfo::getPrivCondiForReport();
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
    c_customer_info c,
    c_users u
WHERE
    c.eno = u.eno $priv
) t where 1=1 $wherestr

) tb where 1=1 group by tb.next_time  
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
        $data = array(
            'list' => $res,
            'search' => $search,
            'days' => $days
        );
        $this->render("timeanalyse", $data);
    }

    /**
     * 话务员工作统计
     */
    public function actionWorkanalyse() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        if (empty($search)) {
            $search['stime'] = '';
            $search['etime'] = '';
            $search['dept'] = '';
            $search['group'] = '';
        }
        $offset = ($page - 1) * $this->pageSize;
        $priv=UserInfo::getPrivCondiForReport();
        
        $wherestr = "";
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and t.dial_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $istime = strtotime($search['etime']);
            $wherestr = $wherestr . " and t.dial_time<=$ietime";
        }
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and t.dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and t.group_id=" . $search['group'];
        }
        $sql = <<<EOF
SELECT 
    t.eno,
    t.name,
    FROM_UNIXTIME(t.dial_time, '%Y-%m-%d') AS dial_time,
    COUNT(*) AS dial_num,
    SUM(t.dial_long) AS dial_long,
    FROM_UNIXTIME(MIN(t.dial_time), '%Y-%m-%d') AS min_time
FROM
    (SELECT 
        u.eno,
            u.name,
            u.dept_id,
            u.group_id,
            d.dial_time,
            d.dial_long
    FROM
        crm.c_dial_detail d, c_users u
    WHERE
        d.eno = u.eno $priv ) t
WHERE
    1 = 1 $wherestr
GROUP BY t.eno , t.name
EOF;

        $result1 = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result1->rowCount);

        //获取查询的条数
        $pages->pageSize = $this->pageSize;
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $offset);
        $result->bindValue(':limit', $pages->pageSize);
        $res = $result->queryAll();

        $data = array(
            'pages' => $pages,
            'total' => $result1->rowCount,
            'list' => $res,
            'search' => $search,
        );
        $this->render("workanalyse", $data);
    }

    public function actionTest() {
        echo date('Y-m-d H:i:s', '1434703757');
        echo "<br>";
        echo date('Y-m-d H:i:s', '1436357700');
    }

}
