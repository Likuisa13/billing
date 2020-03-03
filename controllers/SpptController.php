<?php

namespace app\controllers;

use Yii;
use app\models\Sppt;
use app\models\SpptSearch;
use app\models\BillingSearch;
use app\models\Billing;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Ecoll;
use app\components\BniHashing;

/**
 * SpptController implements the CRUD actions for Sppt model.
 */
class SpptController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sppt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpptSearch();
        $searchBilling = new BillingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchBilling->NOP = $searchModel->nop; 
        $searchBilling->tgl = date("Y-m-d H:i:s");; 
        $dataProvider2= $searchBilling->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->get() != null) {
            if (!empty($dataProvider->getModels()) && $searchModel->nop != null && $searchModel->tahun != null) {
                if (!empty($dataProvider2->getModels())) {
                    Yii::$app->session->setFlash('warning', "Billing for This NOP already exist");
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                }
                else{
                    $param_nop = $searchModel->nop;
                    $param_th = $searchModel->tahun;
                    $dataProvider = $dataProvider->getModels();
                    // echo '<pre>',print_r($dataProvider[0]),'</pre>';
                    return $this->render('update', [
                        $dataProvider[0]->nop = $param_nop,
                        'model' => $dataProvider[0],
                    ]);
                }
            }
            else{
                Yii::$app->session->setFlash('info', "invalid input for NOP or Year.");
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Sppt model.
     * @param string $KD_PROPINSI
     * @param string $KD_DATI2
     * @param string $KD_KECAMATAN
     * @param string $KD_KELURAHAN
     * @param string $KD_BLOK
     * @param string $NO_URUT
     * @param string $KD_JNS_OP
     * @param string $THN_PAJAK_SPPT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP, $THN_PAJAK_SPPT)
    {
        return $this->render('view', [
            // 'model' => $this->findModel($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP, $THN_PAJAK_SPPT),
        ]);
    }

    /**
     * Creates a new Sppt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sppt();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'KD_PROPINSI' => $model->KD_PROPINSI, 'KD_DATI2' => $model->KD_DATI2, 'KD_KECAMATAN' => $model->KD_KECAMATAN, 'KD_KELURAHAN' => $model->KD_KELURAHAN, 'KD_BLOK' => $model->KD_BLOK, 'NO_URUT' => $model->NO_URUT, 'KD_JNS_OP' => $model->KD_JNS_OP, 'THN_PAJAK_SPPT' => $model->THN_PAJAK_SPPT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sppt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $KD_PROPINSI
     * @param string $KD_DATI2
     * @param string $KD_KECAMATAN
     * @param string $KD_KELURAHAN
     * @param string $KD_BLOK
     * @param string $NO_URUT
     * @param string $KD_JNS_OP
     * @param string $THN_PAJAK_SPPT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {

        $model = new Billing();
        $post = Yii::app()->request->getPost(get_class($model));
            var_dump($post);
        // echo SpptController::createVa();
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->NOP]);
        // }

        // return $this->render('success', [
        //     'model' => $model,
        // ]);
    }

    public function actionSuccess() {
        $model = new Billing();

        date_default_timezone_set('Asia/Jakarta');
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $prefix = Yii::$app->params['prefix'];
        $client_id = Yii::$app->params['client_id'];
        $va = $prefix.$client_id.$randomString;
        $create_date = date("Y-m-d H:i:s");
        $expired_date = date("Y-m-d H:i:s",strtotime("+1 days"));
        if (Yii::$app->request->get() != null) {
            $data = Yii::$app->request->get();
            $model->NOP = $data['nop'];
            $model->TH_PJK = $data['tahun'];
            $model->NOMINAL = $data['nominal'];
            $model->VA = $va;
            $model->EXP_DATE = $expired_date;
            $model->CREATED_DATE = $create_date;
            $nama = $data['nama'];
            // $param = array(
            //     'va' => $va,
            //     'nama' => $nama
            // );
            $param = [  
                "client_id" => "001",
                "trx_id" => "TR002",
                "virtual_account"=>"9900119123000002",
                "customer_name"=>"Dwiki Likuisa",
                "trx_amount"=>"0",
                "payment_amount"=>"1000",
                "cumulative_payment_amount"=>"1000",
                "payment_ntb"=>"122122",
                "datetime_payment"=>"2019-12-30 15:55:52",
                "datetime_payment_iso8601"=>"2019-12-30T15:55:52+07:00"
            ];
            $secret_key = "0075c8316f1598ae7c70ba874e558e81";//Yii::$app->params['secret_key'];
            $ecoll = new Ecoll();
            $result = $ecoll->createBilling($param, $secret_key);
            // echo '<pre>',print_r($result),'</pre>';
            var_dump($result);
            // echo "<br>";
            // $result = json_decode($result);
            // if(json_decode($result)->status != "000"){
            //     $searchModel = new SpptSearch();
            //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            //     Yii::$app->session->setFlash('danger', "Error Create Billing.".json_decode($result)->message);
            //     return $this->render('index', [
            //         'searchModel' => $searchModel,
            //         'dataProvider' => $dataProvider,
            //     ]);
            // }
            // else{
            //     //['payment_amount'];
            //     // if (isset(json_decode($result)->data)) {
            //     //     echo "Result : ";
            //     //     echo '<pre>',print_r(BniHashing::parseData(json_decode($result)->data, "00020","2162bc2a3211464d292960a09f2d3c2a")),'</pre>';
            //     // } 
            //     $model->save();
            //     return $this->render('success',[
            //         'model' => $model,
            //     ]);
            // }
        }
        else{

        }
        
    }



    /**
     * Deletes an existing Sppt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $KD_PROPINSI
     * @param string $KD_DATI2
     * @param string $KD_KECAMATAN
     * @param string $KD_KELURAHAN
     * @param string $KD_BLOK
     * @param string $NO_URUT
     * @param string $KD_JNS_OP
     * @param string $THN_PAJAK_SPPT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP, $THN_PAJAK_SPPT)
    {
        $this->findModel($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP, $THN_PAJAK_SPPT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sppt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $KD_PROPINSI
     * @param string $KD_DATI2
     * @param string $KD_KECAMATAN
     * @param string $KD_KELURAHAN
     * @param string $KD_BLOK
     * @param string $NO_URUT
     * @param string $KD_JNS_OP
     * @param string $THN_PAJAK_SPPT
     * @return Sppt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP, $THN_PAJAK_SPPT)
    {
        if (($model = Sppt::findOne(['KD_PROPINSI' => $KD_PROPINSI, 'KD_DATI2' => $KD_DATI2, 'KD_KECAMATAN' => $KD_KECAMATAN, 'KD_KELURAHAN' => $KD_KELURAHAN, 'KD_BLOK' => $KD_BLOK, 'NO_URUT' => $NO_URUT, 'KD_JNS_OP' => $KD_JNS_OP, 'THN_PAJAK_SPPT' => $THN_PAJAK_SPPT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
