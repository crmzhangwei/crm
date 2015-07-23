<?php

class CountController extends GController
{
    private $pageSize = 10;
	private $cat34_titles = "排名,部门,组别,金额,到单数\n";
    private $cat34_title_keys = array('dname','gname','amount','number');
	public function actionIndex()
	{
            
                $page = max(Yii::app()->request->getParam('page'), 1);
                $search = Yii::app()->request->getParam("search");
                $offset = ($page-1)*$this->pageSize;
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
            ORDER BY create_time*/


            
                 //这一部分获取总记录行
                $sql = "select id,dial_time as d,dial_long as l from {{dial_detail}} where 1";
                $criteria=new CDbCriteria();
                $result1 = Yii::app()->db->createCommand($sql)->query();
                $pages=new CPagination($result1->rowCount);
                
                //获取查询的条数
                $pages->pageSize=$this->pageSize; 
                $pages->applyLimit($criteria); 
                $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit"); 
                $result->bindValue(':offset', $pages->currentPage*$pages->pageSize); 
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
		
	public function actionYeji(){
		//$page = max(Yii::app()->request->getParam('page'), 1);
		//$offset = ($page-1)*$this->pageSize;
		$isexcel = Yii::app()->request->getParam("isexcel");
		$search = Yii::app()->request->getParam("search");
		if($search){
			$where  = Utils::addWhere($search);
		}
		else{
			$where = '';
		}
		
		$sql = "select d.name as dname,g.name as gname, u.name as uname, acct_amount as amount,acct_number as number "
				. "from {{finance}} as f "
				. "left join {{users}} as u on f.sale_user=u.id "
				. "left join {{dept_info}} as d on u.dept_id=d.id "
				. "left join {{group_info}} as g on u.group_id=g.id $where";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$total = 0;
		$resArr = array();
		if($result){	
			if($search['dept'] && $search['group'] && $search['users']){
				$dgUser = array();
				foreach ($result as $k=>$v){
					$dgUser[] = $v['dname'].$v['gname'].$v['uname'];
				}
				$dgUser = array_unique($dgUser);
				
				foreach ($dgUser as $k1 => $v1) {
					$resArr[$v1]['amount'] = 0;
					$resArr[$v1]['number'] = 0;
					foreach ($result as $k2 => $v2) {
						$str = $v2['dname'].$v2['gname'].$v2['uname'];
						if($str === $v1){
							$resArr[$v1]['dname'] = $v2['dname'];
							$resArr[$v1]['gname'] = $v2['gname'];
							$resArr[$v1]['uname'] = $v2['uname'];
							$resArr[$v1]['amount'] += $v2['amount'];
							$resArr[$v1]['number'] += $v2['number'];
						}
					}
				}
				$total = count($resArr);
			}
			elseif($search['dept'] && $search['group']){
				$dgroup = array();
				foreach ($result as $k=>$v){
					$dgroup[] = $v['dname'].$v['gname'];
				}
				$dgroup = array_unique($dgroup);
				
				foreach ($dgroup as $k1 => $v1) {
					$resArr[$v1]['amount'] = 0;
					$resArr[$v1]['number'] = 0;
					foreach ($result as $k2 => $v2) {
						$str = $v2['dname'].$v2['gname'];
						if($str === $v1){
							$resArr[$v1]['dname'] = $v2['dname'];
							$resArr[$v1]['gname'] = $v2['gname'];
							$resArr[$v1]['amount'] += $v2['amount'];
							$resArr[$v1]['number'] += $v2['number'];
						}
					}
				}
				
				$total = count($resArr);
			}
			else{
				$depts = array();
				foreach ($result as $k=>$v){
					$depts[] = $v['dname'].$v['gname'];
				}
				$depts = array_unique($depts);
				foreach ($depts as $k1 => $v1) {
					$resArr[$v1]['amount'] = 0;
					$resArr[$v1]['number'] = 0;
					foreach ($result as $k2 => $v2) {
						$str = $v2['dname'].$v2['gname'];
						if($str === $v1){
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
		
		if($resArr){
			$amount = array();
			foreach ($resArr as $k=>$v){
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
			'infoArr'=>$uInfo['infoArr'],
			'user_info'=>$uInfo['user_info'],
			'resArr' => $resArr,
		);
		if ($isexcel) {
            
            $filename = "业绩报表.csv";
            header("Content-type:text/csv");
            header("Content-Disposition:attachment;filename=" . $filename); 
            echo iconv('utf-8','gb2312',$this->cat34_titles);
            foreach($resArr as $record){
                echo iconv('utf-8','gb2312',Utils::array_to_string($this->cat34_title_keys,$record));
            } 
        }
		else{
			$this->render("yeji", $data);
		}
	}

	public function actionMonth(){
		
		$sql = "select FROM_UNIXTIME(acct_time,'%Y年%m月') as acct_time,SUM(acct_amount) as amount,SUM(acct_number) as number from `c_finance` 
				 group by FROM_UNIXTIME(acct_time,'%Y%m')";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		
		$total = 0;
		if($result){
			$amount = array();
			foreach ($result as $k => $v) {
				$amount[] = $v['amount'];
			}
			array_multisort($amount, SORT_DESC, $result);
			$total = count($result);
		}
		$ret = array('result'=>$result, 'total'=>$total);
		$this->render("month", $ret);
	}
	
	public function actionEveryday(){
		$search = Yii::app()->request->getParam("search");
		//$times = strtotime(date('Y-m', time()));
		$stime = strtotime( $this->getCurMonthFirstDay(date('Y-m',time())) );//当月第一天,格式:2015-07-01
		$ftime = strtotime( $this->getNextMonthFirstDay(date('Y-m',time())) );//2015-08-01
		if(isset($search['stime'])){
			$stime = strtotime( $this->getCurMonthFirstDay($search['stime']) );
			$ftime = strtotime( $this->getNextMonthFirstDay($search['stime']) );
		}
		$sql = "select FROM_UNIXTIME(acct_time,'%Y年%m月%d') as acct_time, SUM(acct_number) as number,SUM(acct_amount) as amount "
				. "from `c_finance` where acct_time>=$stime and acct_time<$ftime group by FROM_UNIXTIME(acct_time,'%Y%m%d') order by amount desc";
		
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$total = 0;
		if($result){
			$total = count($result);
		}
		$ret = array('result'=>$result, 'total'=>$total, 'search'=>$search);
		
		$this->render("everyday",$ret);
	}
	
	public function actionContact(){
		$search = Yii::app()->request->getParam("search");
		if($search){
			$where  = Utils::addWhere($search, 1);
		}
		else{
			$where = '';
		}
		
		$sql = "select d.name as dname,g.name as gname, u.name as uname, SUM(dial_long) as longs,COUNT(*)as num, FROM_UNIXTIME(dial_time,'%H') as times 
			from `c_dial_detail` as di left join `c_users` as u on di.eno=u.eno left join `c_dept_info` as d on u.dept_id=d.id 
			left join `c_group_info` as g on u.group_id=g.id $where group by FROM_UNIXTIME(dial_time,'%H') order by longs desc";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$total = 0;
		$resArr = array();
		$timeArr = array('09','10','11','12','13','14','15','16','17','18','19','20','21');
		if($result){	
			if($search['dept'] && $search['group'] && $search['users']){
				$dgUser = array();
				foreach ($result as $k=>$v){
					$dgUser[] = $v['dname'].$v['gname'].$v['uname'];
				}
				$dgUser = array_unique($dgUser);
				
				foreach ($dgUser as $k1 => $v1) {
					foreach($timeArr as $t1){
						$str = $v1.$t1;
						$resArr[$v1][$t1]['num'] = 0;
						$resArr[$v1][$t1]['longs'] = 0;
						foreach ($result as $k2 => $v2) {
							$str2 = $v2['dname'].$v2['gname'].$v2['uname'].$v2['times'];
							if($str === $str2){
								$resArr[$v1]['dname'] = $v2['dname'];
								$resArr[$v1]['gname'] = $v2['gname'];
								$resArr[$v1]['uname'] = $v2['uname'];
								$resArr[$v1][$t1]['num'] += $v2['num'];
								$resArr[$v1][$t1]['longs'] += $v2['longs'];
							}
						}
					}	
				}
				$total = count($resArr);
			}
			elseif($search['dept'] && $search['group']){
				$dgUser = array();
				foreach ($result as $k=>$v){
					$dgUser[] = $v['dname'].$v['gname'];
				}
				$dgUser = array_unique($dgUser);
				
				foreach ($dgUser as $k1 => $v1) {
					foreach($timeArr as $t1){
						$str = $v1.$t1;
						$resArr[$v1][$t1]['num'] = 0;
						$resArr[$v1][$t1]['longs'] = 0;
						foreach ($result as $k2 => $v2) {
							$str2 = $v2['dname'].$v2['gname'].$v2['times'];
							if($str === $str2){
								$resArr[$v1]['dname'] = $v2['dname'];
								$resArr[$v1]['gname'] = $v2['gname'];
								$resArr[$v1][$t1]['num'] += $v2['num'];
								$resArr[$v1][$t1]['longs'] += $v2['longs'];
							}
						}
					}	
				}
				$total = count($resArr);
			}
			else{
				$dgUser = array();
				foreach ($result as $k=>$v){
					$dgUser[] = $v['dname'];
				}
				$dgUser = array_unique($dgUser);
				
				foreach ($dgUser as $k1 => $v1) {
					foreach($timeArr as $t1){
						$str = $v1.$t1;
						$resArr[$v1][$t1]['num'] = 0;
						$resArr[$v1][$t1]['longs'] = 0;
						foreach ($result as $k2 => $v2) {
							$str2 = $v2['dname'].$v2['times'];
							if($str === $str2){
								$resArr[$v1]['dname'] = $v2['dname'];
								$resArr[$v1][$t1]['num'] += $v2['num'];
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
			'infoArr'=>$uInfo['infoArr'],
			'user_info'=>$uInfo['user_info'],
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
	
}