
<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Pratiche;


$dataProvider = new ActiveDataProvider([
    'query' => Pratiche::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

/* @var $this yii\web\View */

$this->title = 'Search';
?>
<div class="site-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'id_pratica',
            [
                'attribute'=>'dati cliente',
                'value' => 'clienteInfo.nome',
                //'value' => 'clienteInfo.nome'
            ]
        ]
    ]);
    ?>
</div>
