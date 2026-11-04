<?php
$file = 'C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/edit.blade.php';
$src = file_get_contents($file);

$old = base64_decode(file_get_contents(__DIR__ . '/old_role_block.b64'));
$new = base64_decode(file_get_contents(__DIR__ . '/new_role_block.b64'));

echo "Old block found: " . (strpos($src, $old) !== false ? 'YES' : 'NO') . "\n";

if (strpos($src, $old) !== false) {
    $src2 = str_replace($old, $new, $src);
    file_put_contents($file, $src2);
    echo "Replaced! New size: " . strlen($src2) . " bytes\n";
} else {
    // Try with different leading whitespace
    echo "Trying variations...\n";
    $count = 0;
    // Find the input with name=jabatan and replace from there
    $pattern = '/<input\s+type="text"\s+name="jabatan"[\s\S]*?@error\(\'jabatan\'\)\s*<span class="premium-error">{{ \$message }}<\/span>\s*@enderror\s*<\/div>/';
    if (preg_match($pattern, $src, $matches)) {
        echo "Regex match: " . strlen($matches[0]) . " bytes\n";
        $src2 = preg_replace($pattern, $new, $src, 1);
        file_put_contents($file, $src2);
        echo "Replaced via regex. New size: " . strlen($src2) . " bytes\n";
    } else {
        echo "Regex also failed\n";
    }
}
