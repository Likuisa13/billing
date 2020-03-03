<?php

namespace app\controllers;
use Yii;
use yii\web\Request;
use app\components\BniHashing;
use app\models\Billing;


class UrlController extends \yii\web\Controller
{
	public function actionCallback()
	{
		$secret_key = "0075c8316f1598ae7c70ba874e558e81";//Yii::$app->params['secret_key'];
        $client_id = "001";//Yii::$app->params['client_id'];
		$model = new Billing();
		$req = Yii::$app->request;
		$status = "";
		$message = "";
		if(!empty(json_decode($req->getRawBody())->data))
		{
			$result = BniHashing::parseData(json_decode($req->getRawBody())->data,$client_id,$secret_key);
			if ($result['payment_amount'] > 0 && !empty($result)) {
				if (($model = Billing::findOne($result['virtual_account'])) !== null) {
					$model = Billing::findOne($result['virtual_account']);
					// print_r($result);
					$model->STATUS = 1;
					$model->save();
					$status = "000";
					$message = "Flaging Success !"; 
				}
				else{
					$status = "002";
					$message = "VA not found in database"; 
				}
			}
			else{
				$status = "003";
				$message = "Decrypt Data Failed !"; 
			}
		}
		else{
			$status = "001";
			$message = "Invalid Parsing Data !"; 
		}
		$response = [
			"status" => $status,
			"message" => $message,
		];
		return json_encode($response);
	}
}
