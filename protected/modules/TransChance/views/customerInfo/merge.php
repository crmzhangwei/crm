<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */

$this->breadcrumbs = array(
    '我的机会' => array('todaylist'),
    '合并客户',
);

$this->menu = array(
);
?>

<h1>合并客户</h1>

<?php
$this->renderPartial('_merge', array('model' => $model,
    'cust_name' => $cust_name,
    'shop_name' => $shop_name,
    'corp_name' => $corp_name,
    'shop_url' => $shop_url,
    'shop_addr' => $shop_addr,
    'phones' => $phones,
    'phone2' => $phone2,
    'phone3' => $phone3,
    'phone4' => $phone4,
    'phone5' => $phone5,
    'qq' => $qq,
    'mail' => $mail,
    'datafrom' => $datafrom,
    'category' => $category,
    'cust_type' => $cust_type,
    'abandon_reason' => $abandon_reason,
    'memo' => $memo,
    'custlist' => $custlist));
?>