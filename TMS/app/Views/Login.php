<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="form-wrapper mx-auto ">
          <h1 class="text-white text-center mb-3">Login</h1>
          <form action="" method="post" id="loginForm">
            <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">Username</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="username">
              <?php if(isset($validations)): ?>
                        <p class="text-danger">   <?=  $validations->getError('username') ?></p>
                <?php endif ?>
            </div>
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Password</label>
              <input type="password" class="form-control" id="formGroupExampleInput2" name="password">
              <?php if(isset($validations)): ?>
                        <p class="text-danger">   <?=  $validations->getError('password') ?></p>
                <?php endif ?>
            </div>
            <div class="col-md-12">
              <button type="submit" class="submit-btn">Submit</button>
            </div>
          </form>
        </div>
</section>
<script type="module" >
  import {Login} from '/assets/js/validation/form.validations.js' ;Login();
</script>
</script>
<?php $this->endSection() ?>
