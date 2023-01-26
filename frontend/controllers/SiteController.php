<?php

namespace frontend\controllers;

use common\models\JsonData;
use common\models\Token;
use Exception;
use frontend\models\JsonForm;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        try {
            $modelJsonForm = new JsonForm();
            $method = Yii::$app->request->method;
            $token = Token::findLastAddToken();

            if (Yii::$app->request->isAjax && $modelJsonForm->load(Yii::$app->request->$method())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($modelJsonForm);
            }

            if ($token->access_token == Yii::$app->request->headers->get('Auth')) {
                $json = Yii::$app->request->$method('json');
                $modelJsonData = JsonData::add($json, $token->user_id);

                $time = sprintf('%0.3f', Yii::getLogger()->getElapsedTime());
                $memory = round(memory_get_peak_usage() / (1024 * 1024), 2);

                return json_encode($this->renderPartial('index-confirm', [
                    'id' => $modelJsonData->id,
                    'time' => $time,
                    'memory' => $memory,
                    'method' => $method,
                ]));
            }
            return $this->render('index', ['model' => $modelJsonForm]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
