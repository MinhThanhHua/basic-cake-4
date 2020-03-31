<?php

const SERVER_DOMAIN = '';
date_default_timezone_set('Asia/Tokyo');

return [
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),
    'Security' => [
        'salt' => md5('T4R393b0qyJioxfs2gUWniR2G0Fgrtge'),
    ],
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => '',
            'username' => '',
            'password' => '',
            'database' => '',
            'encoding' => 'utf8',
            'timezone' => '',
            'flags' => [
                PDO::MYSQL_ATTR_LOCAL_INFILE => true
            ],
            'cacheMetadata' => true,
            'log' => true,
            'quoteIdentifiers' => false,
            'url' => env('DATABASE_URL', null)
        ]
    ]
];
