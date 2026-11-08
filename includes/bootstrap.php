<?php
declare(strict_types=1);
$config = require dirname(__DIR__) . '/config.php';
session_name('cis_session');
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';
