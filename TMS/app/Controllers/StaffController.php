<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\DesignationModel;
// P@ssw0rd123!
// 

class StaffController extends BaseController
{
    public function Add_staff()
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $userModel=new userModel();
            $designationModel=new DesignationModel();
            $data['designationsList']=$designationModel->findAll();
            if($this->request->getMethod() == "POST"){
                $rules = [
                    'username' => 'required|min_length[5]|max_length[15]|is_unique[users.username]',
                    'email' => 'required|min_length[10]|max_length[20]|valid_email|is_unique[users.email]',
                    'contact' => 'required|min_length[10]|max_length[10]|is_unique[users.contact]|numeric',
                    'designation' => 'required',
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required|min_length[8]|max_length[15]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).*$/]',
                        'errors' => [
                            'regex_match' => 'Password must contain at least one number, one uppercase letter, one lowercase letter, and one special character.',
                        ],
                    ]
                ];
                if($this->validate($rules)){
                    $username=$this->request->getPost('username');
                    $email=$this->request->getPost('email');
                    $contact=$this->request->getPost('contact');
                    $designation=$this->request->getPost('designation');
                    $password=password_hash($this->request->getPost('password'),PASSWORD_BCRYPT);
                    $ut=$designation == "Project_manager"?2:3;
                    $data=[
                        'username' => $username,
                        'email' => $email,
                        'contact' => $contact,
                        'password' => $password,
                        'designation' => $designation,
                        'user_type' => $ut
                    ];
                    $userModel->save($data);
                    return redirect()->to(base_url('View-staffs'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_staff',$data);
                }
            }else{
                return view('Add_staff',$data);
            }
        }else{
            return view('access_denied');
        }
    }

    public function View_staffs(){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $userModel=new userModel();
            $data['staffList']=$userModel->where('user_type',2)->orWhere('user_type',3)->findAll();
            return view('View_staffs',$data);
        }else{
            return view('access_denied');
        }
    }

    public function Edit_staff(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $userModel=new userModel();
            $designationModel=new DesignationModel();
            $data['staff']=$userModel->where('id',$id)->first();
            $data['isEdit']=true;
            $data['designationsList']=$designationModel->findAll();
            if($this->request->getMethod() == "POST"){
                $rules=[
                    'username' => 'required|min_length[5]|max_length[15]|is_unique[users.username,id,'.$id.']',
                    'email' =>'required|min_length[10]|max_length[20]|valid_email|is_unique[users.email,id,'.$id.']',
                    'contact' => 'required|min_length[10]|max_length[10]|is_unique[users.contact,id,'.$id.']',
                    'designation' => 'required',
                    // 'password' =>[
                    //     'label'  => 'Password',
                    //     'rules'  => 'required|min_length[8]|max_length[15]|regex_match[/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* )$/]',
                    //     'errors' => [
                    //         'regex_match' => 'Atleast one number,Capital Letter,Small Letter,special Character',
                    //     ],
                    // ] 
                ];
                if($this->validate($rules)){
                    $username=$this->request->getPost('username');
                    $email=$this->request->getPost('email');
                    $contact=$this->request->getPost('contact');
                    $designation=$this->request->getPost('designation');
                    $password=$this->request->getPost('password')?password_hash($this->request->getPost('password'),PASSWORD_BCRYPT):null;
                    $ut=$designation == "Project_manager"?2:3;
                    $data=[
                        'username' => $username,
                        'email' => $email,
                        'contact' => $contact,
                        'designation' => $designation,
                        'ut' => $designation == "Project_manager"?2:3
                    ];
                    if($password !== null){
                        $data['password']=$password;
                    }
                    $userModel->set($data)->where('id',$id)->update();
                    return redirect()->to(base_url('View-staffs'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_staff',$data);
                }
            }else{
                return view('Add_staff',$data);
            }
        }else{
            return view('access_denied');
        }
    }

    public function Delete_staff(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $userModel=new userModel();
            $userModel->where('id',$d)->delete();
            return redirect()->to(base_url('View-staffs'));
        }else{
            return view('access_denied');
        }
    }
}
