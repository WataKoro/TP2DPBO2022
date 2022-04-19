<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/bidang_divisi.class.php");
include("includes/divisi.class.php");

$bidang = new bidang($db_host, $db_user, $db_pass, $db_name);
$bidang->open();

if (!isset($_GET['id_edit'], $_GET['id_hapus'])) {
    $inputTitle = "Add Bidang";
    $dataForm = "
            <div class='mb-3'>
              <label for='name' class='form-label'>Nama Bidang</label>
              <input type='text' class='form-control' id='name' name='name' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {
        $bidang->add($_POST['name'], $_POST['id_divisi']);
        header("location:bidang_divisi.php");
    }
}

//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $bidang->delete($id);
    header("location:bidang_divisi.php");
}

if (isset($_GET['id_edit'])) {
    $id_edit = $_GET['id_edit'];
    list($id_bidang, $jabatan) = $bidang->getResult();
    $inputTitle = "Edit Bidang";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_bidang' name='id_bidang' value='". $id_bidang ."' />
              <label for='jabatan' class='form-label'>Nama Divisi</label>
              <input type='text' class='form-control' id='jabatan' name='jabatan' value='". $jabatan ."' placeholder='Masukan Nama Divisi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";
    if (isset($_POST['btn-edit'])) {
        $id_bidang = $_POST['id_bidang'];
        $jabatan = $_POST['jabatan'];
        $bidang->updateBidang($id_bidang, $jabatan);
        header("location: bidang_divisi.php");
    }
}

$data = null;
$bidang->getBidang();
$no = 1;

while (list($id_bidang, $jabatan) = $bidang->getResult()) {
        $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $jabatan . "</td>
                <td>
                <a href='bidang_divisi.php?id_edit=" . $id_bidang . "' class='btn btn-warning'> Edit </a>
                <a href='bidang_divisi.php?id_hapus=" . $id_bidang . "' class='btn btn-danger''>Hapus</a>
                </td>
                </tr>";
}


$bidang->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("FORM_TITLE", $inputTitle);
$tpl->replace("FORM", $dataForm);
$tpl->write();
