<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

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

<?php
$js = <<< JS

        $('#jsonform-method').on('change', function (){
            const method = $('#jsonform-method option:selected').text()
            $('#json-form').attr('method', method)
        })
            
        $('#json-form').on('submit', function (event){
            const form = $(this)
            const token = $('#jsonform-token').val()
            const json = $('#jsonform-json').val()
            event.preventDefault()
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                headers: {Auth: token},
                data: {json: json}
            }).done(function (response) {
                alert(response)
            })
        })
        
JS;

$this->registerJs($js, $this::POS_READY);
?>
