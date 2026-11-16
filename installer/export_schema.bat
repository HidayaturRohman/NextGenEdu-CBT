@echo off
:: ============================================
:: Export database schema ke master.sql
:: NextGen CBT - Database Schema Exporter
:: ============================================
:: Cara pakai: double-click file ini
:: atau jalankan: export_schema.bat

set MYSQLDUMP=C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqldump.exe
set HOST=localhost
set USER=root
set PASS=
set DATABASE=cbt160ci4
set OUTPUT=..\public\assets\app\db\master.sql

echo.
echo ============================================
echo  NextGen CBT - Export Database Schema
echo ============================================
echo.
echo Database : %DATABASE%
echo Output   : %OUTPUT%
echo.

if "%PASS%"=="" (
    %MYSQLDUMP% --host=%HOST% --user=%USER% --no-tablespaces --routines --triggers --single-transaction --add-drop-table --default-character-set=utf8mb4 %DATABASE% > %OUTPUT%
) else (
    %MYSQLDUMP% --host=%HOST% --user=%USER% --password=%PASS% --no-tablespaces --routines --triggers --single-transaction --add-drop-table --default-character-set=utf8mb4 %DATABASE% > %OUTPUT%
)

copy /Y %OUTPUT% master.sql >nul

if %ERRORLEVEL% EQU 0 (
    echo [OK] Schema berhasil diexport ke master.sql
    echo [OK] Installer siap digunakan dengan skema terbaru
) else (
    echo [ERROR] Gagal export schema!
    echo Pastikan mysqldump path dan credentials sudah benar
)

echo.
pause
