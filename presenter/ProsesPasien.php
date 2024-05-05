<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $pasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien

			$this->pasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi Pasien (untuk nampung data pasien di create)

			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']); ///mengisi email
				$pasien->setTelepon($row['telp']);


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error  di ProsesPasien.php bagian prosesdata " . $e->getMessage();
		}
	}

	function createDataPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			$this->pasien->open(); //open koneksi dlu
			$this->pasien->createPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);


			// close koneksi
			$this->pasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error  di ProsesPasien.php bagian create " . $e->getMessage();
		}
	}

	function updateDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			$this->pasien->open(); //open koneksi dlu
			$this->pasien->updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);

			// close koneksi
			$this->pasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error  di ProsesPasien.php bagian update " . $e->getMessage();
		}
	}

	function editDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			$this->pasien->open(); // Open database connection

			// Call a method to retrieve the existing data of the patient to be edited
			$existingData = $this->pasien->getPasienById($id);

			// Check if the data exists
			if ($existingData) {
				// Call the update method to update the record with the new data
				$this->pasien->updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
			} else {
				// Handle error if the data does not exist
				echo "Patient data not found!";
			}

			// Close database connection
			$this->pasien->close();
		} catch (Exception $e) {
			// Handle any errors
			echo "Error in editing patient data: " . $e->getMessage();
		}
	}
	function deleteDataPasien($id)
	{
		try {
			$this->pasien->open(); //open koneksi dlu
			$this->pasien->deletePasien($id);

			// close koneksi
			$this->pasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error  di ProsesPasien.php bagian delete " . $e->getMessage();
		}
	}

	function getPasienById($id)
	{
		try {
			$this->pasien->open(); //open koneksi dlu
			$this->pasien->getPasienById($id); // ini nge run si query

			$data = $this->pasien->getResult(); //ini untuk ambil data hasil query
			// close koneksi
			$this->pasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error  di ProsesPasien.php bagian delete " . $e->getMessage();
		}
		return $data;
	}

	// method get set
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelepon($i)
	{
		//mengembalikan telepon Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}

	function getSize()
	{
		// return size/jumlah data
		return sizeof($this->data);
	}
}
