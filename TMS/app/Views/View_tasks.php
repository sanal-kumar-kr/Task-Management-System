<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="container">
            <div class="row">
            <?php foreach($taskList as $task):  ?>

                <div class=" col-md-6 mt-3 ">
                    <div class="card-wrapper">
                        <div class="card-body">
                        <a href="<?= base_url('Add-sub-task/'.$task[0]['id'] ) ?>" class="float-end btn btn-primary">Add Sub Tasks</a>
                        <div class="d-flex gap-5">
                            <h6 class="text-white">Created By-  <?php echo $task[0]['created_by']  ?></h6>
                            <h6 class="text-white">Assigned To-<?php echo $task[0]['assigned_staff']  ?></h6>
                        </div>
                        <a href="<?= base_url('View-sub-tasks/'.$task[0]['id'] ) ?>"> <h5 class="card-title text-white d-inline-block"><?php print_r($task[0]['title']); ?></h5></a>
                        <p class="card-text text-white">
                        <?php echo $task[0]['description']  ?>
                        </p>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                                <p class="card-text text-white">Category:          <?php echo $task[0]['category']  ?></p>
                            </div>
                            <div class="col-md-6">
                            <p class="card-text text-white">Priority:          <?php echo $task[0]['priority']  ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text text-white">Start Date:          <?php echo $task[0]['start_date']  ?></p>
                                <p class="card-text text-white">End Date:          <?php echo $task[0]['due_date']  ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-white">Members(<?php echo $task[0]['team_name']  ?>)</p>
                                <ul class="list-group bg-transparent">
                                <?php
                                  foreach($task['members'] as $member): ?>
                                    <li class="list-group-item"><?php echo $member['username']  ?>(<?php echo $member['designation']  ?>)</li>
                                    <?php 
                                    endforeach;
                                   ?>
                                </ul>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p class="text-white">Related Files</p>
                                <ul class="list-group bg-transparent">
                                <?php
                                $count=1; 
                                foreach($task['files'] as $file): 
                                 ?>

                                    <li class="list-group-item"><a href="<?= base_url($file) ?>" class="card-link" target="_blank"><?php echo "taskFileslinks".$count ?></a></li>
                                   <?php 
                                   $count++;
                              endforeach;
                                   ?>

                                </ul>
                            </div>
                            <div class="col-md-6 mt-5">
                                <a href="<?= base_url('Edit-task/'.$task[0]['id'] ) ?>" class="card-link btn btn-primary">Edit</a>
                                <form action="<?= base_url('Delete-task/'.$task[0]['id']) ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-primary">Delete</button>
                                </form>
                            </div>

                        </div>
                      
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
           </div>
        </div>
    </section>
<?php $this->endSection() ?>
