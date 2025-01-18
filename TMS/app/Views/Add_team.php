<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="form-wide-wrapper mx-auto ">
          <h1 class="text-white text-center mb-3"><?= isset($isEdit)?'Edit Team':'Add Team' ?></h1>
          <form action="" method="post" id="addTeam">
            <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">Team Name</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="team_name" value="<?= isset($isEdit)?$team_name:'' ?>">
              <?php if(isset($validations)): ?>
                        <p class="text-danger"> <?=  $validations->getError('team_name') ?></p>
            <?php endif ?>
            </div>
            <div class="row">
              <?php if(isset($isEdit)): ?>
                <?php foreach($staffList as $staff): ?>
                  <div class="mb-3 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $staff['user_id'] ?>" id="flexCheckDefault" name="members[]" >
                        <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $staff['username'] ?>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php foreach($teamList as $team): ?>
                  <div class="mb-3 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $team['user_id'] ?>" id="flexCheckDefault" name="members[]" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $team['username'] ?>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
              <?php else: ?>
            <?php foreach($staffList as $row): ?>
                <div class="mb-3 col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $row['id'] ?>" id="flexCheckDefault" name="members[]" >
                        <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $row['username'] ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif  ?>
              <div id="membersError"></div>
            </div>
            <div class="col-md-12">
              <button type="submit" class="submit-btn">Submit</button>
            </div>
          </form>
        </div>
    </section>
  
    <script type="module" >
  import {Addteam} from '/assets/js/validation/form.validations.js' ;Addteam();
</script>
<?php $this->endSection() ?>
