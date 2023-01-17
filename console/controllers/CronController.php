<?php

namespace console\controllers;

use console\models\User;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionGetToken($login, $password)
    {
        $passwordHash = md5($password);

        if ($userId = User::find()->where(['username' => $login, 'password_hash' => $passwordHash])->one()) {
            $accessToken = bin2hex(random_bytes(15));
            $userId->access_token = $accessToken;
            $userId->token_lifetime = time() + 300;
            $userId->save();
            echo $accessToken;
        } else {
            echo 'Неверный логин или пароль';
        }
    }
}