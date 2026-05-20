<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berkas Terunggah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container wide">
    <h2>Berkas Terunggah</h2>

    <?php
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    if ($status === 'success'): ?>
        <div class="alert success"><?= htmlspecialchars($msg) ?></div>
    <?php elseif ($status === 'error'): ?>
        <div class="alert error"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 120px; text-align: center;">Foto</th>
                    <th>Nama File</th>
                    <th style="text-align: center; width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $target_dir = "uploads/";
                
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $files = array_diff(scandir($target_dir), array('.', '..'));

                if (count($files) > 0) {
                    foreach ($files as $file) {
                        $file_encoded = urlencode($file);
                        $file_path = $target_dir . $file;
                        
                        echo "<tr>";
                        
                        // KOLOM BARU: Menampilkan Mini Preview Foto
                        echo "<td style='text-align: center; vertical-align: middle;'>";
                        echo "<img src='{$file_path}' alt='Preview' style='width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.1);'>";
                        echo "</td>";
                        
                        // Kolom Nama File
                        echo "<td style='vertical-align: middle;'>" . htmlspecialchars($file) . "</td>";
                        
                        // Kolom Aksi
                        echo "<td class='actions' style='vertical-align: middle;'>";
                        // Tombol Unduh / Download
                        echo "<a href='{$file_path}' download class='btn-download'>Unduh</a>";
                        // Tombol Hapus / Delete
                        echo "<a href='delete.php?file={$file_encoded}' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus file ini?\")'>Hapus</a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align: center; color: #a0aec0;'>Belum ada file yang diunggah.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="action-links">
        <a href="index.html" class="btn-secondary">← Kembali ke Form Unggah</a>
    </div>
</div>

</body>
</html>