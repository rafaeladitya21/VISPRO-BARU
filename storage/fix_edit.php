<?php
$file = 'C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/edit.blade.php';
$src = file_get_contents($file);

// Fix missing closing paren before }} in departemen options
// Pattern: == 'XXX' ? 'selected' : '' }}  -> should be == 'XXX') ? 'selected' : '' }}
$src = str_replace(
    "== 'PHOTOGRAPHER' ? 'selected' : '' }}>",
    "== 'PHOTOGRAPHER') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'VIDEOGRAPHER' ? 'selected' : '' }}>",
    "== 'VIDEOGRAPHER') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'DRONE PILOT' ? 'selected' : '' }}>",
    "== 'DRONE PILOT') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'VIDEO EDITOR' ? 'selected' : '' }}>",
    "== 'VIDEO EDITOR') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'VISUAL JOCKIE' ? 'selected' : '' }}>",
    "== 'VISUAL JOCKIE') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'VISUAL EDITOR' ? 'selected' : '' }}>",
    "== 'VISUAL EDITOR') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'SWITCHER' ? 'selected' : '' }}>",
    "== 'SWITCHER') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'CAMPERS' ? 'selected' : '' }}>",
    "== 'CAMPERS') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'BEHIND THE SCENE' ? 'selected' : '' }}>",
    "== 'BEHIND THE SCENE') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'CONTENT CREATOR' ? 'selected' : '' }}>",
    "== 'CONTENT CREATOR') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'SOUND ENGINER' ? 'selected' : '' }}>",
    "== 'SOUND ENGINER') ? 'selected' : '' }}>",
    $src
);
$src = str_replace(
    "== 'SOUND MAN' ? 'selected' : '' }}>",
    "== 'SOUND MAN') ? 'selected' : '' }}>",
    $src
);

file_put_contents($file, $src);
echo "Fixed!\n";

// Verify
$verify = file_get_contents($file);
$bad = substr_count($verify, "== 'PHOTOGRAPHER' ? 'selected'");
$good = substr_count($verify, "== 'PHOTOGRAPHER') ? 'selected'");
echo "Bad patterns: $bad, Good patterns: $good\n";
