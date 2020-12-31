<?php
include_once "../base.php";

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
