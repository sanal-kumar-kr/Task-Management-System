<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
    <div class="form-wrapper mx-auto ">
        <h1 class="text-white text-center mb-3">Add Category</h1>
        <form action="" method="post" id="addCategory">
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
<script type="module" >
  import {Addcategory} from '/assets/js/validation/form.validations.js' ;Addcategory();
</script>
<?php $this->endSection() ?>
