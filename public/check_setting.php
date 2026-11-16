<?php
header('Content-Type: text/plain; charset=UTF-8');
$pdo = new PDO("mysql:host=localhost;dbname=cbt;charset=utf8mb4", "cbt", "101189");
$row = $pdo->query("SELECT * FROM setting LIMIT 1")->fetch(PDO::FETCH_ASSOC);
print_r($row);
