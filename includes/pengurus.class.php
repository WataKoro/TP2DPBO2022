<?php

class pengurus extends DB
{
    function getpengurus()
    {
        $query = "SELECT * FROM pengurus";
        return $this->execute($query);
    }

    function add($data, $file)
    {
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $nim=$data['nim'];
        $name=$data['name'];
        $sem=$data['sem'];
        $id_bidang=$data['id_bidang'];

        $query = "INSERT into pengurus VALUES ('$nim', '$name', '$sem', '$id_bidang')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM pengurus WHERE nim = '$nim'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function updatepengurus($id, $jabatan)
    {
        $targetDir = "./assets/images/";
        $image = $file['image']['name'];
        $tmpImage = $file['image']['tmp_name'];
        $fileTargetDir = $targetDir . $image;

        if (!file_exists($fileTargetDir)) {
            $moveUploadedFile = move_uploaded_file($tmpImage, $fileTargetDir);
        }

        $nim=$data['nim'];
        $name=$data['name'];
        $sem=$data['sem'];
        $id_bidang=$data['id_bidang'];

        $query = "UPDATE pengurus set nama='$name', semester='$sem', id_bidang='$id_bidang' where nim = '$nim'";
        // Mengeksekusi query
        return $this->execute($query);
    }
}


?>