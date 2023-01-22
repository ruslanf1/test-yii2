<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Json $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="json-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
