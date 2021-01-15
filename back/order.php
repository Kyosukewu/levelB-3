<style>
    .ord-header,
    .ord-item {
        display: flex;
    }

    .ord-header div,
    .ord-item div {
        width: 14.7%;
        padding: 3px;
        background: #ccc;
        text-align: center;
        color: black;
    }

    .ord-list {
        height: 420px;
        overflow: auto;
        width: 98%;
    }

    .ord-item div {
        background: #fff;
    }
</style>

<div class="rb tab" style="width: 98%;">
    <div class="ct">訂單清單</div>
    <div class="q-del">
        快速刪除
        <input type="radio" name="type" value="date" checked>依日期
        <input type="date" name="date" id="date">
        <input type="radio" name="type" value="movie">依電影
        <select name="movie" id="movie">
            <?php
            $movies = $Movie->q("SELECT `movie` FROM `orders` group by `movie`");
            foreach ($movies as $movie) {
                echo "<option value='{$movie['movie']}'>{$movie['movie']}</option>";
            }
            ?>
        </select>
        <button onclick="qDel()">刪除</button>

    </div>
    <div class="ord-header">
        <div>訂單編號</div>
        <div>電影名稱</div>
        <div>日期</div>
        <div>場次時間</div>
        <div>訂購數量</div>
        <div>訂購位置</div>
        <div>操作</div>
    </div>
    <div class="ord-list">
        <?php
        $ords = $Order->all(" order by num desc");
        foreach ($ords as $ord) {
        ?>
            <div class="ord-item">
                <div><?= $ord['num']; ?></div>
                <div><?= $ord['movie']; ?></div>
                <div><?= $ord['date']; ?></div>
                <div><?= $ord['session']; ?></div>
                <div><?= $ord['qt']; ?></div>
                <div><?php
                        $seats = unserialize($ord['seats']);
                        foreach ($seats as $seat) {
                            echo (floor($seat / 5) + 1) . "排" . ($seat % 5 + 1) . "號<br>";
                        }
                        ?></div>
                <div><button onclick="del('orders',<?= $ord['id']; ?>)">刪除</button></div>
            </div>
            <hr>
        <?php
        }
        ?>
    </div>
</div>

<script>
    function del(table, id) {
        $.post("api/del.php", {
            table,
            id
        }, function() {
            location.reload()
        })
    }

    function qDel() {
        let value
        let type=$("input[type='radio']:checked").val();
        switch ($("input[type='radio']:checked").val()) {
            case "date":
                value=$('#date').val()
                break
            case "movie":
                value=$('#movie').val()
                break
        }
        let conf=confirm(`確定要刪除${value}的訂單嗎?`)

        if(conf){
            $.post('api/qdel.php',{value,type},function(){
                console.log(value,type)
                location.reload()
            })
        }
    }
</script>