<?php

return array(
    'default-connection' => 'concrete',
    'connections' => array(
        'concrete' => array(
            'driver' => 'c5_pdo_mysql',
            'server' => '127.0.0.1',
            'database' => 'dev_site',
            'username' => 'dev_user',
            'password' => 'dev_pass',
            'charset' => 'utf8',
        ),
    ),
);
