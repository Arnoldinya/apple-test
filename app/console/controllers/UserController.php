<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionCreate($username, $password)
    {
        $user = User::findOne(['username' => $username]);

        if (!$user) {
            $user = new User([
                'username' => $username,
            ]);
        }
        $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);

        if ($user->save()) {
            echo 'ok';
            echo "\n";
        } else {
            print_r($user->errors);
            echo "\n";
        }
    }
}
