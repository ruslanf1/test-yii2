<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "json".
 *
 * @property int $id
 * @property string $json
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class JsonData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'json';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['json', 'user_id'], 'required'],
            [['json'], 'string'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'json' => 'JsonData',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function add($jsonText, $userId)
    {
        $model = new static([
            'json' => $jsonText,
            'user_id' => $userId
        ]);
        $model->save();

        return $model;
    }
}
