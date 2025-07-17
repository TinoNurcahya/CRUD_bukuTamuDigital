<?php
include "connect.php";
$id = intval($_GET['id']);
$hasil = $koneksi->query("SELECT * FROM tamu WHERE id = $id");
$tamu = $hasil->fetch_assoc();

if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $ucapan = $_POST['ucapan'];

  $query = $koneksi->query("UPDATE tamu SET nama='$nama', email='$email', ucapan='$ucapan' WHERE id=$id");

  if ($query) {
    echo "<script>
            alert('Sukses update data tamu');
            window.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
            alert('Gagal update data');
            window.location.href = 'index.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Data Tamu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <h2>Edit Data Tamu</h2>
    <form method="post" class="card p-4">
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($tamu['nama']) ?>">
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($tamu['email']) ?>">
      </div>
      <div class="mb-3">
        <label>Ucapan</label>
        <textarea name="ucapan" class="form-control" rows="4"><?= htmlspecialchars($tamu['ucapan']) ?></textarea>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-outline-danger">Kembali</a>
      </div>
    </form>
  </div>
</body>

</html>