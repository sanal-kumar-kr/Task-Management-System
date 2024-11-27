<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DesignationModel;

class DesignationController extends BaseController
{
    public function Add_designation()
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            if($this->request->getMethod() == "POST"){
                $designationModel=new DesignationModel();
                $rules=[
                    'title' => 'required|min_length[5]|max_length[20]|is_unique[designations.title]'
                ];
                if($this->validate($rules)){
                    $title=$this->request->getPost('title');
                    $designationModel->save(['title' => $title]);
                    return redirect()->to(base_url('View-designations'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_designation',$data);
                }
            }else{
                return view('Add_designation');
            }
        }else{
            return view('access_denied');
        }
    }

    public function View_designations(){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $designationModel=new DesignationModel();
            $data['designationsList']=$designationModel->findAll();
            return view('View_designations',$data);
        }else{
            return view('access_denied');
        }
    }


    public function Delete_designation(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $designationModel=new DesignationModel();
            $designationModel->where('id',$id)->delete();
            return redirect()->to(base_url('View-designations'));
        }else{
            return view('access_denied');
        }
    }
}
