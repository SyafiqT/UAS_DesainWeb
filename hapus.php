<?php
  // Kode untuk menghapus data peserta
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mengambil ID peserta yang akan dihapus
    $email = $_GET['email'];

    // Koneksi ke database
    $host = 'sql311.infinityfree.com';
    $username = 'if0_34380357';
    $password = '27HKzgPGaRjXl';
    $database = 'if0_34380357_la_masia';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // Hapus data peserta berdasarkan ID
    $query = "DELETE FROM peserta WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      // Jika berhasil dihapus, redirect ke halaman utama
      header("Location: peserta.html");
      exit();
    } else {
      // Jika gagal, tampilkan pesan error
      echo "Failed to delete data.";
    }

    mysqli_close($conn);
  } else {
    // Jika halaman diakses langsung tanpa parameter ID, redirect ke halaman utama
    header("Location: peserta.html");
    exit();
  }
?>
