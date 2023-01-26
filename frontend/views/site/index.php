<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

\frontend\assets\AjaxSendFormAsset::register($this);

/* @var $model frontend\models\JsonForm */

$this->title = 'JsonData';

?>

<div>
    <?php $form = ActiveForm::begin(['id' => 'json-form', 'enableAjaxValidation' => true]); ?>

        <?= $form->field($model, 'method')->dropdownList(['POST', 'GET']) ?>
        <?= $form->field($model, 'token') ?>
        <?= $form->field($model, 'json')->textarea(['rows' => 6]) ?>

        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'id' => 'button']) ?>

    <?php ActiveForm::end(); ?>
</div>
