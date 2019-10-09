<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Account;

/**
 * Signup form
 */
class UpdateForm extends Model
{
    
    public $email;
    public $sdt;
    public $taikhoan;
    public $pass;
    public function rules(){
        return[
            // ['sdt', 'match', 'pattern'=>'/^(03||04||05||07||08||09)+[0-9]{8}$/','message'=>"Số Điện Thoại Không Hợp Lệ"],
            ['email', 'email','message'=>"Email Không Hợp Lệ"],
            ['pass','match','pattern'=>'/^[a-zA-Z0-9]{8,20}$/','message'=>"Mật Khẩu phải có ít nhất 8 kí tự và không có kí tự đặc biệt"]
        ];
    }
    public function update()
    {     
        if (!$this->validate()) {
            return null;
        }     
        $account = Account::findByTaiKhoan($this->taikhoan);
        
        if($this->email) $account->email = $this->email;
        if($this->sdt) $account->SĐT= $this->sdt; 
        if($this->pass) {
            $account->setPassword($this->pass);
            $account->generateAuthKey();
        }
        // $account->updated_at=time();
        // die(var_dump($account)); 
        $account->updateAttributes(['updated_at'=>time(),'email'=>$account->email,'SĐT'=>$account->SĐT,'password_hash'=>$account->password_hash]);
    }
}
