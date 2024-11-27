<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="form-wrapper mx-auto ">
          <h1 class="text-white text-center mb-3">Login</h1>
          <form action="" method="post">
            <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">Username</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="username">
            </div>
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Password</label>
              <input type="password" class="form-control" id="formGroupExampleInput2" name="password">
            </div>
            <div class="col-md-12">
              <button type="submit" class="submit-btn">Submit</button>
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
