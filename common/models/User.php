<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property int $created_at
 * @property int $updated_at
 *
 * @property JsonData[] $jsons
 * @property Token[] $tokens
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['username', 'password_hash'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * Gets query for [[Jsons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJsons()
    {
        return $this->hasMany(JsonData::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tokens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::class, ['user_id' => 'id']);
    }

    /**
     * @return string[]
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @param $username
     * @param $password
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function findUser($username, $password)
    {
        return User::find()
            ->where(['username' => $username])
            ->andWhere(['password_hash' => $password])
            ->one();
    }
}
