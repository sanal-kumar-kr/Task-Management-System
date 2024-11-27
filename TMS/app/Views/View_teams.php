<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="container">
        <a href="<?= base_url('Add-team') ?>" class="btn btn-primary  mb-3">Add Team</a>
            <div class="row">
            <?php foreach($teamList as $memberData):  ?>
                <div class="col-md-4 mt-3 ">
                   <div class="card-wrapper">
                       <div class="card-body">
                         <h5 class="card-title text-white"><?php echo $memberData['team']['team_name']; ?></h5>
                         <h6 class="card-subtitle mb-2 text-white">Members:-</h6>
                         <p class="card-text">
                            <ul class="list-group bg-transparent">
                            <?php foreach($memberData['members'] as $member):  ?>
                                <li class="list-group-item"><?php echo $member['username'] ?>(<?php echo $member['designation'] ?>)</li>
                            <?php endforeach; ?>
                            </ul>
                         </p>
                         <a href="<?= base_url('Edit-team/'.$memberData['team']['team_id']) ?>" class="card-link btn btn-primary">Edit</a>
                         <form action="<?= base_url('Delete-team/'.$memberData['team']['team_id']) ?>" method="post" class="d-inline">
                           <button type="submit" class="btn btn-primary">Delete</button>
                         </form>
                       </div>
                     </div>
               </div>
               <?php endforeach; ?>
            </div> 
        </div>
    </section>
<?php $this->endSection() ?>
