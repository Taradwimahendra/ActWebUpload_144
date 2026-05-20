<?php
if (isset($_GET['file'])) {
    $target_dir = "uploads/";
    $file = basename($_GET['file']); 
    $file_path = $target_dir . $file;

    if (file_exists($file_path) && !is_dir($file_path)) {
        if (unlink($file_path)) {
            header("Location: view.php?status=success&msg=" . urlencode("Berkas berhasil dihapus."));
            exit;
        } else {
            header("Location: view.php?status=error&msg=" . urlencode("Gagal menghapus berkas dari server."));
            exit;
        }
    } else {
        header("Location: view.php?status=error&msg=" . urlencode("Berkas tidak ditemukan."));
        exit;
    }
} else {
    header("Location: view.php");
    exit;
}
?>