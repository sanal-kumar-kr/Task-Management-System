<?php
namespace App\Controllers;
use App\Models\TeamMembersModel;
use App\Models\ProjectModel;
use App\Models\TeamModel;
use App\Models\FileModel;

use App\Models\UserModel;



class ProjectController extends BaseController
{
    public function Add_project()
    {
        $session=session();
        if($session->get('isLoggedIn') && ($session->get('ut') == 1 || $session->get('ut') == 2)){
            $projectModel=new ProjectModel();
            $teamModel=new TeamModel();
            $fileModel=new FileModel();
            $data['teamList']=$teamModel->findAll();
            if($this->request->getMethod() == "POST"){
                $rules = [
                    'title' => 'required|min_length[5]|max_length[15]|is_unique[projects.title]',
                    'description' => 'required|min_length[10]|max_length[300]',
                    'start_date' => 'required|valid_date',
                    'due_date' => 'required|valid_date',
                    'team'=>'required'
                ];
                if($this->validate($rules)){
                    $title=$this->request->getPost('title');
                    $description=$this->request->getPost('description');
                    $start_date=$this->request->getPost('start_date');
                    $due_date=$this->request->getPost('due_date');
                    $teamId=$this->request->getPost('team');
                    $data=[
                        'title' => $title,
                        'description' => $description,
                        'start_date' => $start_date,
                        'due_date' => $due_date,
                        'team_id' => $teamId,
                        'created_by' => $session->get('id')
                    ];
                    $projectModel->save($data);
                    $id=$projectModel->insertID; 
                    $files=$this->request->getFiles();
                    foreach($files['files'] as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            $newName = $file->getRandomName();
                            $file->move('uploads', $newName);
                            $filedata=[
                                'project_id'=>$id,
                                'files'=>"uploads/".$newName
                            ];
                            $fileModel->save($filedata);
                        }
                    }
                    return redirect()->to(base_url('View-projects'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_project',$data);
                }
            }else{
                return view('Add_project',$data);
            }
        }else{
            return view('access_denied');
        }
    }




    public function View_projects(){
        $session=session();
        if($session->get('isLoggedIn')){
            $teamMembersModel=new TeamMembersModel();
            $projectModel=new ProjectModel();
            $userModel=new UserModel();
            $fileModel=new FileModel();
            $projects=$projectModel->select('projects.id as project_id,users.id,description,title,start_date,due_date,team_id,username,teams.team_name')->join('users','users.id = projects.created_by')->join('teams','teams.id=projects.team_id')->find();
            $projectList=[];
            foreach ($projects as $project) {
                $files=$fileModel->where('project_id',$project['project_id'])->findAll();
                $fileList=[];
                foreach($files as $file){
                    array_push($fileList,$file['files']);
                }
                $membersList=[];
                $members=$teamMembersModel->where('team_id',$project['team_id'])->findAll();
                foreach($members as $member){
                    $memberName=$userModel->where('id',$member['member_id'])->first();
                    array_push($membersList,$memberName);
                }
                $obj=[
                     $project,
                     'files' => $fileList,
                    'members' => $membersList
                ];
                array_push($projectList,$obj);
            }
            $data['projectList']=$projectList;
          
            return view('View_projects',$data);
        }else{
            return view('access_denied');
        }
    }


    public function Edit_project(Int $id)
    {
        $session=session();
        if($session->get('isLoggedIn') && ($session->get('ut') == 1 || $session->get('ut') == 2)){
            $projectModel=new ProjectModel();
            $teamModel=new TeamModel();
            $fileModel=new FileModel();

            $data['teamList']=$teamModel->findAll();
            $data['projectData']=$projectModel->where('id',$id)->first();
            $data['files'] = $fileModel->where('project_id',$id)->findAll();
            $data['isEdit']=true;
            if($this->request->getMethod() == "POST"){
                $rules = [
                    'title' => 'required|min_length[5]|max_length[15]|is_unique[projects.title,id,'.$id.']',
                    'description' => 'required|min_length[10]|max_length[300]',
                    'start_date' => 'required|valid_date',
                    'due_date' => 'required|valid_date',
                    'team'=>'required'
                ];
                if($this->validate($rules)){
                    $title=$this->request->getPost('title');
                    $description=$this->request->getPost('description');
                    $start_date=$this->request->getPost('start_date');
                    $due_date=$this->request->getPost('due_date');
                    $teamId=$this->request->getPost('team');
                    $preFiles=$this->request->getPost('preFiles');
                    $data=[
                        'title' => $title,
                        'description' => $description,
                        'start_date' => $start_date,
                        'due_date' => $due_date,
                        'team_id' => $teamId,
                        'created_by' => $session->get('id')
                    ];
                    $projectModel->set($data)->where('id',$id)->update();
                    $fileModel->whereNotIn('id',$preFiles)->where('project_id',$id)->delete();
                    $files=$this->request->getFiles();
                    foreach($files['files'] as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            $newName = $file->getRandomName();
                            $file->move('uploads', $newName);
                            $filedata=[
                                'project_id'=>$id,
                                'files'=>"uploads/".$newName
                            ];
                            $fileModel->save($filedata);
                        }
                    }
                    return redirect()->to(base_url('View-projects'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_project',$data);
                }
            }else{
            
                return view('Add_project',$data);
            }
        }else{
            return view('access_denied');
        }
    }

    public function Delete_project(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && ($session->get('ut') == 1|| $session->get('ut') == 2)){
            $projectModel=new ProjectModel();
            $projectModel->where('id',$id)->delete();
            return redirect()->to(base_url('View-projects'));
        }else{
            return view('access_denied');
        }
    }
}
