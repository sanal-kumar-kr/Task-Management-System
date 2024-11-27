<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="container">
        <a href="<?= base_url('Add-project') ?>" class="btn btn-primary  mb-3">Add Project</a>

            <div class="row">
            <?php foreach($projectList as $project):  ?>

                <div class=" col-md-6 mt-3 ">
                    <div class="card-wrapper">
                        <div class="card-body">
                            <a href="<?= base_url('Add-task/'.$project[0]['project_id'] ) ?>" class="float-end btn btn-primary">Add Task</a>

                            <h6 class="text-white">Created By-  <?php echo $project[0]['username']  ?></h6>
                               <a href="<?= base_url('View-tasks/'. $project[0]['project_id'] ) ?>"> <h5 class="card-title text-white"><?php echo $project[0]['title']  ?></h5></a>
                        <p class="card-text text-white">
                        <?php echo $project[0]['description']  ?>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text text-white">Start Date: <?php echo $project[0]['start_date']  ?></p>
                                <p class="card-text text-white">End Date:<?php echo $project[0]['due_date']  ?></p>
                               
                            </div>
                            <div class="col-md-6">
                                <p class="text-white">Members(<?php echo $project[0]['team_name']  ?>)</p>
                                <ul class="list-group bg-transparent">
                                <?php foreach($project['members'] as $member):  ?>

                                    <li class="list-group-item"><?php echo $member['username'] ?>(<?php echo $member['designation'] ?>)</li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p class="text-white">Related Files</p>
                                <ul class="list-group bg-transparent">
                                <?php
                                $count=1; 
                                foreach($project['files'] as $file): 
                                 ?>

                                    <li class="list-group-item"><a href="<?= base_url($file) ?>" class="card-link" target="_blank"><?php echo "projectFileslinks".$count ?></a></li>
                                   <?php 
                                   $count++;
                              endforeach;
                                   ?>
                                </ul>
                            </div>
                            <div class="col-md-6 mt-5">
                                <a href="<?= base_url('Edit-project/'.$project[0]['project_id']) ?>" class="card-link btn btn-primary">Edit</a>
                                <form action="<?= base_url('Delete-project/'.$project[0]['project_id']) ?>" method="post" class="d-inline">
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
