<?php
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;
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

    <button>Upload File</button>

<?php ActiveForm::end() ?>

