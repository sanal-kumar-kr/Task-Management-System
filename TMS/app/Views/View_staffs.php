<?php  $this->extend('layout')  ?>
<?php  $this->section('content') ?>
<section class="wrapper">
        <div class="wrapper  container  ">
        <a href="<?= base_url('Add-staff') ?>" class="btn btn-primary  mb-3">Add Designation</a>

            <table class="table">
                <thead class="text-center">
                  <tr>
                    <th scope="col">No:</th>
                    <th scope="col">Employe Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Action</th>


                  </tr>
                </thead>
                <tbody class="text-center">
                <?php
                $count=1;
                foreach($staffList as $row ):
                ?>
                  <tr>
                    <th scope="row"><?php echo $count++ ?></th>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['contact'] ?></td>
                    <td><?php echo $row['designation'] ?></td>
                    <td>
                        <a href="<?= base_url('Edit-staff/'.$row['id']) ?>" class="btn btn-primary mb-2">Edit</a>
                        <a href="" class="btn btn-primary mb-2">Delete</a>
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
