<?php

return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=<db_name>',
            'username' => '<db_user>',
            'password' => '<db_password>',
            'charset' => 'utf8',
            //'enableSchemaCache' => YII_ENV_DEV ? false : true
        ],
    ],
];
