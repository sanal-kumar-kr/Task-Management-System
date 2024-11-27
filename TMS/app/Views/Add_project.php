<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
    <div class="form-wide-wrapper mx-auto ">
        <h1 class="text-white text-center mb-3"><?= isset($isEdit)?'Edit Project':'Add Project' ?></h1>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="formGroupExampleInput" class="form-label">Title</label>
                <input type="text" class="form-control" id="formGroupExampleInput" name="title" value="<?= isset($isEdit)?$projectData['title']:'' ?>">
            </div>
            <div class="mb-3 col-md-6 mt-5">
                <select class="form-select" name="team" >
                    <option selected>Select Team</option>
                    <?php  if(isset($isEdit)): ?>
                        <?php foreach($teamList as $row):  ?>
                        <option value="<?php echo $row['id'] ?>" <?php if($row['id'] == $projectData['team_id']): ?>selected<?php endif;  ?>><?php echo $row['team_name'] ?>    </option>
                        <?php endforeach; ?>
                    <?php  else: ?>
                        <?php foreach($teamList as $row):  ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['team_name'] ?>    </option>
                        <?php endforeach; ?>
                    <?php  endif ?>

                    </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="formGroupExampleInput" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="formGroupExampleInput" name="start_date" value="<?= isset($isEdit)?$projectData['start_date']:'' ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label for="formGroupExampleInput" class="form-label">End Date</label>
                <input type="date" class="form-control" id="formGroupExampleInput" name="due_date" value="<?= isset($isEdit)?$projectData['due_date']:'' ?>">
            </div>
            
        </div>
        <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= isset($isEdit)?$projectData['description']:'' ?></textarea>
                </div>
                <div class=" mb-3 col-md-6 mt-5">
                        <label for="formFile" class="form-label">Related</label>
                        <input class="form-control" type="file" id="formFile" multiple="multiple" name="files[]">
                     
                </div>
        </div>
        <?php if(isset($isEdit)): ?>
        <div class="row">
            <div class="col-md-12 ">
            <p class="text-white mt-3">Uncheck Files To Remove</p>
                        <ul class="list-group bg-transparent">
                        <?php
                        $count=1; 
                        foreach($files as $file): 
                            ?>
                            <li class="list-group-item">
                              <input type="checkbox" name="preFiles[]" id="" value="<?= $file['id'] ?>" checked>  <a href="<?= base_url($file['files']) ?>" class="card-link" target="_blank"><?php echo "projectFileslinks".$count ?></a>
                            </li>
                            <?php 
                            $count++;
                        endforeach;
                            ?>
                        </ul>
            </div>
        </div>
        <?php endif  ?>
        <div class="row">
            <div class="col-md-12 mt-5 ">
                <button type="submit" class="submit-large-btn">Submit</button>
            </div>
        </div>

        </form>
    </div>
</section>
<?php if(isset($validations)): ?>
    <ul>
        <?= $validations->listErrors() ?>
    </ul>
<?php endif ?>
<?php $this->endSection() ?>
