<?php

class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    public $dbname;
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
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        if (!$this->conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    public function close()
    {
        mysqli_close($this->conn);
    }

    public function executeQuery($query)
    {
        return mysqli_query($this->conn, $query);
    }
}

class UserRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUser($username)
    {
        $username = mysqli_real_escape_string($this->db->conn, $username);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->db->executeQuery($sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }

        return false;
    }
}

$servername = "sql311.infinityfree.com";
$username = "if0_34380357";
$password = "27HKzgPGaRjXl";
$dbname = "if0_34380357_trial";

$db = new DatabaseConnection($servername, $username, $password, $dbname);

// Memeriksa apakah ada permintaan POST dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $userRepo = new UserRepository($db);
    $user = $userRepo->getUser($username);

    if ($user) {
        $hashedPassword = $user['password'];

        if ($password == $hashedPassword) {
            // Login berhasil, arahkan ke halaman selanjutnya
            header("Location: home1.html");
            exit();
        } else {
            // Login gagal, tampilkan pesan error
            echo '<script>
            alert("Password salah");
            window.location.href = "signIn.html";
            </script>';
        }
    } else {
        // Login gagal, tampilkan pesan error
        echo '<script>
            alert("Password salah");
            window.location.href = "signIn.html";
            </script>';
        }
}

$db->close();

?>
