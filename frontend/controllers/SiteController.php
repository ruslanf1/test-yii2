<?php

namespace frontend\controllers;

use common\models\Json;
use common\models\Token;
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
        $token = Token::find()
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if (Yii::$app->request->isAjax && $modelJsonForm->load(Yii::$app->request->$method())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelJsonForm);
        }

        if ($token->access_token == Yii::$app->request->headers->get('Auth')) {
            $request = Yii::$app->request->$method();
            $modelJson = new Json();
            $modelJson->json = $request['json'];
            $modelJson->user_id = $token->user_id;
            $modelJson->save();

            $time = sprintf('%0.3f', Yii::getLogger()->getElapsedTime());
            $memory = round(memory_get_peak_usage() / (1024 * 1024), 2);
            $data = ['id' => $modelJson->id, 'time' => $time, 'memory' => $memory, 'method' => $method];

            return json_encode($data);
        }
        return $this->render('index', ['model' => $modelJsonForm]);
    }
}
