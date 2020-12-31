<?php
$movie=$Movie->find($_GET['id']);

?>

<h3 class="ct" style="margin: 0;">編輯院線片</h3>
<form action="api/edit_movie.php" method="post" enctype="multipart/form-data">
<table style="width: 100%;">
    <tr>
        <td style="width: 20%; text-align:center;vertical-align:top;">影片資料</td>
        <td>
            <div>片名：<input type="text" name="name" value="<?=$movie['name'];?>"></div>
            <div>分級；<select name="level">
                <option value="普遍級" <?=($movie['level']=="普遍級")?"selected":"";?> >普遍級</option>
                <option value="輔導級" <?=($movie['level']=="輔導級")?"selected":"";?> >輔導級</option>
                <option value="保護級" <?=($movie['level']=="保護級")?"selected":"";?> >保護級</option>
                <option value="限制級" <?=($movie['level']=="限制級")?"selected":"";?> >限制級</option>
            </select></div>
            <div>片長：<input type="text" name="length" value="<?=$movie['length'];?>"></div>
            <div>上映日期：
                <select name="year">年
                <option value="2021" <?=($movie['month']=="2021")?"selected":"";?>>2021</option>
                <option value="2022" <?=($movie['day']=="2022")?"selected":"";?>>2022</option>
                </select>
                <select name="month">月
                <?php
                for($i=1;$i<=12;$i++){
                    $selected=($movie['month']==$i)?"selected":"";
                ?>
                <option value="<?=$i;?>" <?= $selected;?>><?=$i;?></option>
                <?php
                }
                ?>
                </select>
                <select name="day">日
                <?php
                for($i=1;$i<=31;$i++){
                    $selected=($movie['day']==$i)?"selected":"";
                ?>
                <option value="<?=$i;?>" <?= $selected;?>><?=$i;?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <div>發行商：<input type="text" name="publish" value="<?=$movie['publish'];?>"></div>
            <div>導演：<input type="text" name="director" value="<?=$movie['director'];?>"></div>
            <div>預告影片：<input type="file" name="trailer"></div>
            <div>電影海報：<input type="file" name="poster"></div>
        </td>
    </tr>
    <tr>
        <td style="width: 20%; text-align:center;vertical-align:top;">劇情簡介</td>
        <td><textarea name="intro" id="" style="width: 98%;height:60px;"><?=$movie['intro'];?></textarea></td>
    </tr>
</table>
<div class="ct">
    <input type="hidden" name="id" value="<?=$movie['id'];?>">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
</div>
</form>