<?php
include_once "../base.php";


if (!empty($_FILES['trailer']['tmp_name'])) {
    $_POST['trailer'] = $_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'], '../img/' . $_FILES['trailer']['name']);
}

if (!empty($_FILES['poster']['tmp_name'])) {
    $_POST['poster'] = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], '../img/' . $_FILES['poster']['name']);
}

if (isset($_POST['id'])) {
    $movie=$Movie->find($_POST['id']);
    $_POST['sh'] = $movie['sh'];
    $_POST['rank'] = $movie['rank'];
} else {
    $_POST['sh'] = 1;
    $_POST['rank'] = $Movie->q("select max(rank) from movie")[0][0] + 1;
}





$Movie->save($_POST);

to('../backend.php?do=movie');


//add edit 合併版

