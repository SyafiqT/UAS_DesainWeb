<?php
$host = 'sql311.infinityfree.com';
$username = 'if0_34380357';
$password = '27HKzgPGaRjXl';
$database = 'if0_34380357_la_masia';

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

if (isset($_GET['email'])) {
  if (!empty($_POST)) {
    // This part is similar to the create.php, but instead we update a record and not insert
    $email = isset($_POST['email']) ? $_POST['email'] : NULL;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $usia = isset($_POST['usia']) ? $_POST['usia'] : '';
    $posisi = isset($_POST['posisi']) ? $_POST['posisi'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

    // Update the record
    $stmt = $conn->prepare('UPDATE peserta SET email = ?, nama = ?, usia = ?, posisi = ?, alamat = ? WHERE email = ?');
    $stmt->bind_param('ssssss', $email, $nama, $usia, $posisi, $alamat, $_GET['email']);
    $stmt->execute();
    $msg = 'Updated Successfully!';
  }
  // Get the contact from the contacts table
  $stmt = $conn->prepare('SELECT * FROM peserta WHERE email = ?');
  $stmt->bind_param('s', $_GET['email']);
  $stmt->execute();
  $result = $stmt->get_result();
  $contact = $result->fetch_assoc();
  if (!$contact) {
    exit('Peserta doesn\'t exist with that email!');
  }
} else {
  exit('No email specified!');
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.112.5">
    <title>FC Barcelona</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">

    

    

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }
  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }
  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }
  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }
  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }
  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }
  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }
  .bd-mode-toggle {
    z-index: 1500;
  }
  .nav-link.active {
    border-bottom: 1px solid rgb(52, 100, 255);
  }
  body {
    background-image: url('gambar/background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }
  .text-end {
    margin-right: 20px;
    font-family: 'Tahoma';
    color: #ffd61f;
  }
  .header {
    position: relative;
    z-index: 3;
    background-color: rgba(0, 0, 0, .5);
    color: white;
    margin-left: 0;
    margin-right: 0;
    padding: 10px;
    padding-left: 20px;
  }
  .content {
    color: #ffd900;
    background-color: #00000034;
      padding: 10px;
      border: 1px solid #cccccc00;
      border-radius: 5px;
  }
    
    
    h1 {
      margin: 0;
      font-size: 32px;
    }
    
    form {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
      font-size: 20px;
      color: #ffd61f;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #cccccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }
    
    input[type="submit"] {
      background-color: #2b39ff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }
    h1 {
  text-align: center;
  margin-bottom: 40px;
  color: #ffd61f;
  font-size: 30px;
}

</style>

    
    <!-- Custom styles for this template -->
    <link href="css/headers.css" rel="stylesheet">
  </head>
  <body>

<main>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom header">
      <div class="col-md-3 mb-2 mb-md-0">
        <a class="d-inline-flex link-body-emphasis text-decoration-none">
          <svg class="bi" width="60" height="60" role="img" aria-label="">
            <image href="gambar/584a9b3bb080d7616d298777.png" width="60px" height="60px" />
          </svg>
        </a>
      </div>
      
  
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="home.html" class="nav-link px-2" style="font-size=24px">Home</a></li>
        <li><a href="home2.html" class="nav-link px-2" style="font-size=24px">Squad</a></li>
        <li><a href="pendaftaran.html" class="nav-link px-2-secondary active" style="font-size=24px">Team Registration</a></li>
      </ul>
  
      <div class="col-md-3 text-end">
        <div style="display: flex; flex-direction: column;">
          <span style="font-size: 16px; font-weight: bold;">Mes que</span>
          <span style="font-size: 16px; font-weight: bold;">Un Club</span>
        </div>
        <a href="index.html" class="btn btn-primary" style="margin-top: 10px;">Log-out</a>
      </div>
    
    </header>
  </div>
  
  <main>
    <h1>Pendaftaran Anggota Tim Sepak Bola</h1>

    <div class="container content">
      <form action="update.php?email=<?=$contact['email']?>" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?=$contact['email']?>" required>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?=$contact['nama']?>" required>
        
        <label for="usia">Usia:</label>
        <input type="number" id="usia" name="usia" value="<?=$contact['usia']?>" required>
        
        <label for="posisi">Posisi:</label>
        <select id="posisi" name="posisi" required>
          <option value="">Pilih posisi</option>
          <option value="penyerang" <?php if ($contact['posisi'] === 'Penyerang') echo 'selected'; ?>>Penyerang</option>
          <option value="gelandang" <?php if ($contact['posisi'] === 'Gelandang') echo 'selected'; ?>>Gelandang</option>
          <option value="bertahan" <?php if ($contact['posisi'] === 'Bertahan') echo 'selected'; ?>>Bertahan</option>
          <option value="penjaga gawang" <?php if ($contact['posisi'] === 'Penjaga Gawang') echo 'selected'; ?>>Penjaga Gawang</option>
        </select>

        
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?=$contact['alamat']?>" required>
        
        <input type="submit" value="Simpan" class="btn btn-primary btn-lg" onclick="submitForm(event)">
        <button class="btn btn-primary btn-lg" onclick="window.location.href='peserta.html'; return false">Cancel</button>



      </form>
    </div>

    <script>
function submitForm(event) {
  event.preventDefault(); // Menghentikan pengiriman form standar

  // Menggunakan AJAX untuk mengirimkan data form
  var form = document.querySelector('form');
  var formData = new FormData(form);
  var xhr = new XMLHttpRequest();
  xhr.open(form.method, form.action, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Jika penyimpanan data berhasil, arahkan ke halaman peserta.html
      window.location.href = 'peserta.html';
    } else {
      // Jika terjadi kesalahan, tampilkan pesan kesalahan
      console.error(xhr.responseText);
    }
  };
  xhr.send(formData);
}
</script>


  </main>
  
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
