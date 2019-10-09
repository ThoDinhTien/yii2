<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Account;

/**
 * Signup form
 */
class DangkiForm extends Model
{
    public $taikhoan;
    public $email;
    public $password;
    public $sdt;
    public $repass;
    public function rules(){
        return[
            [['taikhoan','email','sdt','password'],'required','message'=>"Không Được Để Trống"],
            ['password','match','pattern'=>'/^[a-zA-Z0-9]{8,20}$/','message'=>"Mật Khẩu phải có ít nhất 8 kí tự và không có kí tự đặc biệt"],
            // ['sdt', 'match', 'pattern'=>'/^(03||04||05||07||08||09)+[0-9]{8}$/','message'=>"Số Điện Thoại Không Hợp Lệ"],
            ['email', 'email','message'=>"Email Không Hợp Lệ"],
            ['taikhoan','unique', 'targetClass' => '\common\models\Account', 'message' => 'Tài Khoản Đã Tồn Tại'],
        ];
    }
    public function dangki()
    {     
        if (!$this->validate()) {
            return null;
        }
        $account = new Account();
        $account->taikhoan = $this->taikhoan;
        $account->email = $this->email;
        $account->SĐT= $this->sdt;
        $account->setPassword($this->password);
        $account->generateAuthKey();
        $account->created_at=time();
        return $account->save();

    }
}
