<?php

namespace frontend\models;

use common\models\Token;
use yii\base\Model;

class JsonForm extends Model
{
    public $json;
    public $token;
    public $method;

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['json', 'token'], 'required'],
            [['json', 'token'], 'string'],
            [['token'], 'checkToken']
        ];
    }

    /**
     * @return void
     */
    public function checkToken()
    {
        $token = Token::findLastAddedToken();

        if ($token->access_token !== $this->token) {
            $this->addError('token', 'Неверный токен');
        }
        if ($token->created_at + 1200 < time()) {
            $this->addError('token', 'Время действия токена истекло');
        }

    }
}
