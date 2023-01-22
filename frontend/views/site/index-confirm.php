<?php

use yii\helpers\Html;

?>
<p>Данные успешно сохранены:</p>

<ul>
    <li><label>ID</label>: <?= Html::encode($id) ?></li>
    <li><label>Time</label>: <?= Html::encode($time) ?> sec</li>
    <li><label>Memory</label>: <?= Html::encode($memory) ?> Mb</li>
    <li><label>Method</label>: <?= Html::encode($method) ?></li>
</ul>
