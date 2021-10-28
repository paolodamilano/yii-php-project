<?php
use yii\bootstrap4\Html;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

$this->title = 'Upload';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col">

        <?php if (Yii::$app->session->hasFlash('fileUploaded')): ?>
            
        <div class="alert alert-success">
            Upload file: OK!!
        </div>
        
        <?php elseif (Yii::$app->session->hasFlash('ErrorfileUpload')): ?>

        <div class="alert alert-danger">
            Upload file: FAILED!!
        </div>

        <?php endif; ?>

    </div>
</div>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-3">
    <?=
        $form->field($model, 'dbtable', ['labelOptions' => ['class' => 'col-sm-4 form-control-file']])->dropdownList([
            'pratiche' => 'Pratiche', 
            'clienti' => 'Clienti'
        ]);
    ?>
    </div>
    <div class="col-9">
        <?= $form->field($model, 'file', ['labelOptions' => ['class' => 'col-sm-12 form-control-file']])->fileInput() ?>
    </div>
</div>
<div class="row">
    <div class="col form-group">
        <?= Html::submitButton('Upload file', ['class' => 'btn btn-primary', 'name' => 'upload-button']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>



