<?php
namespace App\Models;
use CodeIgniter\Model;

class FileModel extends Model{
    protected $table='files';
    protected $allowedFields=[
        'project_id',
        'task_id',
        'files'
    ];
}
?>