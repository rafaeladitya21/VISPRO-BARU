<?php
$file = 'C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/create.blade.php';
$src = file_get_contents($file);

// Extract the divisi-select CSS block (between section markers)
$pattern = '/(\/\* ============================================================ \*\/\s*\/\* CUSTOM DIVISI SELECT.*?\/\* Override: keep bento panel overflow visible when dropdown open \*\/\s*\.bento-panel\.is-selecting\s*\{[^}]*\})/s';

if (preg_match($pattern, $src, $matches)) {
    $block = $matches[1];
    echo "Found divisi CSS block: " . strlen($block) . " bytes\n";
    
    // Replace all divisi- with role- in the block
    $roleBlock = str_replace([
        'divisi-select',
        'divisi-option',
        'divisiSelect',
        'divisiTrigger',
        'divisiValue',
        'divisiNative',
        'divisiPanel',
        'divisiOption',
        'DIVISI',
        'divisi',
        'Departemen'
    ], [
        'role-select',
        'role-option',
        'roleSelect',
        'roleTrigger',
        'roleValue',
        'roleNative',
        'rolePanel',
        'roleOption',
        'ROLE',
        'role',
        'Role'
    ], $block);
    
    // Fix the panel max-height (since only 5 options, no need to scroll)
    $roleBlock = str_replace('max-height: 320px;', 'max-height: 320px;', $roleBlock);
    
    // Insert role block right before the closing </style> tag, with section header
    $insertBlock = "\n/* ============================================================ */\n"
                 . "/* CUSTOM ROLE SELECT — Premium Animated */\n"
                 . "/* ============================================================ */\n"
                 . $roleBlock . "\n";
    
    // Find the </style> tag (last one)
    $lastStylePos = strrpos($src, '</style>');
    if ($lastStylePos !== false) {
        $src = substr($src, 0, $lastStylePos) . $insertBlock . "\n" . substr($src, $lastStylePos);
        echo "Inserted role CSS block at position $lastStylePos\n";
    }
    
    file_put_contents($file, $src);
    echo "Done. New file size: " . strlen($src) . " bytes\n";
} else {
    echo "Pattern not found\n";
}
