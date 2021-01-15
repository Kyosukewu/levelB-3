<?php
include_once "../base.php";

$movie = $Movie->find($_GET['movie']);
$date = $_GET['date'];
$session = $_GET['session'];

$orders=$Order->all([
    'movie'=>$movie['name'],
    'date'=>$date,
    'session'=>$sess[$session]
]);

$seats=[];

foreach($orders as $order){
    $tmp=unserialize($order['seats']);
    $seats=array_merge($seats,$tmp);
}

?>
<style>
    .seat {
        width: 63px;
        height: 85px;
        text-align: center;
        position: relative;
    }

    .booked {
        background: url('icon/03D03.png');
        background-repeat: no-repeat;
        background-position: center;
    }

    .empty {
        background: url('icon/03D02.png');
        background-repeat: no-repeat;
        background-position: center;
    }

    .chk {
        display: block;
        position: absolute;
        bottom: 5px;
        right: 5px;
    }

    .set-box {
        margin: auto;
        width: 540px;
        height: 370px;
        padding-top: 20px;
        background: url(icon/03D04.png);
        background-repeat: no-repeat;
    }
</style>

<div class="set-box">

    <div style="width: 315px; height:340px; margin:auto; display:flex; flex-wrap:wrap;">
    <!-- 判斷是否已訂位 -->
        <?php
        for ($i = 0; $i < 20; $i++) {
            if(in_array($i,$seats)){
                echo "<div class='seat booked'>";
            }else{
                echo "<div class='seat empty'>";
            }
            echo (floor($i / 5) + 1) . "排" . ($i % 5 + 1) . "號";
            if(!in_array($i,$seats)){
                echo "<input type='checkbox' value='$i' class='chk'>";
            }
            echo "</div>";
        }

        ?>
    </div>
</div>

<div style="padding:1rem 30%;background:#ccc;">
    <div>您選擇的電影是：<?= $movie['name']; ?></div>
    <div>您選擇的時刻是：<?= $date; ?> <?= $sess[$session]; ?></div>
    <div>您已經勾選<span id="ticket"></span>張票，最多可以購買四張票</div>
    <div class="ct">
        <button onclick="javascript:$('.order,.booking').toggle()">上一步</button>
        <button onclick="finish()">訂購</button>
    </div>
</div>
<script>
    $("#ticket").text(0)

    let seats = new Array();
    $('.chk').on('click', function() {
        //取得座位值
        let s = $(this).val()
        //判斷checkbox的狀況來決定要做新增或刪除座位
        if ($(this).prop('checked')) {
            seats.push(s)
            //計算目前的票數
            if (seats.length > 4) {
                alert("最多只能購買4張票")
                seats.splice(seats.indexOf(s), 1) //刪除多選的數量
                $(this).prop('checked', false)
            }
            $("#ticket").text(seats.length)
        } else {
            //取消選取座位
            seats.splice(seats.indexOf(s), 1) //取消
            // $(this).prop('checked',false)
            $("#ticket").text(seats.length)
        }
    })

function finish(){
    let movie=$("#movie").val()
    let date=$("#date").val()
    let session=$("#session").val()
    // console.log(seats)
    $.post("api/finish_order.php",{seats,movie,date,session},function(num){
        location.href="index.php?do=finish&num="+num
    })
}
</script>