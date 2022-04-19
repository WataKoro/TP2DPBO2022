<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/divisi.class.php");
include("includes/bidang_divisi.class.php");
include("includes/pengurus.class.php");

$pengurus = new pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
$pengurus->getpengurus();
$data = null;
$no = 1;

while (list($nim, $nama, $semester, $image, $id_bidang) = $pengurus->getResult()) {
    $data .= "
    ";
}

$pengurus->close();
$tpl = new Template("templates/index.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
