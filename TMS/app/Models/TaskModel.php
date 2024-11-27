<?php
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model{
    protected $table='tasks';
    protected $allowedFields=[
        'title',
        'description',
        'start_date',
        'due_date',
        'priority',
        'status',
        'category',
        'team_id',
        'assigned_staff',
        'created_by',
        'parent_task',
        'project_id'
    ];
}
?>