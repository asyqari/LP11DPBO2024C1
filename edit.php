<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/EditPasien.php");


$tp = new EditPasien();
$data = $tp->tampil();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $proses = $tp->update();
}
