<div class="rb tab" style="width: 98%;">
    <h3 class="ct" style="margin: 0;">預告片清單</h3>
    <form action="api/edit_poster.php" method="post">
        <div style="width: 100%; display:flex;background:#999;" class="ct">
            <div style="width:25%;">預告片海報</div>
            <div style="width:25%;">預告片片名</div>
            <div style="width:25%;">預告片排序</div>
            <div style="width:25%;">操作</div>
        </div>
        <div id="posterList" style="width:100%;height:250px;overflow-y:auto" class="ct">

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
    function sw(idx, idy) {
        $.post('api/sw.php', {
            table: 'poster',
            idx,
            idy
        }, function() {
            // location.reload()
            $.get("api/poster_list.php", function(list) {
                $("#posterList").html(list)
            })
        })
    }



    $.get("api/poster_list.php", function(list) {
        $("#posterList").html(list)
    })
</script>