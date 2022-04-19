<?php

class divisi extends DB
{
    function getdivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function add($name)
    {

        $query = "INSERT into divisi VALUES (NULL, '$name')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM divisi WHERE id_divisi = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function updatedivisi($id, $name)
    {
        $query = "UPDATE divisi set nama_divisi='$name' where id_divisi = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
