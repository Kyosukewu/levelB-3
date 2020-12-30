<?php
include_once "../base.php";

if(!empty($_FILES['poster']['tmp_name'])){
    $data=[];
    $filename=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$filename);
    $data['img']=$filename;
    $data['name']=$_POST['name'];
    $data['sh']=1;
    $data['rank']=$Poster->q("select max(rank) from poster")[0][0]+1; //排序
    $data['ani']=1;
    $Poster->save($data);
    
}

to('../backend.php?do=poster');
?>