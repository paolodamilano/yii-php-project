<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SearchForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

use arturoliveira\ExcelView;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {


        if (Yii::$app->user->isGuest && Yii::$app->controller->action->id != "login") {
        
            Yii::$app->user->loginRequired();
        
        }
        
        //something code right here if user valid
        
        return true;
        
                
        
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $searchModel = new SearchForm();
        if(!(\Yii::$app->request->post()) && !(Yii::$app->request->queryParams)){
            $dataProvider = false;
        }
        else{
            $searchModel->load(\Yii::$app->request->post());
            $session = Yii::$app->session;
            $session->open();
            if(!(\Yii::$app->request->post())){
                // recupero dati in sessione
                $searchModel->id_pratica = $session->get('id_pratica');
                $searchModel->cf_piva = $session->get('cf_piva');
            }else{
                // salvo in sessione
                $session->set('id_pratica', $searchModel->id_pratica);
                $session->set('cf_piva', $searchModel->cf_piva);
            }
            $session->close();
            $dataProvider = $searchModel->search();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Upload file page.
     *
     * @return Response|string
     */
    public function actionUpload(){
        $model = new UploadForm();
        $model->load(Yii::$app->request->post());
        if(Yii::$app->request->isPost){ 
            $model->file = UploadedFile::getInstance($model,'file');
            $ckUpload = $model->upload();
            if ($ckUpload) {
                Yii::$app->session->setFlash('fileUploaded');
                return $this->refresh();
            }
            else{
                Yii::$app->session->setFlash('ErrorfileUpload');
                return $this->refresh(); 
            }
        }else{
            return $this->render('upload',['model'=>$model]);
        }
    }

    public function actionExport() {
        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search();
        ExcelView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'fullExportType'=> 'xlsx', //can change to html,xls,csv and so on
            'grid_mode' => 'export',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'data_creazione',
                'id_pratica',
                'stato',
                'prova',
              ],
        ]);
    }
}
