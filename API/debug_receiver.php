<?php
// Atur header agar mudah dibaca sebagai teks biasa
header('Content-Type: text/plain');

echo "--- HASIL DEBUGGING REQUEST --- \n\n";

// 1. Metode Request
echo "Metode Request: " . $_SERVER['REQUEST_METHOD'] . "\n\n";

// 2. Header Content-Type
echo "Header Content-Type: " . (isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'Tidak ada') . "\n\n";

// 3. Isi Body Mentah (Raw Body)
$raw_body = file_get_contents('php://input');
echo "--- Isi Body Mentah ---\n";
print_r($raw_body);
echo "\n-----------------------\n\n";

// 4. Hasil setelah json_decode
$decoded_data = json_decode($raw_body, true);
echo "--- Hasil json_decode() ---\n";
print_r($decoded_data);
echo "\n--------------------------\n\n";

// 5. Isi dari $_POST (untuk perbandingan)
echo "--- Isi Superglobal \$_POST ---\n";
print_r($_POST);
echo "\n-----------------------------\n";
?>