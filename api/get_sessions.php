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
        $sum=$Order->q("SELECT sum(`qt`) FROM `orders` 
        WHERE `movie`='{$movie['name']}' &&
        `date`='$date' &&
        `session`='{$sess[$i]}'")[0][0];
        // $orders=$Order->all([
        //     'movie'=>$movie['name'],
        //     'date'=>$date,
        //     'session'=>$sess[$i]
        // ]);
        // $sum=0;
        // foreach($orders as $ord){
        //     $sum+=$ord['qt'];
        // }
        echo "<option value='{$i}'>".$sess[$i]." 剩餘座位：".(20-$sum)."</option>";
    }
}else{
    for($i=1;$i<5;$i++){
        $sum=$Order->q("SELECT sum(`qt`) FROM `orders` 
        WHERE `movie`='{$movie['name']}' &&
        `date`='$date' &&
        `session`='{$sess[$i]}'")[0][0];
        // $orders=$Order->all([
        //     'movie'=>$movie['name'],
        //     'date'=>$date,
        //     'session'=>$sess[$i]
        // ]);
        // $sum=0;
        // foreach($orders as $ord){
        //     $sum+=$ord['qt'];
        // }
        echo "<option value='{$i}'>".$sess[$i]." 剩餘座位：".(20-$sum)."</option>";
    }
}
//---------------------