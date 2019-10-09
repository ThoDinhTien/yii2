<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title="Đăng kí";
?>
  <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-dangki']); ?>

                <?= $form->field($model, 'taikhoan')->textInput(['autofocus' => true])->label("Tài Khoản") ?>

                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'sdt')->label("Số Điện Thoại")?>
                <div id="errsdt" style="color:red;"></div>
                <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'new-password'])->label("Mật Khẩu") ?>
                <?= $form->field($model, 'repass')->passwordInput(['autocomplete' => 'new-password'])->label("Nhập Lại Mật Khẩu") ?>
                <div style="display: none" id="err"> Mật Khẩu Không Trùng Nhau</div>
                <div class="form-group">
                    <?= Html::submitButton('Đăng Kí', ['class' => 'btn btn-primary', 'name' => 'dangki-button','id'=>'dangki-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>



<script >
document.getElementById('dangki-button').onclick = function(e) {
    var pass = document.getElementById('dangkiform-password').value;
    var repass = document.getElementById('dangkiform-repass').value;
    var sdt = document.getElementById('dangkiform-sdt').value;
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
    
    if (pass != repass) {
        document.getElementById('err').setAttribute('style', "color: red;display:block");
        e.preventDefault();
    }


}

</script>