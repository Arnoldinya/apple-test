<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendApple */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Modal::begin([
    'title' => '<h2>Сколько % съесть?</h2>',
    'id' => 'percent-modal',
]); ?>

<div class="backend-apple-form">

    <?php $form = ActiveForm::begin([
        'id' => 'apple-form',
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'percent')->textInput([
        'type' => 'number'
    ])->label(false) ?>

    <div class="form-group" style="margin-top: 20px;">
        <?= Html::submitButton('OK', ['class' => 'btn btn-success', 'id' => 'apple-form-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Modal::end(); ?>
