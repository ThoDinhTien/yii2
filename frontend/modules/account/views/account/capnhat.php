<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$session = Yii::$app->session;
$this->title= "Cập Nhật Tài Khoản";
?>
<div class="update">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'updateform']); ?>

                <?= $form->field($model, 'email')->textInput()->label("Email") ?>

                <?= $form->field($model, 'sdt')->textInput()->label('Số Điện Thoại')?> 
                <div id="errsdt" style="color:red;"></div> 
                <?= $form->field($model, 'pass')->passwordInput(['autocomplete' => 'new-password'])->label('Mật Khẩu')?> 
                <div class="form-group">
                    <?= Html::submitButton('Cập Nhật Tài Khoản', ['class' => 'btn btn-primary', 'name' => 'update-button','id'=>'update']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script >
document.getElementById('update').onclick = function(e) {
    var sdt = document.getElementById('updateform-sdt').value;
    document.getElementById("errsdt").innerHTML = '';
    document.getElementById('err').setAttribute('style', "display:none");
    var msg='';
    if(sdt.length>0){
         if (sdt[0] != 0) {
             msg = "Số điện thoại phải bắt đầu bằng 0";
       
         } else {
             if (sdt[1] != 3 && sdt[1] != 7 && sdt[1] != 8 && sdt != [1] != 5 && sdt[1] != 9) {
                     msg = "Đầu Số Bạn Nhập Không Chính Xác";
             }
         }
         if (sdt.length != 10) {
             msg = "Số điện thoại phải có 10 chữ số";
         }
         for (var i = 0; i < sdt.length; i++) {
                if (isNaN(sdt[i])) {
                     msg = "Số điện thoại chỉ gồm các chữ số";
                      break;
                 }
         }
    }
    if(msg!=''){
        document.getElementById("errsdt").innerHTML=msg;
        e.preventDefault();
    }
}


</script>
