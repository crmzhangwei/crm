<?php

class CountController extends GController
{
        private $pageSize = 2;
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
}