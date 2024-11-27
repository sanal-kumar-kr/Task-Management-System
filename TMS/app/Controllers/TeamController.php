<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\TeamModel;
use App\Models\TeamMembersModel;


class TeamController extends BaseController
{
    public function Add_team()
    {
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $teamModel=new TeamModel();
            $teamMembersModel=new TeamMembersModel();
            $userModel=new UserModel();
            $subQuery=$teamMembersModel->findColumn('member_id');
            $data['staffList']=isset($subQuery)?$userModel->whereNotIn('id',$subQuery)->whereIn('user_type',[2,3])->findAll():$userModel->whereIn('user_type',[2,3])->findAll();
            if($this->request->getMethod() == "POST"){
                $rules=[
                    'team_name' => 'required|min_length[5]|max_length[20]|is_unique[teams.team_name]',
                    // 'members' => [
                    //     'rules' => 'required',
                    // ]
                ];
                if($this->validate($rules)){
                    $teamName=$this->request->getPost('team_name');
                    $teamMembers=$this->request->getPost('members');
                    $teamModel->save(['team_name' => $teamName]);
                    $lastTeamId=$teamModel->insertID();
                    foreach ($teamMembers as $member) {
                        $data=[
                            'team_id' => $lastTeamId,
                            'member_id' => $member
                        ];
                        $teamMembersModel->save($data);
                    }
                    return redirect()->to(base_url('View-teams'));
                }else{
                    $data['validations']=$this->validator;
                    return view('Add_team',$data);
                }
            }else{
                return view('Add_team',$data);
            }
        }else{
            return view('access_denied');
        }
    }

    public function View_teams(){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $teamModel=new TeamModel();
            $teamMembersModel=new TeamMembersModel();
            $userModel=new UserModel();
            $teams=$teamModel->select('team_name,teams.id as team_id')->findAll();
            $teamList=[];
            foreach ($teams as $team) {
                $membersList=[];
                $members=$teamMembersModel->where('team_id',$team['team_id'])->findAll();
                foreach($members as $member){
                    $memberName=$userModel->where('id',$member['member_id'])->first();
                    array_push($membersList,$memberName);
                }
                $obj=[
                    'team' => $team,
                    'members' => $membersList
                ];
                array_push($teamList,$obj);
            }
            $data['teamList']=$teamList;
            return view('View_teams',$data);
        }else{
            return view('access_denied');
        }
    }

    public function Edit_team(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $teamModel=new TeamModel();
            $userModel=new UserModel();
            $teamMembersModel=new TeamMembersModel();

            if($this->request->getMethod() == "POST"){
                $rules=[
                    'team_name' => 'required|min_length[5]|max_length[20]|is_unique[designations.title,id,'.$id.']'
                ];
                if($this->validate($rules)){
                    $teamData=$this->request->getPost('members');
                    $teamName=$this->request->getPost('team_name');
                    $teamModel->set(['team_name'=>$teamName])->where('id',$id)->update();
                    $teamMembersModel->where('team_id',$id)->delete();
                    foreach($teamData as $member){
                        $data=[
                            'member_id' => $member,
                            'team_id' => $id
                        ];
                         $teamMembersModel->save($data);
                    }
                    return redirect()->to(base_url('View-teams'));

                   

                }else{
                    $data['validations']=$this->validator;
                    return view('Edit_designation',$data);
                }
            }else{
                $data['teamList']=$userModel->select('username,users.id as user_id')->join('team_members','team_members.member_id = users.id')->whereIn('user_type',[2,3])->where('team_id',$id)->find();
                $data['staffList']=$userModel->select('username,users.id as user_id')->whereNotIn('id',$teamMembersModel->where('team_id',$id)->findColumn('member_id'))->whereIn('user_type',[2,3])->findAll();
                $team=$teamModel->where('id',$id)->first();
                $data['team_name']=$team['team_name'];
                $data['isEdit']=true;
                return view('Add_team',$data);
            }
        }else{
            return view('access_denied');
        }
    }

    public function Delete_team(Int $id){
        $session=session();
        if($session->get('isLoggedIn') && $session->get('ut') == 1){
            $teamModel=new TeamModel();
            $teamModel->where('id',$id)->delete();
            return redirect()->to(base_url('View-teams'));
        }else{
            return view('access_denied');
        }
    }
}
