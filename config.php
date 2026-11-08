<?php
declare(strict_types=1);

const APP_NAME = 'Cryptocurrency Investment System';
const APP_VERSION = '1.0.0';
const APP_TIMEZONE = 'Africa/Lagos';

date_default_timezone_set(APP_TIMEZONE);

return [
    'db' => [
        'host' => getenv('CIS_DB_HOST') ?: '127.0.0.1',
        'port' => (int)(getenv('CIS_DB_PORT') ?: 3306),
        'name' => getenv('CIS_DB_NAME') ?: 'cryptocurrency_investment',
        'user' => getenv('CIS_DB_USER') ?: 'root',
        'pass' => getenv('CIS_DB_PASS') ?: '',
        'charset' => 'utf8mb4',
    ],
];
