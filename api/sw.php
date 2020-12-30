<?php
include_once "../base.php";

$table=$_POST['table'];
$db=new DB($table);

$idx=$db->find($_POST['idx']);
$idy=$db->find($_POST['idy']);
//透過建立第三個變數 實現交換參數功能
$tmp=$idx['rank'];
$idx['rank']=$idy['rank'];
$idy['rank']=$tmp;

$db->save($idx);
$db->save($idy);



?>