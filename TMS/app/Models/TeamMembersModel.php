<?php
namespace App\Models;
use CodeIgniter\Model;
class TeamMembersModel extends Model{
    protected $table='team_members';
    protected $allowedFields=[
        'team_id',
        'member_id'
    ];
}
?>