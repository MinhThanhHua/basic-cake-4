<?php

$host = gethostname();

switch ($host) {
    // Production
    case 'production':
        $env = 'production';
        break;

    // STG
    case 'staging':
        $env = 'staging';
        break;

    // Development
    case 'dev':
        $env = 'dev';
        break;

    // Local
    default:
        $env = 'local';
        break;
}

$envConfFile = sprintf('%s/%s.php', dirname(__FILE__) . DS . 'environments', $env);
if (!file_exists($envConfFile)) {
    die('Config file not found: ' . $envConfFile);
}
define('SET_ENV', $env);
return include $envConfFile;
