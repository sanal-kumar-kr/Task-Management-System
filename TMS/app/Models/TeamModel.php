<?php
namespace App\Models;
use CodeIgniter\Model;
class TeamModel extends Model{
    protected $table='teams';
    protected $allowedFields=[
        'team_name'
    ];
}
?>