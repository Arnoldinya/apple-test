<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=db;dbname=<db_name>',
            'username' => '<db_user>',
            'password' => '<db_password>',
            'charset' => 'utf8',
            //'enableSchemaCache' => YII_ENV_DEV ? false : true
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
        ],
    ],
];
