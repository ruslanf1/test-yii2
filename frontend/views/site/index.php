<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $model frontend\models\JsonForm */

$this->title = 'Json';

?>

<div>
    <?php $form = ActiveForm::begin(['id' => 'json-form', 'enableAjaxValidation' => true]); ?>

        <?= $form->field($model, 'method')->dropdownList(['POST', 'GET']) ?>
        <?= $form->field($model, 'token') ?>
        <?= $form->field($model, 'json')->textarea(['rows' => 6]) ?>

        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'id' => 'button']) ?>

    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS

        $('#button').on('click', function (){
            const method = $('#jsonform-method option:selected').text()
            $('#json-form').attr('method', method) 
        })
        
JS;

$this->registerJs( $js, $position = yii\web\View::POS_READY, $key = null );
?>
