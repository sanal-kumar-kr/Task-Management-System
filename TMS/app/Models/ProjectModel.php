<?php
namespace App\Models;
use CodeIgniter\Model;
class ProjectModel extends Model{
    protected $table='projects';
    protected $allowedFields=[
        'title',
        'description',
        'start_date',
        'due_date',
        'created_by',
        'team_id'
    ];
}
?>