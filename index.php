<?php include "connect.php";

if (isset($_POST['submit'])) {
  $nama = $koneksi->real_escape_string($_POST['nama']);
  $email = $koneksi->real_escape_string($_POST['email']);
  $ucapan = $koneksi->real_escape_string($_POST['ucapan']);
  $koneksi->query("INSERT INTO tamu (nama, email, ucapan) VALUES ('$nama', '$email', '$ucapan')");
  header("Location: index.php");
}

if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  $koneksi->query("DELETE FROM tamu WHERE id = $id");
  header("Location: index.php");
}

$data = $koneksi->query("SELECT * FROM tamu ORDER BY waktu DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c8f4e6dde8.js" crossorigin="anonymous"></script>
  <title>Buku Tamu Digital</title>
</head>

<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">📖 Buku Tamu Digital</h2>

    <!-- Form Input -->
    <div class="card mb-4">
      <div class="card-header">Isi Buku Tamu</div>
      <div class="card-body">
        <form method="post">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Ucapan</label>
            <textarea name="ucapan" class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-success">
            <i class="fas fa-paper-plane"></i> Kirim
          </button>
        </form>
      </div>
    </div>

    <!-- Daftar Tamu -->
    <div class="card">
      <div class="card-header">Daftar Tamu</div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-secondary">
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Ucapan</th>
              <th>Waktu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $data->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['ucapan'])) ?></td>
                <td><?= $row['waktu'] ?></td>
                <td>
                  <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>