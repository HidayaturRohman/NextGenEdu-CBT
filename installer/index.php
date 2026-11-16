<?php
// Redirect legacy installer to modern CodeIgniter 4 installer
$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$baseDir = rtrim(preg_replace('#/installer/.*$#i', '', $script), '/');
$target = $proto . $host . ($baseDir !== '' ? $baseDir : '') . '/install';
header("Location: " . $target);
exit;
