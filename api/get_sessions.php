<?php
include_once "../base.php";

$movie=$Movie->find($_GET['movie']);
$date=$_GET['date'];

$now=date("G");

if($now<=13){
    $start=1;
}else{
    $start=ceil(($now-13)/2)+1;
}
if($date==date("Y-m-d")){
    for($i=$start;$i<5;$i++){
        echo "<option value='{$i}'>".$sess[$i]." 剩餘座位：20 </option>";
    }
}else{
    for($i=1;$i<5;$i++){
        echo "<option value='{$i}'>".$sess[$i]." 剩餘座位：20 </option>";
    }
}
