<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">

        <div class="wrapper table-wrapper container mx-auto ">
        <a href="<?= base_url('Add-designation') ?>" class="btn btn-primary mb-3">Add Designation</a>

            <table class="table">
                <thead class="text-center">
                  <tr>
                    <th scope="col">No:</th>
                    <th scope="col">Designation Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                <?php
                $count=1;
                foreach($designationsList as $row ):
                ?>
                  <tr >
                    <th scope="row"><?php echo $count++ ?></th>
                    <td><?php echo $row['title'] ?></td>
                    <td>
                      <form action="<?= base_url('Delete-designation/'.$row['id']) ?>" method="post">
                        <button type="submit" class="btn btn-primary">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                    $count+1;
                    endforeach;  
                    ?>
                </tbody>
              </table>
        </div>
    </section>


<?php $this->endSection() ?>
