
<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\SearchForm;

use yii\widgets\ActiveField;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/*
$query = Pratiche::find();
if(!empty($model->id_pratica) && empty($model->cf_piva)){
    $query->where(['id_pratica' => $model->id_pratica]);
}
elseif(empty($model->id_pratica) && !empty($model->cf_piva)){
    $query->where(['clienti.codice_fiscale' => $model->cf_piva]);
}
elseif(!empty($model->id_pratica) && !empty($model->cf_piva)){
    $query->where(['id_pratica' => $model->id_pratica])
    ->andWhere(['clienti.codice_fiscale' => $model->cf_piva]);
}
$query->joinWith('clienteInfo');
*/

/* @var $this yii\web\View */

$this->title = 'Search';
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($searchModel, 'id_pratica') ?>

    <?= $form->field($searchModel, 'cf_piva') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<div class="site-index">
    <?php
    if ($dataProvider){

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'data_creazione',
                'id_pratica',
                'stato',
                [
                    'attribute'=>'dati cliente',
                    'value' => 'clienteInfo.nome'
                ]
            ]
        ]); 
    }?>
</div>
