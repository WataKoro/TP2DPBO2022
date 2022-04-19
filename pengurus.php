<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");

$pengurus = new pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
$dataForm = null;
$inputTitle = null;

if (!isset($_GET['id_edit'], $_GET['id_hapus'])) {
    $inputTitle = "Add Pengurus";
    $dataForm = "
            <div class='mb-3'>
                <label for='nim' class='form-label'>NIM</label>
                <input type='number' class='form-control' id='nim' name='nim' value='nim' required />
            </div>
            <div class='mb-3'>
                <label for='nama' class='form-label'>Nama</label>
                <input type='text' class='form-control' id='name' name='name' value='name' required />
            </div>
            <div class='mb-3'>
                <label for='semester' class='form-label'>Semester</label>
                <input type='number' class='form-control' id='sem' name='sem' value='sem' required />
            </div>
            <div class='mb-3'>
                <label for='image' class='form-label'>Image</label>
                <input class='form-control' type='file' id='image' name='image' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-submit'])) {
        $pengurus->add($_POST, $_FILES);
        header("location:pengurus.php");
    }
}

//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];

    $pengurus->delete($id);
    header("location:pengurus.php");
}

if (isset($_GET['id_edit'])) {
    $id_edit = $_GET['id_edit'];
    $inputTitle = "Edit Pengurus";
    $dataForm = "
            <div class='mb-3'>
                <label for='nim' class='form-label'>NIM</label>
                <input type='number' class='form-control' id='nim' name='nim' value='nim' required />
            </div>
            <div class='mb-3'>
                <label for='nama' class='form-label'>Nama</label>
                <input type='text' class='form-control' id='name' name='name' value='name' required />
            </div>
            <div class='mb-3'>
                <label for='semester' class='form-label'>Semester</label>
                <input type='number' class='form-control' id='sem' name='sem' value='sem' required />
            </div>
            <div class='mb-3'>
                <label for='image' class='form-label'>Image</label>
                <input class='form-control' type='file' id='image' name='image' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-primary' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";
    if (isset($_POST['btn-submit'])) {
        $pengurus->updatePengurus($_POST, $_FILES);
        header("location:pengurus.php");
    }
}
$pengurus->getpengurus();
$data = null;
$no = 1;

while (list($nim, $nama) = $pengurus->getResult()) {
        $data .= "<tr>
                <td>" . $nim . "</td>
                <td>" . $nama . "</td>
                <td>
                <a href='pengurus.php?id_edit=" . $id_pengurus . "' class='btn btn-warning'> Edit </a>
                <a href='pengurus.php?id_hapus=" . $id_pengurus . "' class='btn btn-danger''>Hapus</a>
                </td>
                </tr>";
}


$pengurus->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("FORM_TITLE", $inputTitle);
$tpl->replace("FORM", $dataForm);
$tpl->write();
