<?php

namespace console\controllers;

use common\models\Token;
use common\models\User;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionGetToken($login, $password)
    {
        $passwordHash = md5($password);
        $user = User::find()
            ->where(['username' => $login])
            ->andWhere(['password_hash' => $passwordHash])
            ->one();

        if ($user) {
            $accessToken = bin2hex(random_bytes(15));

            $token = new Token();
            $token->access_token = $accessToken;
            $token->user_id = $user->id;
            $token->save();

            echo $accessToken;
            return;
        }

        echo 'Неверный логин или пароль';
    }
}