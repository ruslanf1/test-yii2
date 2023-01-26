<?php

namespace console\controllers;

use common\models\Token;
use common\models\User;
use Exception;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionGetToken($login, $password)
    {
        try {
            if ($user = User::findUser($login, md5($password))) {

                $accessToken = bin2hex(random_bytes(15));
                Token::add($accessToken, $user->id);
                echo $accessToken;

                return;
            }
            echo 'Неверный логин или пароль';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}