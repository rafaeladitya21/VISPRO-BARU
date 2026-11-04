<?php
$file = 'C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/edit.blade.php';
$src = file_get_contents($file);

// Extract divisi-select CSS block
$pattern = '/(\/\* CUSTOM DIVISI SELECT[\s\S]*?\.bento-panel\.is-selecting\s*\{[^}]*\})/s';
if (preg_match($pattern, $src, $matches)) {
    $block = $matches[1];
    $roleBlock = str_replace([
        'divisi-select',
        'divisi-option',
        'DIVISI',
        'divisi',
        'Departemen'
    ], [
        'role-select',
        'role-option',
        'ROLE',
        'role',
        'Role'
    ], $block);
    
    // Insert before </style>
    $insertBlock = "\n/* CUSTOM ROLE SELECT - Premium Animated */\n" . $roleBlock . "\n";
    $lastStylePos = strrpos($src, '</style>');
    if ($lastStylePos !== false) {
        $src = substr($src, 0, $lastStylePos) . $insertBlock . "\n" . substr($src, $lastStylePos);
        file_put_contents($file, $src);
        echo "Added role CSS in edit. New size: " . strlen($src) . " bytes\n";
    }
} else {
    echo "divisi CSS not found in edit\n";
}
