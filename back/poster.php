<div class="rb tab" style="width: 98%;">
    <h3 class="ct" style="margin: 0;">預告片清單</h3>
    <form action="api/edit_poster.php" method="post">
        <div style="width: 100%; display:flex;background:#999;" class="ct">
            <div style="width:25%;">預告片海報</div>
            <div style="width:25%;">預告片片名</div>
            <div style="width:25%;">預告片排序</div>
            <div style="width:25%;">操作</div>
        </div>
        <div style="width:100%;height:250px;overflow-y:auto" class="ct">
            <?php
            $posters = $Poster->all(" order by `rank`");
            foreach ($posters as $key => $poster) {
            ?>
                <div style="display:flex; align-items:center;" class="ct">
                    <div style="width:25%; margin:
                1px;">
                        <img src="img/<?= $poster['img']; ?>" alt="" style="width: 80px;">
                    </div>
                    <div style="width:25%; margin:
                1px;">
                        <input type="text" name="name[]" id="" value="<?= $poster['name']; ?>"></div>
                    <div style="width:25%; margin:
                1px;">
                        <?php
                        if ($key != 0) {
                        ?>
                            <input type="button" value="往上" onclick="sw(<?=$poster['id'];?>,<?=$posters[$key-1]['id'];?>)">
                        <?php
                        }
                        if ($key != count($posters) - 1) {
                        ?>
                            <input type="button" value="往下" onclick="sw(<?=$poster['id'];?>,<?=$posters[$key+1]['id'];?>)">
                        <?php
                        }
                        ?>
                    </div>
                    <div style="width:25%; margin:
                1px;">
                        <input type="checkbox" name="sh[]" value="<?= $poster['id']; ?>" <?= ($poster['sh'] == 1) ? "checked" : ""; ?>>顯示
                        <input type="checkbox" name="del[]" value="<?= $poster['id']; ?>">刪除
                        <select name="ani[]" id="">
                            <option value="1" <?= ($poster['ani'] == 1) ? "selected" : ""; ?>>淡入淡出</option>
                            <option value="2" <?= ($poster['ani'] == 2) ? "selected" : ""; ?>>滑入滑出</option>
                            <option value="3" <?= ($poster['ani'] == 3) ? "selected" : ""; ?>>縮放</option>
                        </select>
                        <input type="hidden" name="id[]" value="<?= $poster['id']; ?>">
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
    <hr>
    <form action="api/add_poster.php" method="post" enctype="multipart/form-data">
        <h3 class="ct" style="margin: 0;">新增預告片海報</h3>
        <table>
            <tr>
                <td>預告片海報：</td>
                <td><input type="file" name="poster" id=""></td>
                <td>預告片片名：</td>
                <td><input type="text" name="name" id=""></td>
            </tr>
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<script>
    function sw(idx,idy){
        $.post('api/sw.php',{table:'poster',idx,idy},function(){
            location.reload()
        })
    }
</script>