<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="form-wide-wrapper mx-auto ">
          <h1 class="text-white text-center mb-3"><?= isset($isEdit)?"Edit Task":"Add Task" ?></h1>
          <form action="" method="post" enctype='multipart/form-data'>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label">Title</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="title" value="<?= isset($isEdit)?$taskData['title']:"" ?>">
                </div>
                <div class="mb-3 col-md-6 mt-5">
                    <select class="form-select" name="priority">
                        <option selected>Select Priority</option>
                        <?php if(isset($isEdit)):  ?>
                            <?php if($taskData['priority'] == "Low"):  ?>
                            <option value="Low" selected>Low</option>
                            <?php else:  ?>
                            <option value="High" selected>High</option>
                            <?php endif  ?>

                        <?php else:  ?>
                        <option value="Low">Low</option>
                        <option value="High">High</option>
                        <?php endif  ?>

                      </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="formGroupExampleInput" name="start_date"  value="<?= isset($isEdit)?$taskData['start_date']:"" ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="formGroupExampleInput" name="due_date"  value="<?= isset($isEdit)?$taskData['due_date']:"" ?>">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6 mt-4">
                    <select class="form-select" name="category">
                        <option selected>Select Category</option>
                        <?php if(isset($isEdit)):  ?>
                        <?php foreach($categoryList as $row):  ?>
                        <option value="<?php echo $row['title'] ?>" <?php if($row['title'] == $taskData['category']):  ?> selected <?php endif  ?>><?php echo $row['title'] ?></option>
                        <?php endforeach; ?>
                        <?php else:  ?>
                        <?php foreach($categoryList as $row):  ?>
                        <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
                        <?php endforeach; ?>
                        <?php endif  ?>

                      </select>
                </div>
                <div class="mb-3 col-md-6 mt-4">
                    <select class="form-select" name="assigned_staff">
                        <option selected>Select Employe</option>
                        <?php if(isset($isEdit)):  ?>
                            <?php foreach($teamMembers as $row):  ?>
                        <option value="<?php echo $row['id'] ?>" <?php if($row['id'] == $taskData['assigned_staff']):  ?> selected <?php endif  ?>><?php echo $row['username'] ?></option>
                        <?php endforeach; ?>
                        <?php else:  ?>
                        <?php foreach($teamMembers as $row):  ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
                        <?php endforeach; ?>
                        <?php endif  ?>

                      </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"> <?= isset($isEdit)?$taskData['description']:"" ?></textarea>
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
                              <input type="checkbox" name="preFiles[]" id="" value="<?= $file['id'] ?>" checked>  <a href="<?= base_url($file['files']) ?>" class="card-link" target="_blank"><?php echo "taskFileslinks".$count ?></a>
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
