<?php
date_default_timezone_set("Asia/Taipei");
session_start();

$sess=[
    1=>"14:00~16:00",
    2=>"16:00~18:00",
    3=>"18:00~20:00",
    4=>"20:00~22:00",
    5=>"22:00~24:00"
];

class DB{
    private $table;
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db213;";


    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,"root","");
    }

    function all(...$arg){
        $sql="select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchAll();
    }

    function count(...$arg){
        $sql="select count(*) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    function find($arg){
        $sql="select * from $this->table ";
            if(is_array($arg)){
                foreach($arg as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .=" where `id`='$arg'";
            }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function del($arg){
        $sql="delete from $this->table ";
            if(is_array($arg)){
                foreach($arg as $key=>$value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
                $sql .=" where ".implode(" && ",$tmp);
            }else{
                $sql .=" where `id`='$arg'";
            }
        return $this->pdo->exec($sql);
    }

    function save($arg){
        if(isset($arg['id'])){
            foreach($arg as $key=>$value){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            $sql ="update $this->table set ".implode(" , ",$tmp)." where `id`='{$arg['id']}'";
        }else{
            $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) values ('".implode("','",$arg)."')";
        }
        return $this->pdo->exec($sql);
    }
    function q($sql){
        return $this->pdo->query($sql)->fetchAll();
    }
}
function to($url){
    header("location:".$url);
}


$Poster=New DB("poster");
$Movie=New DB("movie");
$Order=New DB("orders");
//test

// $tt=['text'=>333,'sh'=>1];
// $db=new DB('title');

// // $tt=$db->save($tt);
// $tt=$db->find(['id'=>1]);
// print_r($tt);

// $tt=['text'=>555,'sh'=>1,'id'=>1];
// $tt=$db->save($tt);

// $tt=$db->del(['id'=>1]);