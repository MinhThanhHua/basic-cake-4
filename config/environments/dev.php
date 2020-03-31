<?php

const SERVER_DOMAIN = '';
date_default_timezone_set('Asia/Ho_Chi_Minh');

return [
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),
    'Security' => [
        'salt' => md5('wt1U5MAC%JFTXG$nF*ZoiL@QGrLgdbHA'),
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
            'port' => '',
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
