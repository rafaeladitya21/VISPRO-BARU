<?php
$file = 'C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/index.blade.php';
$src = file_get_contents($file);

// Load CSS from base64 file
$cssB64 = file_get_contents('C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/storage/divisi_css.b64');
$css = base64_decode($cssB64);

$insertPoint = strpos($src, '.premium-grid {');
if ($insertPoint !== false) {
    $src = substr($src, 0, $insertPoint) . $css . "\n" . substr($src, $insertPoint);
    file_put_contents($file, $src);
    echo "Inserted divisi CSS. New size: " . strlen($src) . " bytes\n";
} else {
    echo "Insertion point not found\n";
}
