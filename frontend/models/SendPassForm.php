<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Account;
class SendPassForm extends Model
{
    public $taikhoan;
    public $email;
    public $pass;
    function sendmail(){       
            $account=Account::findByTaiKhoan($this->taikhoan);
            $account->setPassword($this->pass);
            $account->generateAuthKey();
            $account->updateAttributes(['password_hash'=>$account->password_hash]);        
     }
     function checkthongtin(){
        $account=Account::findByTaiKhoan($this->taikhoan);
        if($account==NULL) return 2;
        if($account->email==$this->email){
            return 1;
        }
        else return 0;
     }
     
}
?>