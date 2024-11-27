<?php

namespace App\Controllers;
use App\Models\TaskModel;
use App\Models\FileModel;
use App\Models\TeamModel;
use App\Models\TeamMembersModel;
use App\Models\CategoryModel;
use App\Models\ProjectModel;


class TaskController extends BaseController
{
    public function Add_task(Int $id)
    {
        $session=session();
        if($session->get('isLoggedIn')){
            $taskModel=new TaskModel();
            $fileModel=new FileModel();
            $projectModel=new ProjectModel();
            $teamModel=new TeamModel();
            $teamMembersModel=new TeamMembersModel();
            $categoryModel=new CategoryModel();
            $data['categoryList']=$categoryModel->findAll();
            $data['teamMembers']=$projectModel->select('users.id,users.username')->join('team_members','team_members.team_id=projects.team_id')->join('users','team_members.member_id=users.id')->where('projects.id',$id)->findAll();
            $teamData=$projectModel->where('projects.id',$id)->first();
            if($this->request->getMethod() == "POST"){
                $rules=[
                    'title' => 'required|min_length[3]|max_length[20]|is_unique[tasks.title]',
                    'description' => 'required|min_length[10]|max_length[300]',
                    'start_date' => 'required|valid_date',
                    'due_date' => 'required|valid_date',
                    'priority'=>'required',
                    'category' =>'required',
                    'assigned_staff' => 'required'
                ];
                if($this->validate($rules)){
                    $taskData=[
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'start_date' => $this->request->getPost('start_date'),
                        'due_date' => $this->request->getPost('due_date'),
                        'priority' => $this->request->getPost('priority'),
                        'category' => $this->request->getPost('category'),
                        'project_id' => $id,
                        'created_by' => $session->get('id'),
                        'assigned_staff' =>$this->request->getPost('assigned_staff'),
                        'team_id' => $teamData['team_id']
                    ];
                    $taskModel->save($taskData);
                    $id=$taskModel->insertID; 
                    $files=$this->request->getFiles();
                    foreach($files['files'] as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            $newName = $file->getRandomName();
                            $file->move('uploads', $newName);
                            $filedata=[
                                'task_id'=>$id,
                                'files'=>"uploads/".$newName
                            ];
                            $fileModel->save($filedata);
                        }
                    }
                    return redirect()->to(base_url('View-projects'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_task',$data);
                }
            }else{
                return view('Add_task',$data);
            }
        }else{
            return view('access_denied');
        }
    }


    public function View_tasks(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
           $taskModel=new TaskModel();
           $fileModel=new FileModel();
           $projectModel=new ProjectModel();

           $taskList=[];
           $tasks=$taskModel
                ->select("tasks.id,teams.id as team_id,tasks.title,tasks.description,tasks.start_date,tasks.due_date,tasks.priority,tasks.category,assigned.username as assigned_staff,teams.team_name,created.username as created_by")
                    ->join('teams','teams.id = tasks.team_id')->join('users as assigned','assigned.id = tasks.assigned_staff')->join('users as created','created.id = tasks.created_by')
                        ->where(['project_id'=>$id,'parent_task' => NULL])
                            ->findAll();
        
            $teamMembers=$projectModel->select('username,designation')->join('team_members','team_members.team_id=projects.team_id')->join('users','users.id=team_members.member_id')->where('projects.id',$id)->findAll();
           
            foreach ($tasks as $task) {
                $files=$fileModel->where('task_id',$task['id'])->findAll();
                $fileList=[];
                foreach($files as $file){
                    array_push($fileList,$file['files']);
                }
                $memberList=[];
                foreach($teamMembers as $member){
                    array_push($memberList,$member);
                }
                $obj=[
                    $task,
                    'files' => $fileList,
                    'members' => $memberList
                ];
                array_push($taskList,$obj);
            }
            $data['taskList']=$taskList;
            return view('View_tasks',$data);
        }else{
            return view('access_denied');
        }
    }



    public function Add_sub_task(Int $id)
    {
        $session=session();
        if($session->get('isLoggedIn')){
            $taskModel=new TaskModel();
            $fileModel=new FileModel();
            $projectModel=new ProjectModel();
            $teamModel=new TeamModel();
            $teamMembersModel=new TeamMembersModel();
            $categoryModel=new CategoryModel();
            $data['categoryList']=$categoryModel->findAll();
            $data['teamMembers']=$taskModel->select('users.id,users.username')->join('team_members','team_members.team_id=tasks.team_id')->join('users','team_members.member_id=users.id')->where('tasks.id',$id)->findAll();
            $task=$taskModel->where('tasks.id',$id)->first();
            if($this->request->getMethod() == "POST"){
                $rules=[
                    'title' => 'required|min_length[3]|max_length[20]|is_unique[tasks.title]',
                    'description' => 'required|min_length[10]|max_length[300]',
                    'start_date' => 'required|valid_date',
                    'due_date' => 'required|valid_date',
                    'priority'=>'required',
                    'category' =>'required',
                    'assigned_staff' => 'required'
                ];
                if($this->validate($rules)){
                    $taskData=[
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'start_date' => $this->request->getPost('start_date'),
                        'due_date' => $this->request->getPost('due_date'),
                        'priority' => $this->request->getPost('priority'),
                        'category' => $this->request->getPost('category'),
                        'project_id' => $task['project_id'],
                        'created_by' => $session->get('id'),
                        'parent_task' =>$id,
                        'assigned_staff' =>$this->request->getPost('assigned_staff'),
                        'team_id' => $task['team_id']
                    ];
                    $taskModel->save($taskData);
                    $id=$taskModel->insertID; 
                    $files=$this->request->getFiles();
                    foreach($files['files'] as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            $newName = $file->getRandomName();
                            $file->move('uploads', $newName);
                            $filedata=[
                                'task_id'=>$id,
                                'files'=>"uploads/".$newName
                            ];
                            $fileModel->save($filedata);
                        }
                    }
                    return redirect()->to(base_url('View-projects'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_task',$data);
                }
            }else{
                return view('Add_task',$data);
            }
        }else{
            return view('access_denied');
        }
    }


    public function View_sub_tasks(Int $id){
        $session=session();
        
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
           $taskModel=new TaskModel();
           $fileModel=new FileModel();
           $taskList=[];
           $tasks=$taskModel
                ->select("tasks.id,tasks.title,tasks.description,tasks.start_date,tasks.due_date,tasks.priority,tasks.category,assigned.username as assigned_staff,teams.team_name,created.username as created_by")
                    ->join('teams','teams.id = tasks.team_id')->join('users as assigned','assigned.id = tasks.assigned_staff')->join('users as created','created.id = tasks.created_by')
                        ->where('parent_task',$id)
                            ->findAll();
            $teamMembers=$taskModel->select('username,designation')->join('team_members','team_members.team_id=tasks.team_id')->join('users','users.id=team_members.member_id')->where('tasks.id',$id)->findAll();

            foreach ($tasks as $task) {
                $files=$fileModel->where('task_id',$task['id'])->findAll();
                $fileList=[];
                foreach($files as $file){
                    array_push($fileList,$file['files']);
                }
                $memberList=[];
                foreach($teamMembers as $member){
                    array_push($memberList,$member);
                }
                $obj=[
                    $task,
                    'files' => $fileList,
                    'members' => $memberList
                ];
                array_push($taskList,$obj);
            }
            $data['taskList']=$taskList;
            
            return view('View_tasks',$data);
        }else{
            return view('access_denied');
        }
    }


    public function Edit_task(Int $id)
    {
        $session=session();
        if($session->get('isLoggedIn')){
            $taskModel=new TaskModel();
            $fileModel=new FileModel();
            $projectModel=new ProjectModel();
            $teamModel=new TeamModel();
            $teamMembersModel=new TeamMembersModel();
            $categoryModel=new CategoryModel();
            $data['categoryList']=$categoryModel->findAll();
            $data['teamMembers']=$taskModel->select('users.id,users.username')->join('team_members','team_members.team_id=tasks.team_id')->join('users','team_members.member_id=users.id')->where('tasks.id',$id)->findAll();
            $data['isEdit'] = true;
            $data['taskData']=$taskModel->where('id',$id)->first();
            $data['files'] = $fileModel->where('task_id',$id)->findAll();
            if($this->request->getMethod() == "POST"){
                $rules=[
                    'title' => 'required|min_length[3]|max_length[20]|is_unique[tasks.title,id,'.$id.']',
                    'description' => 'required|min_length[10]|max_length[300]',
                    'start_date' => 'required|valid_date',
                    'due_date' => 'required|valid_date',
                    'priority'=>'required',
                    'category' =>'required',
                    'assigned_staff' => 'required'
                ];
                if($this->validate($rules)){
                    $taskData=[
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'start_date' => $this->request->getPost('start_date'),
                        'due_date' => $this->request->getPost('due_date'),
                        'priority' => $this->request->getPost('priority'),
                        'category' => $this->request->getPost('category'),
                        'created_by' => $session->get('id'),
                        'assigned_staff' =>$this->request->getPost('assigned_staff'),
                    ];
                    $preFiles=$this->request->getPost('preFiles');
                    $taskModel->set($taskData)->where('id',$id)->update();
                    $fileModel->whereNotIn('id',$preFiles)->where('task_id',$id)->delete();
                    $files=$this->request->getFiles();
                    foreach($files['files'] as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            $newName = $file->getRandomName();
                            $file->move('uploads', $newName);
                            $filedata=[
                                'task_id'=>$id,
                                'files'=>"uploads/".$newName
                            ];
                            $fileModel->save($filedata);
                        }
                    }
                    return redirect()->to(base_url('View-projects'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_task',$data);
                }
            }else{
               

                return view('Add_task',$data);
            }
        }else{
            return view('access_denied');
        }
    }
    public function Delete_task(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && ($session->get('ut') == 1|| $session->get('ut') == 2)){
            $taskModel=new TaskModel();
            $taskModel->where('id',$id)->delete();
            return redirect()->to(base_url('View-projects'));
        }else{
            return view('access_denied');
        }
    }

}
