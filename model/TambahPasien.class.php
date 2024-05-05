<?php

class TambahPasien extends DB
{
    function createPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
    {
        //Query
        $query = "INSERT INTO pasien (id, nik, nama, tempat, tl, gender, email, telp) VALUES ('', $nik, $nama, $tempat, $tl, $gender, $email, $telp)";
        return $this->execute($query);
    }
}
