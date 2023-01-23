<?php

namespace frontend\controllers;

use common\models\Json;
use frontend\models\JsonForm;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $modelJsonForm = new JsonForm();
        $method = Yii::$app->request->method;

        if (Yii::$app->request->isAjax && $modelJsonForm->load(Yii::$app->request->$method())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelJsonForm);
        }

        if ($modelJsonForm->load(Yii::$app->request->$method()) and $modelJsonForm->validate()) {
            $request = Yii::$app->request->$method();

            $modelJson = new Json();
            $modelJson->json = $request['JsonForm']['json'];
            $modelJson->user_id = $modelJsonForm->userId;
            $modelJson->save();

            $time = sprintf('%0.3f', Yii::getLogger()->getElapsedTime());
            $memory = round(memory_get_peak_usage() / (1024 * 1024), 2);

            return $this->render('index-confirm', ['id' => $modelJson->id, 'time' => $time, 'memory' => $memory]);
        }
        return $this->render('index', ['model' => $modelJsonForm]);
    }
}
