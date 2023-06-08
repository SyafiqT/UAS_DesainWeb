<?php
class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        $this->conn->close();
    }

    public function escapeString($string)
    {
        return $this->conn->real_escape_string($string);
    }

    public function executeQuery($query)
    {
        return $this->conn->query($query);
    }
}

class PesertaRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function tambahPeserta($nama, $usia, $posisi, $alamat, $email)
    {
        $nama = $this->db->escapeString($nama);
        $usia = $this->db->escapeString($usia);
        $posisi = $this->db->escapeString($posisi);
        $alamat = $this->db->escapeString($alamat);
        $email = $this->db->escapeString($email);

        $insertQuery = "INSERT INTO peserta (nama, usia, posisi, alamat, email) VALUES ('$nama', '$usia', '$posisi', '$alamat', '$email')";

        if ($this->db->executeQuery($insertQuery) === TRUE) {
            return true;
        } else {
            echo "Terjadi kesalahan saat mendaftar: " . $this->db->conn->error;
            return false;
        }
    }
}

$servername = "sql311.infinityfree.com";
$username = "if0_34380357";
$password = "27HKzgPGaRjXl";
$dbname = "if0_34380357_la_masia";

$db = new DatabaseConnection($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $usia = $_POST["usia"];
    $posisi = $_POST["posisi"];
    $alamat = $_POST["alamat"];
    $email = $_POST["email"];

    $pesertaRepo = new PesertaRepository($db);
    if ($pesertaRepo->tambahPeserta($nama, $usia, $posisi, $alamat, $email)) {
        echo "<script>alert('Pendaftaran berhasil.');</script>";
        echo "<script>window.location.href = 'peserta.html';</script>";
    } else {
        echo "Gagal menyimpan data.";
    }
}

$db->close();
?>
