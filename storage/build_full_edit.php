<?php
// Build the entire edit.blade.php file from scratch using concatenation
// to avoid heredoc issues with apostrophes.

$out = [];

// ============ HEAD + HERO ============
$out[] = "@extends('layouts.app')\n\n";
$out[] = "@section('content')\n\n";

$out[] = "<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">\n";
$out[] = "<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>\n";
$out[] = "<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Inter:ital,wght@1,700;1,800;1,900&display=swap\" rel=\"stylesheet\">\n\n";

$out[] = "<section class=\"premium-hero\">\n";
$out[] = "    <div class=\"premium-hero-bg\"></div>\n";
$out[] = "    <div class=\"premium-hero-grid\"></div>\n";
$out[] = "    <div class=\"premium-hero-glow\"></div>\n\n";
$out[] = "    <div class=\"premium-hero-content\">\n";
$out[] = "        <div class=\"premium-eyebrow\">\n";
$out[] = "            <span class=\"premium-eyebrow-dot\"></span>\n";
$out[] = "            <span>HR CONTROL CENTER &middot; EDIT MODE</span>\n";
$out[] = "        </div>\n\n";
$out[] = "        <h1 class=\"premium-title\">\n";
$out[] = "            Edit Data<br>\n";
$out[] = "            <span class=\"premium-title-accent\">Karyawan</span>\n";
$out[] = "        </h1>\n\n";
$out[] = "        <p class=\"premium-subtitle\">\n";
$out[] = "            Perbarui informasi karyawan dengan mudah &mdash;\n";
$out[] = "            <br class=\"d-none d-md-inline\">\n";
$out[] = "            formulir premium untuk manajemen talenta profesional.\n";
$out[] = "        </p>\n\n";
$out[] = "        <div class=\"premium-meta\">\n";
$out[] = "            <div class=\"premium-meta-item\">\n";
$out[] = "                <span class=\"premium-meta-label\">CREW ID</span>\n";
$out[] = "                <span class=\"premium-meta-value\">{{ \$employee->nip }}</span>\n";
$out[] = "            </div>\n";
$out[] = "            <span class=\"premium-meta-sep\">&middot;</span>\n";
$out[] = "            <div class=\"premium-meta-item\">\n";
$out[] = "                <span class=\"premium-meta-label\">Status</span>\n";
$out[] = "                <span class=\"premium-meta-value status-ready\">\n";
$out[] = "                    <span class=\"status-dot\"></span> Editing\n";
$out[] = "                </span>\n";
$out[] = "            </div>\n";
$out[] = "            <span class=\"premium-meta-sep\">&middot;</span>\n";
$out[] = "            <div class=\"premium-meta-item\">\n";
$out[] = "                <span class=\"premium-meta-label\">Updated</span>\n";
$out[] = "                <span class=\"premium-meta-value\">{{ now()->format('d M Y') }}</span>\n";
$out[] = "            </div>\n";
$out[] = "        </div>\n";
$out[] = "    </div>\n";
$out[] = "</section>\n\n";

file_put_contents(__DIR__ . "/edit_head.txt", implode("", $out));
echo "Head written: " . strlen(implode("", $out)) . " bytes\n";
