<?php

class CountController extends GController {

    private $pageSize = 10;
    private $yeji_0_titles = "排名,部门,组别,员工,金额,到单数\n";
    private $yeji_0_title_keys = array('dept_name', 'group_name','user_name', 'acct_amount', 'acct_number');
    private $yeji_1_titles = "排名,部门,组别,金额,到单数\n";
    private $yeji_1_title_keys = array('dept_name', 'group_name', 'acct_amount', 'acct_number');
    private $yeji_2_titles = "排名,部门,金额,到单数\n";
    private $yeji_2_title_keys = array('dept_name', 'acct_amount', 'acct_number');
    private $contact_0_titles = "排名,部门,组别,员工,合计,9至10,10至11,11至12,12至13,13至14,14至15,15至16,16至17,17至18,18至19,19至20,20至21\n"; 
    private $contact_0_title_keys = array('dept_name', 'group_name','user_name', 'total','c9','c10','c11','c12','c13','c14','c15','c16','c17','c18','c19','c20');
    private $contact_1_titles = "排名,部门,组别,合计,9至10,10至11,11至12,12至13,13至14,14至15,15至16,16至17,17至18,18至19,19至20,20至21\n"; 
    private $contact_1_title_keys = array('dept_name', 'group_name', 'total','c9','c10','c11','c12','c13','c14','c15','c16','c17','c18','c19','c20');
    private $contact_2_titles = "排名,部门,合计,9至10,10至11,11至12,12至13,13至14,14至15,15至16,16至17,17至18,18至19,19至20,20至21\n"; 
    private $contact_2_title_keys = array('dept_name', 'total','c9','c10','c11','c12','c13','c14','c15','c16','c17','c18','c19','c20');

    public function actionIndex() {

        $page = max(Yii::app()->request->getParam('page'), 1);
        $search = Yii::app()->request->getParam("search");
        $offset = ($page - 1) * $this->pageSize;
        $param = array();
//                if(!empty($search['dept_id'])) $param['dept_id'] = intval($search['dept_id']);  //部门
//                if(!empty($search['group_id'])) $param['group_id'] = intval($search['group_id']);  //组别
//                if(!empty($search['eno'])) $param['eno'] = $search['eno'];
//                if(!empty($search['end_time'])) $param['end_time'] = intval($search['end_time']);
//                if(!empty($search['begin_time'])) $param['begin_time'] = intval($search['begin_time']);


        /*    SELECT
          COUNT(DISTINCT user_id) user_count,
          FROM_UNIXTIME(
          create_time,
          '%Y-%m-%d %H:00:00'
          ) AS hours,
          CONCAT(FROM_UNIXTIME(create_time, '%Y-%m-%d %H:00'),'-',FROM_UNIXTIME(create_time, '%H')+1,":00") AS `date`
          FROM
          tb_user_online_log
          GROUP BY
          hours
          ORDER BY create_time */



        //这一部分获取总记录行
        $sql = "select id,dial_time as d,dial_long as l from {{dial_detail}} where 1";
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
            'crmlist' => $res,
            'search' => $search,
        );
        $this->render("index", $data);
    }

    public function actionYeji() {
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
            $search['user'] = ''; 
            $search['cust_name'] = ''; 
            $search['phone'] = ''; 
            $search['finace_type'] = ''; 
        } else {
            $param["search[stime]"] = $search['stime'];
            $param["search[etime]"] = $search['etime'];
            $param["search[dept]"] = $search['dept'];
            $param["search[group]"] = $search['group'];
            $param["search[user]"] = $search['user']; 
            $param["search[cust_name]"] = $search['cust_name']; 
            $param["search[phone]"] = $search['phone']; 
            $param["search[finace_type]"] = $search['finace_type']; 
        }
        $offset = ($page - 1) * $this->pageSize;
        $priv = Userinfo::getPrivCondiForReport();

        $wherestr = "";
        $timestr="";
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $timestr = $timestr . " and f.acct_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $ietime = strtotime($search['etime']);
            $timestr = $timestr . " and f.acct_time<=$ietime";
        }
        if (!empty($search['finace_type'])) {  
            $timestr = $timestr . " and f.finance_type=".$search['finace_type'];
        }
        if (!empty($search['cust_name'])) { 
            $cust_name=trim($search['cust_name']);
            $wherestr = $wherestr . " and c.cust_name like '%$cust_name%'";
        }
        if (!empty($search['phone'])) { 
            $phone=trim($search['phone']);
            $wherestr = $wherestr . " and c.phone like '%$phone%'";
        }
        
        if (!empty($search['dept'])) {
            $wherestr = $wherestr." and d.id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and g.id=" . $search['group'];
        }
        if (!empty($search['user'])) {
            $wherestr = $wherestr . " and u.eno='" . $search['user']."'";
        }  
        $columns="t1.dept_name,t1.group_name,t1.user_name";
        $titles=$this->yeji_0_titles;
        $title_keys=$this->yeji_0_title_keys;
        if(!empty($search['user'])){
            $columns="t1.dept_name,t1.group_name,t1.user_name";
            $titles=$this->yeji_0_titles;
            $title_keys=$this->yeji_0_title_keys;
        }else if(!empty($search['group'])){
            $columns="t1.dept_name,t1.group_name,t1.user_name";
            $titles=$this->yeji_0_titles;
            $title_keys=$this->yeji_0_title_keys;
        }else if(!empty($search['dept'])){
            $columns="t1.dept_name,t1.group_name";
            $titles=$this->yeji_1_titles;
            $title_keys=$this->yeji_1_title_keys;
        } 
        $sql = <<<EOF
 select $columns,sum(t1.acct_number) as acct_number,sum(t1.acct_amount) as acct_amount from (
 SELECT 
    u.name AS user_name,
    d.name AS dept_name,
    g.name AS group_name,
    IFNULL(t.acct_number, 0) AS acct_number,
    IFNULL(t.acct_amount, 0) AS acct_amount
FROM
    (SELECT 
        f.cust_id,
        f.sale_user,
            IFNULL(f.acct_number, 0) acct_number,
            IFNULL(f.acct_amount, 0) acct_amount,
            IFNULL(f.acct_time, 0) acct_time
    FROM
        c_finance f
    LEFT JOIN c_users u ON f.sale_user = u.id 
    WHERE
        1 = 1 and u.status=1 $timestr
            AND (u.id IN (18 , 20, 21, 22, 23, 30, 34, 35, 36, 37, 38, 39, 40, 41, 42, 24, 25, 48, 69, 19))) t
        left join c_customer_info c on t.cust_id=c.id
        RIGHT JOIN
    c_users u ON t.sale_user = u.id
        RIGHT JOIN
    c_dept_group dg ON u.dept_id = dg.dept_id
        AND u.group_id = dg.group_id
        LEFT JOIN
    c_dept_info d ON dg.dept_id = d.id
        LEFT JOIN
    c_group_info g ON dg.group_id = g.id
WHERE
    1=1 and u.status=1 $wherestr
    ) t1 where 1=1 group by $columns order by acct_amount desc
EOF;
    
         $cnt = 0;
        $result1 = Yii::app()->db->createCommand("select count(*) as cnt from ($sql) tmp")->queryRow(true);
        if ($result1 && is_array($result1)) {
            $cnt = $result1['cnt'];
        }
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "业绩报表.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename);
            echo iconv('utf-8', 'GBK', $titles);
            $c = 1;
            
            foreach ($res as $record) {
                echo $c . "," . iconv('utf-8', 'GBK', Utils::array_to_string($title_keys, $record));
                $c++;
            }
        } else {
            $pages = new CPagination($cnt);
            $pages->params = $param;
            //获取查询的条数
            $pages->pageSize = $this->pageSize;
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll();

            $data = array(
                'pages' => $pages,
                'total' => $cnt,
                'list' => $res,
                'search' => $search,
            );
            $this->render("yeji", $data);
        } 
    }

    public function actionYeji_old() {
        //$page = max(Yii::app()->request->getParam('page'), 1);
        //$offset = ($page-1)*$this->pageSize;
        $isexcel = Yii::app()->request->getParam("isexcel");
        $search = Yii::app()->request->getParam("search");
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[] = Yii::app()->user->id;
        $userid = implode(',', $user_arr);
        if ($search) {
            $where = Utils::addWhere($search);
            $where = $where . " and u.id in($userid)";
        } else {
            $where = " where u.id in($userid)";
        }

        $sql = "select d.name as dname,g.name as gname, u.name as uname, acct_amount as amount,acct_number as number "
                . "from {{finance}} as f "
                . "left join {{users}} as u on f.sale_user=u.id "
                . "left join {{dept_info}} as d on u.dept_id=d.id "
                . "left join {{group_info}} as g on u.group_id=g.id $where";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $total = 0;
        $resArr = array();
        if ($result) {
            if ($search['dept'] && $search['group'] && $search['users']) {
                $dgUser = array();
                foreach ($result as $k => $v) {
                    $dgUser[] = $v['dname'] . $v['gname'] . $v['uname'];
                }
                $dgUser = array_unique($dgUser);

                foreach ($dgUser as $k1 => $v1) {
                    $resArr[$v1]['amount'] = 0;
                    $resArr[$v1]['number'] = 0;
                    foreach ($result as $k2 => $v2) {
                        $str = $v2['dname'] . $v2['gname'] . $v2['uname'];
                        if ($str === $v1) {
                            $resArr[$v1]['dname'] = $v2['dname'];
                            $resArr[$v1]['gname'] = $v2['gname'];
                            $resArr[$v1]['uname'] = $v2['uname'];
                            $resArr[$v1]['amount'] += $v2['amount'];
                            $resArr[$v1]['number'] += $v2['number'];
                        }
                    }
                }
                $total = count($resArr);
            } elseif ($search['dept'] && $search['group']) {
                $dgroup = array();
                foreach ($result as $k => $v) {
                    $dgroup[] = $v['dname'] . $v['gname'];
                }
                $dgroup = array_unique($dgroup);

                foreach ($dgroup as $k1 => $v1) {
                    $resArr[$v1]['amount'] = 0;
                    $resArr[$v1]['number'] = 0;
                    foreach ($result as $k2 => $v2) {
                        $str = $v2['dname'] . $v2['gname'];
                        if ($str === $v1) {
                            $resArr[$v1]['dname'] = $v2['dname'];
                            $resArr[$v1]['gname'] = $v2['gname'];
                            $resArr[$v1]['amount'] += $v2['amount'];
                            $resArr[$v1]['number'] += $v2['number'];
                        }
                    }
                }

                $total = count($resArr);
            } else {
                $depts = array();
                foreach ($result as $k => $v) {
                    $depts[] = $v['dname'] . $v['gname'];
                }
                $depts = array_unique($depts);
                foreach ($depts as $k1 => $v1) {
                    $resArr[$v1]['amount'] = 0;
                    $resArr[$v1]['number'] = 0;
                    foreach ($result as $k2 => $v2) {
                        $str = $v2['dname'] . $v2['gname'];
                        if ($str === $v1) {
                            $resArr[$v1]['dname'] = $v2['dname'];
                            $resArr[$v1]['gname'] = $v2['gname'];
                            $resArr[$v1]['amount'] += $v2['amount'];
                            $resArr[$v1]['number'] += $v2['number'];
                        }
                    }
                }
                $total = count($resArr);
            }
        }

        if ($resArr) {
            $amount = array();
            foreach ($resArr as $k => $v) {
                $amount[] = $v['amount'];
            }
            array_multisort($amount, SORT_DESC, $resArr);
        }

        //部门组别人员三级联动
        $uInfo = Userinfo::secondlevel();
        $data = array(
            'total' => $total,
            'search' => $search,
            'deptArr' => $uInfo['deptArr'],
            //'user' => $uInfo['groupArr'],
            'infoArr' => $uInfo['infoArr'],
            'user_info' => $uInfo['user_info'],
            'resArr' => $resArr,
        );
        if ($isexcel) {

            $filename = "业绩报表.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename);
            echo iconv('utf-8', 'GBK', $this->cat34_titles);
            foreach ($resArr as $record) {
                echo iconv('utf-8', 'GBK', Utils::array_to_string($this->cat34_title_keys, $record));
            }
        } else {
            $this->render("yeji", $data);
        }
    }

    public function actionMonth() {
        $sql = <<<EOF
         select d.name as finance_type,FROM_UNIXTIME(acct_time,'%Y年%m月') as acct_time,SUM(acct_amount) as amount,SUM(acct_number) as number from {{finance}} f 
                left join {{dic}} d on f.finance_type=d.code and d.ctype='finance_type' 
				 group by d.name ,FROM_UNIXTIME(acct_time,'%Y%m') order by 2  
EOF;
        
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $total = 0;
        if ($result) {
//            $amount = array();
//            foreach ($result as $k => $v) {
//                $amount[] = $v['amount'];
//            }
//            array_multisort($amount, SORT_DESC, $result);
            $total = count($result);
        }
        $ret = array('result' => $result, 'total' => $total);
        $this->render("month", $ret);
    }
    
    public function actionDuplicateExtend() {
        $sql = <<<EOF
         SELECT 
    name, extend_no
FROM
    c_users
WHERE
    extend_no IN (SELECT 
            extend_no
        FROM
            crm.c_users
        WHERE
            extend_no <> 0
        GROUP BY extend_no
        HAVING COUNT(*) > 1) order by 2 
EOF;
        
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $total = 0;
        if ($result) {
//            $amount = array();
//            foreach ($result as $k => $v) {
//                $amount[] = $v['amount'];
//            }
//            array_multisort($amount, SORT_DESC, $result);
            $total = count($result);
        }
        $ret = array('result' => $result, 'total' => $total);
        $this->render("duplicate_user", $ret);
    }
    public function actionEveryday() {
        $search = Yii::app()->request->getParam("search");
        //$times = strtotime(date('Y-m', time()));
        $stime = strtotime($this->getCurMonthFirstDay(date('Y-m', time()))); //当月第一天,格式:2015-07-01
        $ftime = strtotime($this->getNextMonthFirstDay(date('Y-m', time()))); //2015-08-01
        if (isset($search['stime'])) {
            $stime = strtotime($this->getCurMonthFirstDay($search['stime']));
            $ftime = strtotime($this->getNextMonthFirstDay($search['stime']));
        }
        $sql = "select FROM_UNIXTIME(acct_time,'%Y年%m月%d') as acct_time, SUM(acct_number) as number,SUM(acct_amount) as amount "
                . "from `c_finance` where acct_time>=$stime and acct_time<$ftime group by FROM_UNIXTIME(acct_time,'%Y%m%d') order by amount desc";

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $total = 0;
        if ($result) {
            $total = count($result);
        }
        $ret = array('result' => $result, 'total' => $total, 'search' => $search);

        $this->render("everyday", $ret);
    }
    public function actionContact() {
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
            $search['user'] = ''; 
        } else {
            $param["search[stime]"] = $search['stime'];
            $param["search[etime]"] = $search['etime'];
            $param["search[dept]"] = $search['dept'];
            $param["search[group]"] = $search['group'];
            $param["search[user]"] = $search['user']; 
        }
        $offset = ($page - 1) * $this->pageSize;
        $priv = Userinfo::getPrivCondiForReport();

        $wherestr = "";
        if (!empty($search['stime'])) {
            $istime = strtotime($search['stime']);
            $wherestr = $wherestr . " and tb.dial_time>=$istime";
        }
        if (!empty($search['etime'])) {
            $ietime = strtotime($search['etime']);
            $wherestr = $wherestr . " and tb.dial_time<=$ietime";
        }
        if (!empty($search['dept'])) {
            $wherestr = $wherestr . " and u.dept_id=" . $search['dept'];
        }
        if (!empty($search['group'])) {
            $wherestr = $wherestr . " and u.group_id=" . $search['group'];
        }
        if (!empty($search['user'])) {
            $wherestr = $wherestr . " and u.eno='" . $search['user']."'";
        }  
        $columns="t.dept_name,t.group_name,t.user_name";
        $titles = $this->contact_0_titles;
        $title_keys= $this->contact_0_title_keys;
        $ctype=0;
        if(!empty($search['user'])){
            $columns="t.dept_name,t.group_name,t.user_name";
            $titles = $this->contact_0_titles;
        }else if(!empty($search['group'])){
            $columns="t.dept_name,t.group_name";
            $titles = $this->contact_1_titles;
            $title_keys= $this->contact_1_title_keys;
            $ctype=1;
        }else if(!empty($search['dept'])){
            $columns="t.dept_name";
            $titles = $this->contact_2_titles;
            $title_keys= $this->contact_2_title_keys;
            $ctype=2;
        } 
        $sql = <<<EOF
 SELECT 
    $columns,
    SUM(t.dial_long) AS dial_long,
    SUM(t.dial_num) AS dial_num,
    SUM(a9) AS a9,
    SUM(a10) AS a10,
    SUM(a11) AS a11,
    SUM(a12) AS a12,
    SUM(a13) AS a13,
    SUM(a14) AS a14,
    SUM(a15) AS a15,
    SUM(a16) AS a16,
    SUM(a17) AS a17,
    SUM(a18) AS a18,
    SUM(a19) AS a19,
    SUM(a20) AS a20,
    SUM(b9) AS b9,
    SUM(b10) AS b10,
    SUM(b11) AS b11,
    SUM(b12) AS b12,
    SUM(b13) AS b13,
    SUM(b14) AS b14,
    SUM(b15) AS b15,
    SUM(b16) AS b16,
    SUM(b17) AS b17,
    SUM(b18) AS b18,
    SUM(b19) AS b19,
    SUM(b20) AS b20
FROM
    (SELECT 
        u.id AS user_id,
            u.eno,
            u.dept_id,
            u.group_id,
            u.name AS user_name,
            d.name AS dept_name,
            g.name AS group_name,
            tb.dial_long,
            1 as dial_num,
            tb.dial_time,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 9 THEN 1
                ELSE 0
            END AS a9,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 10 THEN 1
                ELSE 0
            END AS a10,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 11 THEN 1
                ELSE 0
            END AS a11,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 12 THEN 1
                ELSE 0
            END AS a12,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 13 THEN 1
                ELSE 0
            END AS a13,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 14 THEN 1
                ELSE 0
            END AS a14,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 15 THEN 1
                ELSE 0
            END AS a15,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 16 THEN 1
                ELSE 0
            END AS a16,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 17 THEN 1
                ELSE 0
            END AS a17,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 18 THEN 1
                ELSE 0
            END AS a18,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 19 THEN 1
                ELSE 0
            END AS a19,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 20 THEN 1
                ELSE 0
            END AS a20,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 9 THEN tb.dial_long
                ELSE 0
            END AS b9,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 10 THEN tb.dial_long
                ELSE 0
            END AS b10,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 11 THEN tb.dial_long
                ELSE 0
            END AS b11,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 12 THEN tb.dial_long
                ELSE 0
            END AS b12,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 13 THEN tb.dial_long
                ELSE 0
            END AS b13,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 14 THEN tb.dial_long
                ELSE 0
            END AS b14,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 15 THEN tb.dial_long
                ELSE 0
            END AS b15,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 16 THEN tb.dial_long
                ELSE 0
            END AS b16,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 17 THEN tb.dial_long
                ELSE 0
            END AS b17,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 18 THEN tb.dial_long
                ELSE 0
            END AS b18,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 19 THEN tb.dial_long
                ELSE 0
            END AS b19,
            CASE
                WHEN HOUR(FROM_UNIXTIME(tb.dial_time)) = 20 THEN tb.dial_long
                ELSE 0
            END AS b20
    FROM
        c_dial_detail_p tb
    LEFT JOIN c_users u ON tb.userid = u.id
    LEFT JOIN c_dept_info d ON u.dept_id = d.id
    LEFT JOIN c_group_info g ON u.group_id = g.id
    WHERE
        1 = 1 $wherestr $priv) t
WHERE
    1 = 1 
GROUP BY $columns
EOF;

        $cnt = 0;
        $result1 = Yii::app()->db->createCommand("select count(*) as cnt from ($sql) tmp")->queryRow(true);
        if ($result1 && is_array($result1)) {
            $cnt = $result1['cnt'];
        }
        if ($isexcel) {
            $result = Yii::app()->db->createCommand($sql);
            $res = $result->queryAll();
            $filename = "联系量统计.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename);
            echo iconv('utf-8', 'GBK', $titles);
            $c = 1;
            foreach ($res as $record) { 
                echo $c.",".iconv('utf-8','GBK',Utils::array_to_string($title_keys,$this->getExcelRecordForContact($record)));
                $c++;
            }
        } else {
            $pages = new CPagination($cnt);
            $pages->params = $param;
            //获取查询的条数
            $pages->pageSize = $this->pageSize;
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $res = $result->queryAll();

            $data = array(
                'pages' => $pages,
                'total' => $cnt,
                'list' => $res,
                'search' => $search,
            );
            $this->render("contact", $data);
        }
    }
    private function getExcelRecordForContact($v){
        $newRecord = $v;
        $newRecord['total']=$v['dial_num']."|".$v['dial_long'];
        $newRecord['c9']=$v['a9']."|".$v['b9'];
        $newRecord['c10']=$v['a10']."|".$v['b10'];
        $newRecord['c11']=$v['a11']."|".$v['b11'];
        $newRecord['c12']=$v['a12']."|".$v['b12'];
        $newRecord['c13']=$v['a13']."|".$v['b13'];
        $newRecord['c14']=$v['a14']."|".$v['b14'];
        $newRecord['c15']=$v['a15']."|".$v['b15'];
        $newRecord['c16']=$v['a16']."|".$v['b16'];
        $newRecord['c17']=$v['a17']."|".$v['b17'];
        $newRecord['c18']=$v['a18']."|".$v['b18'];
        $newRecord['c19']=$v['a19']."|".$v['b19'];
        $newRecord['c20']=$v['a20']."|".$v['b20'];
        return $newRecord;
    }
    public function actionContactOld() {
        $search = Yii::app()->request->getParam("search");
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[] = Yii::app()->user->id;
        $userid = implode(',', $user_arr);
        if ($search) {
            $where = Utils::addWhere($search, 1);
            $where .= " and u.id in($userid) and d.name is not null and g.name is not null and u.name is not null";
        } else {
            $where = " where u.id in($userid) and d.name is not null and g.name is not null and u.name is not null";
        }

        $sql = "select d.name as dname,g.name as gname, u.name as uname, dial_long AS longs,FROM_UNIXTIME(dial_time,'%H') as times 
			from `c_dial_detail` as di left join `c_users` as u on di.eno=u.eno left join `c_dept_info` as d on u.dept_id=d.id 
			left join `c_group_info` as g on u.group_id=g.id $where";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $total = 0;
        $resArr = array();
        $timeArr = array('09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21');
        if ($result) {
            if ($search['dept'] && $search['group'] && $search['users']) {
                $dgUser = array();
                foreach ($result as $k => $v) {
                    $dgUser[] = $v['dname'] . $v['gname'] . $v['uname'];
                }
                $dgUser = array_unique($dgUser);

                foreach ($dgUser as $k1 => $v1) {
                    foreach ($timeArr as $t1) {
                        $str = $v1 . $t1;
                        $resArr[$v1][$t1]['num'] = 0;
                        $resArr[$v1][$t1]['longs'] = 0;
                        foreach ($result as $k2 => $v2) {
                            $str2 = $v2['dname'] . $v2['gname'] . $v2['uname'] . $v2['times'];
                            if ($str === $str2) {
                                $resArr[$v1]['dname'] = $v2['dname'];
                                $resArr[$v1]['gname'] = $v2['gname'];
                                $resArr[$v1]['uname'] = $v2['uname'];
                                $resArr[$v1][$t1]['num'] += 1;
                                $resArr[$v1][$t1]['longs'] += $v2['longs'];
                            }
                        }
                    }
                }
                $total = count($resArr);
            } elseif ($search['dept'] && $search['group']) {
                $dgUser = array();
                foreach ($result as $k => $v) {
                    $dgUser[] = $v['dname'] . $v['gname'];
                }
                $dgUser = array_unique($dgUser);

                foreach ($dgUser as $k1 => $v1) {
                    foreach ($timeArr as $t1) {
                        $str = $v1 . $t1;
                        $resArr[$v1][$t1]['num'] = 0;
                        $resArr[$v1][$t1]['longs'] = 0;
                        foreach ($result as $k2 => $v2) {
                            $str2 = $v2['dname'] . $v2['gname'] . $v2['times'];
                            if ($str === $str2) {
                                $resArr[$v1]['dname'] = $v2['dname'];
                                $resArr[$v1]['gname'] = $v2['gname'];
                                $resArr[$v1][$t1]['num'] += 1;
                                $resArr[$v1][$t1]['longs'] += $v2['longs'];
                            }
                        }
                    }
                }
                $total = count($resArr);
            } else {
                $dgUser = array();
                foreach ($result as $k => $v) {
                    $dgUser[] = $v['dname'];
                }
                $dgUser = array_unique($dgUser);
                foreach ($dgUser as $k1 => $v1) {
                    foreach ($timeArr as $t1) {
                        $str = $v1 . $t1;
                        $resArr[$v1][$t1]['num'] = 0;
                        $resArr[$v1][$t1]['longs'] = 0;
                        foreach ($result as $k2 => $v2) {
                            $str2 = $v2['dname'] . $v2['times'];
                            if ($str === $str2) {
                                $resArr[$v1]['dname'] = $v2['dname'];
                                $resArr[$v1][$t1]['num'] += 1;
                                $resArr[$v1][$t1]['longs'] += $v2['longs'];
                            }
                        }
                    }
                }
                $total = count($resArr);
            }
        }

        //部门组别人员三级联动
        $uInfo = Userinfo::secondlevel();
        $data = array(
            'total' => $total,
            'search' => $search,
            'deptArr' => $uInfo['deptArr'],
            //'user' => $uInfo['groupArr'],
            'infoArr' => $uInfo['infoArr'],
            'user_info' => $uInfo['user_info'],
            'resArr' => $resArr,
        );
        $this->render("contact", $data);
    }

    function getCurMonthFirstDay($date) {//获取本月第一天
        return date('Y-m-01', strtotime($date));
    }

    function getCurMonthLastDay($date) {//获取本月最后一天
        return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
    }

    function getNextMonthFirstDay($date) {//获取下月第一天
        return date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month'));
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
    public function getUserArr($deptid,$groupid) { 
        $sql = "select eno,concat(name,'(已分配',cust_num,')') as name from {{users}} t where t.dept_id=:dept_id and t.group_id=:group_id";
        $userarr = Users::model()->findAllBySql($sql, array(':dept_id' => $deptid,':group_id'=>$groupid));
        $user_empty = new Users();
        $user_empty->eno = 0;
        $user_empty->name = '--请选择人员--';
        $userarr = array_merge(array($user_empty), $userarr);
        return CHtml::listData($userarr, 'eno', 'name');
    }
    public function getFinaceTypeArr() { 
        $sql = "select code,name from {{dic}} where ctype='finance_type'";
        $dicarr = Dic::model()->findAllBySql($sql);
        $dic_empty = new Dic();
        $dic_empty->code = 0;
        $dic_empty->name = '--请选择到单类型--';
        $dicarr = array_merge(array($dic_empty), $dicarr);
        return CHtml::listData($dicarr, 'code', 'name');
    }
}
