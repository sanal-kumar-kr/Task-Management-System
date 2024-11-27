<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
    <div class="form-wrapper mx-auto ">
        <h1 class="text-white text-center mb-3">Add Category</h1>
        <form action="" method="post">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Category</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="title" >
            <?php if(isset($validations)): ?>
                        <p class="text-danger"> <?=  $validations->getError('title') ?></p>
            <?php endif ?>
        </div>
        <div class="col-md-12">
            <button type="submit" class="submit-btn">Submit</button>
        </div>
        </form>
    </div>
</section>
<?php $this->endSection() ?>
