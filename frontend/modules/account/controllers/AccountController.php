<?php

namespace frontend\modules\Account\controllers;

use yii\web\Controller;
use frontend\models\DangkiForm;
use frontend\models\DangnhapForm;
use frontend\models\UpdateForm;
use frontend\models\SendPassForm;
use common\models\Account;
use Yii;
/**
 * Default controller for the `account` module
 */
class AccountController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDangki()
    {
        $model = new DangkiForm();
        $sesion=Yii::$app->session;
        unset($sesion['TaiKhoan']);
        // $repass="null";
        $err=null;
        if ($model->load(Yii::$app->request->post())) {
            //  die(var_dump(Yii::$app->request->post('DangkiForm')));
                $arr=Yii::$app->request->post('DangkiForm');
                 $model->taikhoan=$arr["taikhoan"];
                 $model->email=$arr["email"];
                 $model->password=$arr["password"];
                 $model->sdt=$arr["sdt"];
            
        //    die( var_dump($model));
            // die(var_dump($model->password==$repass));
            if( $model->dangki()){                
                $sesion['TaiKhoan']=$model->taikhoan;
                \Yii::$app->getSession()->setFlash('success', 'Bạn Đã Đăng Kí Thành Công');
               return $this->goHome(); 
            } 
            
        
        }
        return $this->render('dangki',["model"=>$model]);
    }
    public function actionIndex()
    {
        $session = Yii::$app->session;
        unset($session['TaiKhoan']);
        $model=new DangnhapForm();
            //  die(var_dump(Yii::$app->request->post()));
          
            // die(var_dump($model));
        if (Yii::$app->request->post('DangnhapForm')){            
              $arr=Yii::$app->request->post('DangnhapForm');
            $model->taikhoan=$arr["taikhoan"];
            $model->password=$arr["password"];
        if( $model->login()) {
            $session->set('TaiKhoan', $model->taikhoan);
           return $this->goHome() ;
        }else {
            $model->password = '';
        }
        } 
        // if (Yii::$app->request->post('QuenmkForm')){ 
        //     return $this->render('./../../quenmk/views/default/index.php');
        // }  
        return $this->render('dangnhap',['model'=>$model]);
    }
    public function actionQuenmk()
    {
        $model=new SendPassForm();
        $err=null;
        $msg=null;
        if(Yii::$app->request->post()){
            $arr=Yii::$app->request->post("SendPassForm");
            $model->taikhoan=$arr['taikhoan'];
            $model->email=$arr['email'];
            if($model->checkthongtin()==0){
                $err="Nhập Sai Email";
            }
            elseif($model->checkthongtin()==2){
                $err="Nhập Sai Tài Khoản";
            }
            elseif($model->checkthongtin()==1){
                $model->pass=$this->RanPass();
                $check=Yii::$app->mailer->compose()
                     ->setFrom('dinhtientho981@gmail.com')
                     ->setTo($model->email)
                     ->setSubject('Cấp Lại Mật Khẩu')
                     ->setTextBody("Mật Khẩu Của Bạn Là $model->pass")
                      ->send();
                      $model->sendmail();
                    $msg="Vui Lòng Kiểm Tra Email Để Lấy Lại Mật Khẩu";
            }
        }
        
        return $this->render('quenmk',["model"=>$model,"err"=>$err,'msg'=>$msg]);
    }
    public function RanPass() { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < 8; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return $randomString; 
    } 
    public function actionUpdate()
    {

        $session=Yii::$app->session;
        $modelx=new UpdateForm();
        $account=Account::findByTaiKhoan($session['TaiKhoan']);
        // die(var_dump($account));
        $modelx->email=$account["email"];
        $modelx->sdt=$account['SĐT']; 
        $modelx->taikhoan=$session['TaiKhoan'];
        // die(var_dump($account));
        if(Yii::$app->request->post()){            
            $arr=Yii::$app->request->post('UpdateForm');
            $modelx->email=$arr["email"];
            $modelx->sdt=$arr['sdt'];  
            $modelx->pass=$arr['pass'];
            $modelx->update(); 
            \Yii::$app->getSession()->setFlash('success', 'Bạn Đã Cập Nhật Thông Tin Thành Công');
            return $this->goHome();
        }
        return $this->render('capnhat',['model'=>$modelx]);
    }
}
