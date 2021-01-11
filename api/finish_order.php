<?php
include_once "../base.php";

$data['movie']=$Movie->find($_POST['movie'])['name'];
$data['date']=$_POST['date'];
sort($_POST['seats']);//sort排序
$data['seats']=serialize($_POST['seats']); //serialize序列化
$data['qt']=count($_POST['seats']);
$data['session']=$sess[$_POST['session']];
$n=$Order->q("select max(`id`) from `orders`")[0][0]+1;
$data['num']=date("Ymd").sprintf("%04d",$n);

$Order->save($data);
echo $data['num'];
//unserialize 可將序列化文字轉回陣列
?>