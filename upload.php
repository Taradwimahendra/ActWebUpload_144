<?php
$target_dir = "uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;

    // Validasi gambar
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        header("Location: view.php?status=error&msg=" . urlencode("Berkas bukan gambar yang valid."));
        exit;
    }

    // Proses pindah file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header("Location: view.php?status=success&msg=" . urlencode("Berkas '" . $file_name . "' berhasil diunggah."));
        exit;
    } else {
        header("Location: view.php?status=error&msg=" . urlencode("Terjadi kesalahan saat mengunggah berkas."));
        exit;
    }
} else {
    header("Location: index.html");
    exit;
}
?>