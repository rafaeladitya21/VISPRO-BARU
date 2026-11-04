###############################################################################
# fix-claude-vscode.ps1
###############################################################################

Write-Host "===============================================================" -ForegroundColor Cyan
Write-Host " DIAGNOSA CLAUDE CLI DI VS CODE TERMINAL" -ForegroundColor Cyan
Write-Host "===============================================================" -ForegroundColor Cyan
Write-Host ""

# 1. Cek apakah file claude ada di npm
Write-Host "[1] Lokasi instalasi Claude CLI:" -ForegroundColor Yellow
$claudePaths = @(
    "C:\Users\adity\AppData\Roaming\npm\claude",
    "C:\Users\adity\AppData\Roaming\npm\claude.cmd",
    "C:\Users\adity\AppData\Roaming\npm\claude.ps1"
)
foreach ($p in $claudePaths) {
    if (Test-Path $p) {
        Write-Host "    [OK] FOUND: $p" -ForegroundColor Green
    } else {
        Write-Host "    [  ] missing: $p" -ForegroundColor DarkGray
    }
}
Write-Host ""

# 2. Cek folder npm di PATH proses VS Code terminal saat ini
Write-Host "[2] Folder npm di PATH proses saat ini:" -ForegroundColor Yellow
$npmInPath = $env:Path -split ';' | Where-Object { $_ -match 'npm$' }
if ($npmInPath) {
    Write-Host "    [OK] DITEMUKAN di PATH:" -ForegroundColor Green
    foreach ($n in $npmInPath) { Write-Host "        $n" }
} else {
    Write-Host "    [X] TIDAK ADA di PATH proses ini. Inilah penyebab utama." -ForegroundColor Red
}
Write-Host ""

# 3. Cek apakah claude bisa dipanggil langsung
Write-Host "[3] Test invoke 'claude --version':" -ForegroundColor Yellow
$ver = claude --version 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "    [OK] BERHASIL: $ver" -ForegroundColor Green
} else {
    Write-Host "    [X] GAGAL: $ver" -ForegroundColor Red
}
Write-Host ""

# 4. Cek environment variable ANTHROPIC
Write-Host "[4] Environment Variables ANTHROPIC_*: " -ForegroundColor Yellow
foreach ($name in 'ANTHROPIC_BASE_URL','ANTHROPIC_AUTH_TOKEN','ANTHROPIC_MODEL') {
    $valUser = [Environment]::GetEnvironmentVariable($name,'User')
    $valProc = [Environment]::GetEnvironmentVariable($name,'Process')
    Write-Host "    $name" -ForegroundColor Cyan
    if ($valUser) {
        $disp = $valUser
        if ($name -eq 'ANTHROPIC_AUTH_TOKEN') { $disp = $valUser.Substring(0,15) + '...' }
        Write-Host "        User    : $disp" -ForegroundColor Green
    } else {
        Write-Host "        User    : (not set)" -ForegroundColor DarkGray
    }
    if ($valProc) {
        $disp = $valProc
        if ($name -eq 'ANTHROPIC_AUTH_TOKEN') { $disp = $valProc.Substring(0,15) + '...' }
        Write-Host "        Process : $disp" -ForegroundColor Green
    } else {
        Write-Host "        Process : (not set)" -ForegroundColor DarkGray
    }
}
Write-Host ""

# 5. ExecutionPolicy
Write-Host "[5] PowerShell Execution Policy:" -ForegroundColor Yellow
$ep = Get-ExecutionPolicy -Scope CurrentUser
Write-Host "    CurrentUser = $ep"
if ($ep -eq 'Restricted') {
    Write-Host "    [!] ExecutionPolicy Restricted - .ps1 tidak akan jalan." -ForegroundColor Red
}
Write-Host ""

Write-Host "===============================================================" -ForegroundColor Cyan
Write-Host " SOLUSI" -ForegroundColor Cyan
Write-Host "===============================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Jika langkah [3] GAGAL di atas, lakukan hal berikut:" -ForegroundColor White
Write-Host ""
Write-Host "A) Tambahkan folder npm ke PATH USER (cukup sekali):" -ForegroundColor Yellow
Write-Host '   $current = [Environment]::GetEnvironmentVariable("Path","User")' -ForegroundColor Gray
Write-Host '   [Environment]::SetEnvironmentVariable("Path", $current + ";C:\Users\adity\AppData\Roaming\npm","User")' -ForegroundColor Gray
Write-Host ""
Write-Host "B) Restart VS Code SEPENUHNYA (penting):" -ForegroundColor Yellow
Write-Host "   - Klik kanan icon VS Code di taskbar, pilih Quit" -ForegroundColor Gray
Write-Host "   - ATAU Task Manager -> End Task code.exe" -ForegroundColor Gray
Write-Host "   - Buka lagi, lalu buka terminal baru, coba: claude --version" -ForegroundColor Gray
Write-Host ""
Write-Host "Shortcut bypass tanpa restart (hanya untuk sesi terminal ini):" -ForegroundColor Yellow
Write-Host '   $env:Path = "C:\Users\adity\AppData\Roaming\npm;" + $env:Path' -ForegroundColor Gray
Write-Host '   claude --version' -ForegroundColor Gray
Write-Host ""
