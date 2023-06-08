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

class UserRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function checkUsernameExists($username)
    {
        $username = $this->db->escapeString($username);

        $checkQuery = "SELECT * FROM users WHERE username='$username'";
        $checkResult = $this->db->executeQuery($checkQuery);

        if ($checkResult->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser($username, $password)
    {
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);

        $hashedPassword = $password;

        $insertQuery = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$hashedPassword')";

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
$dbname = "if0_34380357_trial";

$db = new DatabaseConnection($servername, $username, $password, $dbname);

$userRepo = new UserRepository($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($userRepo->checkUsernameExists($username)) {
        echo "Username sudah terdaftar.";
    } else {
        if ($userRepo->addUser($username, $password)) {
            echo "<script>window.location.href = 'signIn.html';</script>";
            exit();
        }
    }
}

$db->close();
?>
