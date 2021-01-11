<?php
include_once "../base.php";
$sess=[
    1=>"14:00~16:00",
    2=>"16:00~18:00",
    3=>"18:00~20:00",
    4=>"20:00~22:00",
    5=>"22:00~24:00"
];

$movie=$Movie->find($_GET['movie']);
$date=$_GET['date'];
$session=$_GET['session'];

?>
<style>
    .seat{
        width: 63px;
        height: 85px;
        text-align: center;
        position: relative;
    }
    .booked{
        background: url('icon/03D03.png');
        background-repeat: no-repeat;
        background-position: center;
    }
    .empty{
        background: url('icon/03D02.png');
        background-repeat: no-repeat;
        background-position: center;
    }
    .chk{
        display: block;
        position: absolute;
        bottom: 5px;
        right: 5px;
    }
</style>

<div style="margin:auto;width:540px;height:370px;padding-top:20px;background:url(icon/03D04.png);background-repeat: no-repeat;">

<div style="width: 315px; height:340px; margin:auto; display:flex; flex-wrap:wrap;">
<?php
for($i=0;$i<20;$i++){
    echo "<div class='seat empty'>";
    echo (floor($i/5)+1)."排".($i%5+1)."號";
    echo "<input type='checkbox' value='$i' class='chk'>";
    echo "</div>";
}

?>
</div>


</div>



<div style="padding:1rem 30%;background:#ccc;">
<div>您選擇的電影是：<?=$movie['name'];?></div>
<div>您選擇的時刻是：<?=$date;?> <?=$sess[$session];?></div>
<div>您已經勾選<span id="ticket"></span>張票，最多可以購買四張票</div>
<div class="ct">
<button onclick="javascript:$('.order,.booking').toggle()">上一步</button>
<button>訂購</button>
</div>
</div>
