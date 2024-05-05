<?php
include("KontrakView.php");
include("presenter/ProsesPasien.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class EditPasien implements KontrakView
{
    private $prosespasien; // Presenter for interacting with the model
    private $tpl; // Template

    public function __construct()
    {
        $this->prosespasien = new ProsesPasien(); // Instantiate the presenter
    }

    public function tampil()
    {
        // Check if the ID of the patient to be edited is provided
        if (isset($_GET['id'])) {
            $id = $_GET['id']; // Get the ID from the URL

            // Get the patient data by ID
            $dataPasien = $this->prosespasien->getPasienById($id);


            // Check if data exists
            if ($dataPasien) {
                // Extract data from the result
                $nik = $dataPasien['nik'];
                $nama = $dataPasien['nama'];
                $tempat = $dataPasien['tempat'];
                $tl = $dataPasien['tl'];
                $gender = $dataPasien['gender'];
                $email = $dataPasien['email'];
                $telp = $dataPasien['telp'];
            } else {
                // Handle case where data is not found
                echo "Patient data not found!";
                return;
            }
        } else {
            // Handle case where ID is not provided
            echo "ID parameter is missing!";
            return;
        }

        // Display the edit form
        // Initialize $data variable
        $data = "";

        // Start the form
        $data .= "<form action='edit.php' method='POST'>";

        // Hidden field for ID
        $data .= "<input type='hidden' name='id' value='$id'>";

        // Display input fields with the patient data
        $data .= "<label for='nik'>NIK</label>";
        $data .= "<input type='text' name='nik' value='$nik'><br>";

        $data .= "<label for='nama'>Nama</label>";
        $data .= "<input type='text' name='nama' value='$nama'><br>";

        $data .= "<label for='tempat'>Tempat</label>";
        $data .= "<input type='text' name='tempat' value='$tempat'><br>";

        $data .= "<label for='tl'>Tanggal Lahir</label>";
        $data .= "<input type='text' name='tl' value='$tl'><br>";

        $data .= "<label for='gender'>Gender</label>";
        $data .= "<input type='text' name='gender' value='$gender'><br>";

        $data .= "<label for='email'>Email</label>";
        $data .= "<input type='email' name='email' value='$email'><br>";

        $data .= "<label for='telp'>Telepon</label>";
        $data .= "<input type='text' name='telp' value='$telp'><br>";

        // Submit button
        $data .= "<button type='submit'>Update</button>";

        // End the form
        $data .= "</form>";

        // Membaca template skin.html
        $this->tpl = new Template("templates/edit.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_EDIT", $data);

        // Menampilkan ke layar
        $this->tpl->write();
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $tempat = $_POST['tempat'];
            $tl = $_POST['tl'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $telp = $_POST['telp'];

            $this->prosespasien->updateDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
            // Redirect back to index.php
            header("Location: index.php");
            exit(); // Ensure that script execution stops after redirection
        }
    }
}
