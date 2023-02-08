<?php

namespace console\controllers;

use common\models\Token;
use common\models\User;
use Exception;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * @param $login
     * @param $password
     * @return void
     * @throws Exception
     */
    public function actionGetToken($login, $password)
    {
            if ($user = User::findUser($login, md5($password))) {
                $accessToken = bin2hex(random_bytes(15));
                $model = Token::add($accessToken, $user->id);

                if (!$model->hasErrors()) {
                    echo $accessToken;
                    return;
                }
                echo implode(',', $model->getErrors());
                return;
            }
            echo 'Неверный логин или пароль';
    }
}