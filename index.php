<?php

require __DIR__ . '/vendor/autoload.php';

$search = isset($_GET['search'])
    ? trim((string)$_GET['search'])
    : (isset($_GET['q']) ? trim((string)$_GET['q']) : '');

require_once __DIR__ . '/controllers/BlogController.php';

$controller = new BlogController();
$controller->showAllPosts($search);
