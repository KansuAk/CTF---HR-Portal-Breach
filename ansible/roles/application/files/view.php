<?php
$file = $_GET['file'] ?? 'pages/home.php';

/*
 * WARNING: This is intentionally vulnerable!
 * No input validation → LFI possible
 */

include($file);
?>