<?php
use yii\bootstrap4\Html;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

$this->title = 'Upload';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('fileUploaded')): ?>

<div class="alert alert-success">
    Upload file: OK!!
</div>

<?php elseif (Yii::$app->session->hasFlash('ErrorfileUpload')): ?>

<div class="alert alert-danger">
    Upload file: FAILED!!
</div>

<?php endif; ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?=
        $form->field($model, 'dbtable', ['labelOptions' => ['class' => 'col-sm-4 form-control-file']])->dropdownList([
            'pratiche' => 'Pratiche', 
            'clienti' => 'Clienti'
        ]);
    ?>

    <?= $form->field($model, 'file', ['labelOptions' => ['class' => 'col-sm-12 form-control-file']])->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Upload file', ['class' => 'btn btn-primary', 'name' => 'upload-button']) ?>
    </div>

<?php ActiveForm::end() ?>

