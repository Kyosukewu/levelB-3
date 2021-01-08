<style>
  .posters {
    width: 200px;
    height: 260px;
    margin: auto;
    text-align: center;
    position: relative;
  }

  .posters>div {
    position: absolute;
  }

  .posters img {
    width: 100%;
  }
</style>
<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div class="posters">
      <?php
      $posters = $Poster->all(['sh' => 1], " order by rank");
      foreach ($posters as $key => $poster) {
        echo "<div class='po' id='p{$key}' data-ani='{$poster['ani']}'>";
        echo "<img src='img/{$poster['img']}'>";
        echo "<span>{$poster['name']}</span>";
        echo "</div>";
      }
      ?>
    </div>
    <div class="buttons">

    </div>
  </div>
</div>
<script>
  $('.po').hide()
  $('#p0').show()
  let pos = $('.po').length
  let t = setInterval('ani()', 2000)

  function ani() {
    let now = $(".po:visible")
    let ani = $(now).data('ani')
    let next
    if($(now).next().length){
      next=$(now).next()
    }else{
      next=$("#p0")
    }
    console.log(ani)
    switch (ani) {
      case 1://淡入淡出
        $(now).fadeOut(1000)
        $(next).fadeIn(1000)
        break;
      case 2://滑入滑出
        $(now).slideUp(1000,function(){
          $(next).slideDown(1000)
        })
        break;
      case 3://縮放
        $(now).hide(1000)
        $(next).show(1000)
        break;
    }

  }
</script>
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
    <?php

    $today = date("Y-m-d");
    $startDate = date("Y-m-d", strtotime("-2 days", strtotime($today)));

    $total = $Movie->count(['sh' => 1], " && `ondate` between '$startDate' and '$today'");
    $div = 4;
    $pages = ceil($total / $div);
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;


    $movies = $Movie->all(['sh' => 1], " && `ondate` between '$startDate' and '$today' order by rank limit $start,$div");
    // $movies=$Movie->all(['sh'=>1]," && `ondate` >= '$startDate' && `ondate`<='$today' order by rank");寫法二

    foreach ($movies as $movie) {
    ?>
      <div style="width:48%;border:1px solid #ccc;margin:.5%;">
        <div style="text-align:center;">片名：<?= $movie['name']; ?></div>
        <div style="display:flex;justify-content:space-around;">
          <a href="index.php?do=intro&id=<?= $movie['id']; ?>"> <img src="img/<?= $movie['poster']; ?>" style="width:80px;height:100px;"></a>
          <div>分級：<br>
            <img src="icon/<?= $movie['level']; ?>.png" alt=""><?= $movie['level']; ?><br>
            上映日期：<br><?= $movie['year'] . "-" . $movie['month'] . "-" . $movie['day']; ?>
          </div>
        </div>
        <div style="text-align:center;margin:5px 0;">
          <button onclick="javascript:location.href='index.php?do=intro&id=<?= $movie['id']; ?>'">劇情簡介</button>
          <button onclick="javascript:location.href='index.php?do=order&id=<?= $movie['id']; ?>'">線上訂票</button>
        </div>
      </div>

    <?php
    }
    ?>
  </div>
  <div class="ct" style="font-size: 1.5rem;">

    <?php
    if (($now - 1) > 0) {
      echo "<a href='?p=" . ($now - 1) . "'> &lt; </a>";
    }
    for ($i = 1; $i <= $pages; $i++) {
      echo "<a href='?p=$i'>$i</a>";
    }
    if (($now + 1) <= $pages) {
      echo "<a href='?p=" . ($now + 1) . "'> &gt; </a>";
    }
    ?>
  </div>
</div>