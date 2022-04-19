<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/divisi.class.php");

$divisi = new divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$dataForm = null;
$inputTitle = null;

if (!isset($_GET['id_edit'], $_GET['id_hapus'])) {
    $inputTitle = "Add Divisi";
    $dataForm = "
            <div class='mb-3'>
              <label for='name' class='form-label'>Nama Divisi</label>
              <input type='text' class='form-control' id='name' name='name' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-submit' id='btn-submit'>Add</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {
        $divisi->add($_POST['name']);
        header("location:divisi.php");
    }
}

//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $divisi->delete($id);
    header("location:divisi.php");
}

if (isset($_GET['id_edit'])) {
    $id_edit = $_GET['id_edit'];
    list($id_divisi, $nama_divisi) = $divisi->getResult();
    $inputTitle = "Edit Divisi";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_divisi' name='id_divisi' value='". $id_divisi ."' />
              <label for='nama_divisi' class='form-label'>Nama Divisi</label>
              <input type='text' class='form-control' id='nama_divisi' name='nama_divisi' value='". $nama_divisi ."' placeholder='Masukan Nama Divisi...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";
    if (isset($_POST['btn-edit'])) {
        $id_divisi = $_POST['id_divisi'];
        $nama_divisi = $_POST['nama_divisi'];
        $divisi->updateDivisi($id_divisi, $nama_divisi);
        header("location: divisi.php");
    }
}

$data = null;
$divisi->getDivisi();
$no = 1;

while (list($id_divisi, $nama) = $divisi->getResult()) {
        $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $nama . "</td>
                <td>
                <a href='divisi.php?id_edit=" . $id_divisi . "' class='btn btn-warning'> Edit </a>
                <a href='divisi.php?id_hapus=" . $id_divisi . "' class='btn btn-danger''>Hapus</a>
                </td>
                </tr>";
}


$divisi->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("FORM_TITLE", $inputTitle);
$tpl->replace("FORM", $dataForm);
$tpl->write();
