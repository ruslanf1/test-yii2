<?php

namespace frontend\controllers;

use common\models\JsonData;
use common\models\Token;
use frontend\models\JsonForm;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Controller;
use yii\web\Response;

class FormController extends Controller
{
    /**
     * @return array|string
     */
    public function actionIndex()
    {
            $modelJsonForm = new JsonForm();
            $httpMethod = Yii::$app->request->method;
            $authorizedToken = Token::findLastAddedToken();

            if ($modelJsonForm->load(Yii::$app->request->post()) || $modelJsonForm->load(Yii::$app->request->get())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($modelJsonForm);
            }

            if ($authorizedToken->access_token == Yii::$app->request->headers->get('Auth')) {
                if ($httpMethod == 'POST') {
                    $jsonForm = Yii::$app->request->post('json');
                }
                if ($httpMethod == 'GET') {
                    $jsonForm = substr(strstr(Yii::$app->request->url, '='), 1, strlen(Yii::$app->request->url));
                }

                $modelJsonData = JsonData::add($jsonForm, $authorizedToken->user_id);
                if ($modelJsonData) {
                    $timeOfCompletion = sprintf('%0.3f', Yii::getLogger()->getElapsedTime());
                    $allocatedMemory = round(memory_get_peak_usage() / (1024 * 1024), 2);

                    return $this->renderPartial('index-confirm', [
                        'id' => $modelJsonData->id,
                        'time' => $timeOfCompletion,
                        'memory' => $allocatedMemory,
                        'method' => $httpMethod,
                    ]);
                }
                return $this->render('index', ['model' => $modelJsonForm]);
            }
            return $this->render('index', ['model' => $modelJsonForm]);
    }
}
