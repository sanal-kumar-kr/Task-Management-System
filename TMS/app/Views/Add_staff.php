<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="form-wide-wrapper mx-auto ">
          <h1 class="text-white text-center mb-3"><?= isset($isEdit)?'Edit Employe':'Add Employe' ?></h1>
          <form action="" method="post">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label">Username</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="username" value="<?= isset($isEdit)? $staff['username']:''?>">
                    <?php if(isset($validations)): ?>
                        <p class="text-danger">  <?=  $validations->getError('username') ?></a>
                    <?php endif ?>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput2" class="form-label">Email</label>
                    <input type="emai;" class="form-control" id="formGroupExampleInput2" name="email" value="<?= isset($isEdit)? $staff['email']:''?>">
                    <?php if(isset($validations)): ?>
                        <p class="text-danger"><?=  $validations->getError('email') ?></a>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="contact" value="<?= isset($isEdit)? $staff['contact']:''?>">
                    <?php if(isset($validations)): ?>
                        <p class="text-danger">   <?=  $validations->getError('contact') ?></p>
                    <?php endif ?>
                </div>
                <div class="mb-3 col-md-6 mt-5">
                    <select class="form-select" name="designation">
                        <option selected value="">Select Designation</option>
                        <?php foreach($designationsList as $row):  ?>
                            <?php if(isset($isEdit)): ?>
                                <option value="<?php echo $row['title'] ?>" <?php if($staff['designation'] == $row['title']):?>selected <?php endif; ?>><?php echo $row['title'] ?></option>
                            <?php else: ?>    
                            <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
                            <?php endif; ?>      
                        <?php endforeach; ?>
                      </select>
                      <?php if(isset($validations)): ?>
                        <p class="text-danger"> <?=  $validations->getError('designation') ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="formGroupExampleInput" class="form-label"><?= isset($isEdit)?'New Password(If want to change)':'Password' ?></label>
                    <input type="password" class="form-control" id="formGroupExampleInput" name="password">
                    <?php if(isset($validations)): ?>
                    <p class="text-danger"><?=  $validations->getError('password') ?></p>
                    <?php endif ?>
                </div>
                <div class="col-md-6 mt-5 ">
                    <button type="submit" class="submit-large-btn">Submit</button>
                </div>
            </div>
          </form>
         </div>
</section>
<?php $this->endSection() ?>
