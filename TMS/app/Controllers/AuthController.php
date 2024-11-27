<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function Login()
    {
       $session=session();
       if($session->get('isLoggedIn')){
        return redirect()->to(base_url());
       }else{
        if($this->request->getMethod() == "POST"){
            $userModel=new UserModel();
            helper(['form']);
            $rules=[
                'username' => 'required|min_length[5]|max_length[15]',
                'password' => 'required'
            ];
            if($this->validate($rules)){
                $userName=$this->request->getPost('username');
                $password=$this->request->getPost('password');
                $user=$userModel->where('username',$userName)->first();
                if($user){
                    $orgPassword=$user['password'];
                    $verify=password_verify($password,$orgPassword);
                    if($verify){
                        $session_data=[
                            'id'=>$user['id'],
                            'username'=>$user['username'],
                            'ut'=>$user['user_type'],
                            'isLoggedIn'=>true
                        ];
                        $session->set($session_data);
                        return redirect()->to(base_url());

                    }else{
                        $session->setFlashdata('err','Invalid username or password!!!!!!!!');
                        return redirect()->to(base_url('Login-user'));
                    }
                }else{
                    $session->setFlashdata('err','Invalid username or password!!!!!!!!');
                    return redirect()->to(base_url('Login-user'));
                }
            }else{
                $data['validations']=$this->validator;
                return view('Login',$data);
            }
        }else{
            return view('Login');
        }
       }
    }

    public function Logout(){
        $session=session();
        if($session->get('isLoggedIn')){
            $session->destroy();
            return redirect()->to(base_url());
        }else{
            return view('access_denied');
        }
    }
}

