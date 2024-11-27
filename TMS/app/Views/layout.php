<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')  ?>">
    <link rel="icon" href="<?= base_url('assets/images/week1.png') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')  ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
               <img src="<?= base_url('assets/images/week1.png') ?>" alt="" width="100" height="100">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                   <div class="bar"></div>
                   <div class="bar"></div>
                   <div class="bar"></div>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <?php if(session()->get('isLoggedIn')): ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url() ?>">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('View-designations') ?>">Designation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('View-categories') ?>">categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('View-staffs') ?>">Staffs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('View-teams') ?>">Teams</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('View-projects') ?>">Projects</a>
                  </li>
                  <li class="nav-item">
                     <form action="<?= base_url('Logout') ?>" method="post">
                        <button type="submit" class="btn-white text-white bg-transparent border border-0 fw-bold">Logout</button>
                     </form>
                  </li>
                </ul>

                <?php else: ?>
  

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url() ?>">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="#">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="#">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="#">Why TMS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-white" href="<?= base_url('Login-user') ?>">Login</a>
                  </li>
                </ul>
                <?php endif; ?>

              </div>
            </div>
          </nav>
    </header>


    <?php  $this->renderSection('content') ?>
     
  <footer>
    <div class="row">
       <section class="container col-md-3 mt-5">
          <div>
             <h4 class="text-white">About</h4>
             <p class="text-white description">A Task Management System is a powerful tool designed to help users efficiently organize, track, and manage their tasks and subtasks. This system enables individuals and teams to break down complex projects into manageable components, enhancing productivity and collaboration</p>
          </div>
       </section>

       <section class="container col-md-4 text-center mt-5">
        <div class="">
          <h4 class="text-white">Userfull Links</h4>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
            <li class="nav-item ">
              <a class="text-white" href="#">Home</a>
            </li>
            <li class="nav-item ">
              <a class="text-white" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class=" text-white" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class=" text-white" href="#">Login</a>
            </li>
           </ul> 
        </div>
     </section>

     <section class="container col-md-4 text-center mt-5">
      <div>
        <h4 class="text-white">Connect Us on Social NetWorks</h4>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <i class="fab fa-linkedin text-white"></i>
            <a class="text-white" href="#">Linked In</a>
          </li>
          <li class="nav-item">
            <i class="fab fa-facebook-f text-white"></i>
            <a class="text-white" href="#">Face Book</a>
          </li>
          <li class="nav-item">
            <i class="fab fa-instagram text-white"></i>
            <a class=" text-white" href="#">Instagram</a>
          </li>
          <li class="nav-item">
            <i class="fab fa-twitter text-white">
            <a class=" text-white" href="#"></i>Twitter</a>
          </li>
         </ul> 
      </div>
   </section>
    </div>
    <div class="row">
          <div class="text-center text-white p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-reset fw-bold" href=".com/">TMS.com</a>
          </div>
    </div>
  </footer>
   <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
   <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
   <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
</body>
</html>