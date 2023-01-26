<?php

namespace frontend\models;

use common\models\Token;
use yii\base\Model;

class JsonForm extends Model
{
    public $json;
    public $token;
    public $method;

    public function rules()
    {
        return [
            [['json', 'token'], 'required'],
            [['json', 'token'], 'string'],
            [['token'], 'checkToken']
        ];
    }

    public function checkToken()
    {
        $token = Token::findLastAddToken();

        if ($token->access_token !== $this->token) {
            $this->addError('token', 'Неверный токен');
        }
        if ($token->created_at + 100000 < time()) {
            $this->addError('token', 'Время действия токена истекло');
        }

    }
}
