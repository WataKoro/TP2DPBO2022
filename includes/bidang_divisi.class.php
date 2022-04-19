<?php

class bidang extends DB
{
    function getBidang()
    {
        $query = "SELECT * FROM bidang_divisi";
        return $this->execute($query);
    }

    function add($jabatan, $id_divisi)
    {

        $query = "INSERT into bidang_divisi VALUES (NULL, '$jabatan', '$id_divisi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM bidang_divisi WHERE id_bidang = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function updateBidang($id, $jabatan)
    {
        $query = "UPDATE bidang_divisi set jabatan='$jabatan' where id_bidang = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}


?>