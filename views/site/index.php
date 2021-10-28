
<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\SearchForm;

use yii\widgets\ActiveField;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\LinkPager;

use kartik\export\ExportMenu;

/* @var $this yii\web\View */

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
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
        /*
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'data_creazione',
                'id_pratica',
                'stato',
                [
                    'attribute' => "Prova",
                    'value' => "clienteInfo.nome"
                ]
            ]
        ]);
        */ 

        $gridColumns = [
            'data_creazione',
            'id_pratica',
            'stato',
            [
                'attribute' => "Prova",
                'value' => "clienteInfo.nome"
            ]
        ];

        // Renders a export dropdown menu
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'showConfirmAlert' => false,
            'showColumnSelector' => false,
            'target' => ExportMenu::TARGET_SELF, 
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false, 
                ExportMenu::FORMAT_PDF => false, 
                ExportMenu::FORMAT_TEXT => false
            ], 
            'filename' => "export_".date('Y-m-d'),
            'dropdownOptions' => [
                'label' => 'Export results',
                'class' => 'btn btn-outline-secondary btn-default'
            ]
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'data_creazione',
                'id_pratica',
                'stato',
                [
                    'attribute' => "Prova",
                    'value' => "clienteInfo.nome"
                ]
            ],
            'pager' => [
                'class' => '\yii\bootstrap4\LinkPager',
            ]
        ]);


    }?>
</div>
