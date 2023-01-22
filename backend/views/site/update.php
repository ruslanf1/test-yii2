<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Json $model */

$this->title = 'Update Json: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jsons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="json-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
