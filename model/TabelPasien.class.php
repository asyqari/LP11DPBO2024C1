<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getPasienById($id)
	{
		$query = "SELECT * FROM pasien WHERE pasien.id = $id";
		return $this->execute($query);
	}

	function createPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		//Query
		$query = "INSERT INTO pasien (id, nik, nama, tempat, tl, gender, email, telp) VALUES ( NULL,'$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
		return $this->execute($query);
	}

	function updatePasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$query = "UPDATE pasien SET nik = '$nik', nama = '$nama', tempat = '$tempat',tl = '$tl',gender = '$gender',email = '$email',telp = '$telp' WHERE pasien.id = $id";
		return $this->execute($query);
	}

	function deletePasien($id)
	{
		// query
		$query = "DELETE FROM pasien WHERE pasien.id = $id ";
		return $this->execute($query);
	}
}
