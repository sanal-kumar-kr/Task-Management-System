<?php

namespace App\Controllers;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function Add_category()
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $categoryModel=new CategoryModel();

            if($this->request->getMethod() == "POST"){
                $rules=[
                    'title' => 'required|min_length[2]|max_length[20]|is_unique[category.title]'
                ];
                if($this->validate($rules)){
                    $title=$this->request->getPost('title');
                    $categoryModel->save(['title' => $title]);
                    return redirect()->to(base_url('View-categories'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_category',$data);
                }
            }else{
                return view('Add_category');
            }
        }else{
            return view('access_denied');
        }
    }

    public function View_categories()
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $categoryModel=new CategoryModel();
            $data['categoryList']=$categoryModel->findAll();
            return view('View_categories',$data);
        }else{
            return view('access_denied');
        }
    }


    public function Delete_category(Int $id)
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $categoryModel=new CategoryModel();
            $categoryModel->where('id',$id)->delete();
            return redirect()->to(base_url('View-categories'));
        }else{
            return view('access_denied');
        }
    }
}
