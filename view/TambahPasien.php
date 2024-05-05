<?php
include("presenter/ProsesPasien.php");
include("KontrakView.php");

class TambahPasien implements KontrakView
{
    private $tambahPasien; //presenter yang dapat berinteraksi langsung dengn view
    private $tpl; //template
    function __construct()
    {
        $this->tambahPasien = new ProsesPasien();
    }

    function tampil()
    {

        // Membaca template skin.html
        $this->tpl = new Template("templates/tambah.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        // $this->tpl->replace("DATA_TABEL", $data);

        // Menampilkan ke layar
        $this->tpl->write();
    }

    function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $tempat = $_POST['tempat'];
            $tl = $_POST['tl'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $telp = $_POST['telp'];

            $this->tambahPasien->createDataPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);
        }
    }
}
