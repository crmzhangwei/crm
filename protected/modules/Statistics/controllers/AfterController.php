<?php

class AfterController extends GController { 
    private $pageSize = 10; 
    /**
     * 售后联系量统计报表 
     */
    public function actionYeji() {
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        if (empty($search)) {
            $search['stime'] = '';
            $search['etime'] = '';
        }
        $offset = ($page - 1) * $this->pageSize;
        
        $param = array();
        if (!empty($search['stime']))
            $param['stime'] = $search['stime'];
        if (!empty($search['etime']))
            $param['etime'] = $search['etime'];

        $wherestr = "";
        if (!empty($param['stime'])) {
            $istime = strtotime($param['stime']);
            $wherestr = $wherestr . " and d.dial_time>$istime";
        }
        if (!empty($param['etime'])) {
            $istime = strtotime($param['etime']);
            $wherestr = $wherestr . " and d.dial_time<$ietime";
        }
        $sql = <<<EOF
select d.eno,d.name,d.dial_time,sum(a9) as a9,sum(a10) as a10,sum(a11) as a11,sum(a12) as a12,sum(a13) as a13,sum(a14) as a14 
,sum(a15) as a15,sum(a16) as a16,sum(a17) as a17,sum(a18) as a18,sum(a19) as a19,sum(a20) as a20 
from (
select t.eno,t.name,t.dial_time,
case when t.hr =9 then 1 else 0 end as a9,
case when t.hr=10 then 1 else 0 end as a10,
case when t.hr=11 then 1 else 0 end as a11,
case when t.hr=12 then 1 else 0 end as a12,
case when t.hr = 13 then 1 else 0 end as a13,
case when t.hr = 14 then 1 else 0 end as a14,
case when t.hr = 15 then 1 else 0 end as a15,
case when t.hr = 16 then 1 else 0 end as a16,
case when t.hr = 17 then 1 else 0 end as a17,
case when t.hr = 18 then 1 else 0 end as a18,
case when t.hr = 19 then 1 else 0 end as a19,
case when t.hr = 20 then 1 else 0 end as a20 
from (
SELECT 
    d.eno,
    u.name,
    DATE(FROM_UNIXTIME(d.dial_time)) dial_time,
    HOUR(FROM_UNIXTIME(d.dial_time)) AS hr
FROM
    c_dial_detail d,
    c_users u
WHERE
    d.eno = u.eno 
    $wherestr            
    ) t 
    ) d where 1=1 group by d.eno,d.name,d.dial_time  
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
        $this->render("yeji", $data);
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
    /**
     * 售后新分资源统计报表 
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
        if (!empty($param['stime'])) {
            $istime = strtotime($param['stime']);
            $wherestr = $wherestr . " and t.assign_time>$istime";
        }
        if (!empty($param['etime'])) {
            $istime = strtotime($param['etime']);
            $wherestr = $wherestr . " and t.assign_time<$ietime";
        }
        if (!empty($param['dept'])) { 
            $wherestr = $wherestr . " and t.dept_id=".$param['dept'];
        } 
        $sql = <<<EOF
select d.name as dept_name,sum(a) a,sum(b) b,sum(a0)
a0,sum(a1) a1,sum(a2) a2,sum(a3) a3,sum(a4) a4,sum(a5) a5,sum(a6)
a6,sum(num) total from (
select t.dept_id,t.cust_type_2,
case when t.cust_type_2 = 'N' then 1 else 0 end as a,
case when t.cust_type_2 = 3 or t.cust_type_2=4 or t.cust_type_2=5 then 1 else 0 end as b,
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
    cust_id, 'N' AS cust_type_2, u.name, u.dept_id,a.assign_time  
FROM
    c_aftermarket_cust_info a,
    c_users u
WHERE
    a.eno = u.eno AND cust_type = 0 
UNION ALL SELECT 
    c.cust_id, c.cust_type_2, u.name, u.dept_id ,c.convt_time as assign_time
FROM
    c_cust_convt_detail c,
    c_users u
WHERE
    c.user_id = u.id AND c.lib_type = 3
        AND c.cust_type_1 = 0
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
        $this->render("newResource", $data);
    }
    
    public function actionRenewals(){
        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        if (empty($search)) {
            $search['dept'] = '';
            $search['group'] = '';
        }
        $offset = ($page - 1) * $this->pageSize;
        $param = array();
        if (!empty($search['dept']))
            $param['dept'] = $search['dept'];
        if (!empty($search['group']))
            $param['group'] = $search['group'];

        $wherestr = "";
        if (!empty($param['dept'])) { 
            $wherestr = $wherestr . " and u.dept_id=".$param['dept'];
        }
        if (!empty($param['group'])&&$param['group']!=0) {
            if($param['group']==-1){
                $wherestr = $wherestr . " and u.ismaster=1";
            }else{
                $wherestr = $wherestr . " and u.group_id=".$param['group'];
            } 
        }
        $sql = <<<EOF
SELECT 
    i.cust_name, from_unixtime(d.convt_time) convt_time, c.total_money
FROM
    c_cust_convt_detail d,
    c_contract_info c,
    c_customer_info i,
    c_users u
WHERE
        d.cust_id = c.cust_id
        AND d.cust_id = i.id
        AND i.eno = u.eno      
        AND d.lib_type = 3
        AND d.cust_type_1 = 4
        AND d.cust_type_2 = 3 
        $wherestr
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
        $this->render("renewals", $data);
    }
    public function actionTest(){
        echo date('Y-m-d H:i:s','1434703757');
        echo "<br>";
        echo date('Y-m-d H:i:s','1436357700');
                    
    }
}
