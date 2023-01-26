<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AjaxSendFormAsset extends AssetBundle
{
    public $js = [
        'js/ajax-send-form.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
