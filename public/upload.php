<?php

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cek apakah ada file yang diupload
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    try {
        // Dapatkan informasi file
        $filename = time() . '_' . basename($_FILES['file']['name']);
        $target_path = __DIR__ . '/uploads/' . $filename;
        
        // Pindahkan file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            echo "File berhasil diupload ke: uploads/" . $filename;
        } else {
            echo "Gagal memindahkan file.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Tampilkan form upload
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Upload Test</title>
    </head>
    <body>
        <h1>Upload Test</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit">Upload</button>
        </form>';
    
    // Tampilkan error jika ada
    if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error_codes = [
            UPLOAD_ERR_INI_SIZE => "File melebihi batas ukuran upload di php.ini.",
            UPLOAD_ERR_FORM_SIZE => "File melebihi batas ukuran upload di form HTML.",
            UPLOAD_ERR_PARTIAL => "File hanya terupload sebagian.",
            UPLOAD_ERR_NO_FILE => "Tidak ada file yang diupload.",
            UPLOAD_ERR_NO_TMP_DIR => "Direktori temporary tidak ditemukan.",
            UPLOAD_ERR_CANT_WRITE => "Gagal menulis file ke disk.",
            UPLOAD_ERR_EXTENSION => "Upload dihentikan oleh ekstensi PHP."
        ];
        
        $error_code = $_FILES['file']['error'];
        $error_message = isset($error_codes[$error_code]) ? $error_codes[$error_code] : "Error tidak diketahui.";
        
        echo '<p style="color: red;">Error: ' . $error_message . '</p>';
    }
    
    echo '</body></html>';
}