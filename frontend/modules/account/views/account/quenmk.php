<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Lấy Mật Khẩu';

?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
        <div><?php if($err!=null) echo "<div style='color: red;'>$err</div>" ?> </div>   
            <?php $form = ActiveForm::begin(['id' => 'dangnhapform']); ?>

                <?= $form->field($model, 'taikhoan')->textInput(['autofocus' => true])->label("Tài Khoản") ?>

                <?= $form->field($model, 'email')->label('Email')?>   
                <div><?php if($msg!=null) echo "<div style='color: green;'>$msg</div>" ?> </div>
                <div class="form-group">
                    <?= Html::submitButton('Lấy Lại Mật Khẩu', ['class' => 'btn btn-primary', 'name' => 'dangnhap-button']) ?>             
                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
