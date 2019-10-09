<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Account;
/**
 * Login form
 */
class DangnhapForm extends Model
{
    public $taikhoan;
    public $password;

    private $_account;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taikhoan', 'password'], 'required'],
           
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $account = $this->getAccount();
            if (!$account || !$account->validatePassword($this->password)) {
                $this->addError($attribute, 'Sai Tài Khoản Hoặc Mật Khẩu');
            }
        }
    }

    
    public function login()
    {   
        if ($this->validate()) {
            return Yii::$app->user->login($this->getAccount());
        }
        
        return false;
    }

    
    protected function getAccount()
    {
        if ($this->_account === null) {
            $this->_account = Account::findByTaiKhoan($this->taikhoan);
        }

        return $this->_account;
    }
}
