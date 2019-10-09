<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Đăng Nhập';

?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'dangnhapform']); ?>
                <?= $form->field($model, 'taikhoan')->textInput(['autofocus' => true])->label("Tài Khoản") ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Mật Khẩu')?>    
                <div class="form-group">
                    <?= Html::submitButton('Đăng Nhập', ['class' => 'btn btn-primary', 'name' => 'dangnhap-button']) ?>
                    <?= Html::a('Quên Mật Khẩu', ['account/quenmk'], ['class'=>'btn btn-primary']) ?>               
                 </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
