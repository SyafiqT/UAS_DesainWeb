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

  $query = "SELECT * FROM peserta";
  $result = mysqli_query($conn, $query);

  while ($contact = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$contact['nama']."</td>";
    echo "<td>".$contact['usia']."</td>";
    echo "<td>".$contact['posisi']."</td>";
    echo "<td>".$contact['alamat']."</td>";
    echo "<td>".$contact['email']."</td>";
    echo "<td class='actions'>";
    echo "<button onclick=\"location.href='update.php?email=".$contact['email']."'\" class='btn-update'>Update</button>";
    echo "<button onclick=\"deletePeserta('".$contact['email']."')\" class='btn-delete'>Hapus</button>";
    echo "</td>";
    echo "</tr>";

  }

  mysqli_close($conn);
?>
