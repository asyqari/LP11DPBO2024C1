<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		if (isset($_POST['delete'])) {
			$idToDelete = $_POST['delete']; // Assuming 'delete' button passes the ID of the record to be deleted
			$this->prosespasien->deleteDataPasien($idToDelete);
		}

		$this->prosespasien->prosesDataPasien();
		$data = null;


		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {

			$deleteBtn = '<form method="POST" onsubmit="return confirmDelete();"><button class="btn btn-danger" name="delete" value="' . $this->prosespasien->getId($i) . '">Delete</button></form>';
			$editBtn = '<a class="btn btn-primary" href="./edit.php?id=' . $this->prosespasien->getId($i) . '" role="button">Edit</a>';

			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelepon($i) . "</td>
			<td>" . $editBtn . " " . $deleteBtn . "</td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
}
