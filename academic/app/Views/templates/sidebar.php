<?php

 require_once(APPPATH . 'Libraries/access_level.php');
  $accesslevel = new accessLevel();
  $roleValue = session('areas');


?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <!--<li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../../assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                <!--</div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">

                    <?php if(in_array(SA_ACAD_DEGREE,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>degree"> Degree </a></li>
                <?php }?>
               <?php if(in_array(SA_ACAD_ACADEMIC_YEAR,$roleValue)) { ?>
                <li class="nav-item" > <a class="nav-link" href="<?= base_url()?>academicyears"> Academic Year </a></li>
               <?php }?>
                <?php if(in_array(SA_ACAD_CASTE_CATEGORY,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>castecategory">Caste Category </a></li>
                <?php }?>
                <?php if(in_array(SA_ACAD_CASTE,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>caste">Caste </a></li>
                <?php }?>
                <?php if(in_array(SA_ACAD_UNIVERSITY,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>university">University </a></li>
                <?php } ?>
                 <?php if(in_array(SA_ACAD_COLLEGE,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>college">College </a></li>
                 <?php } ?>
<!--			    <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>year"> Year </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>session"> Session </a></li>-->
                   <?php if(in_array(SA_ACAD_DEPARTMENT,$roleValue)) { ?>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url()?>department"> Department </a></li>
                  <?php } ?>
                <!--<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>courses"> Course </a></li>-->
                 <?php if(in_array(SA_ACAD_PAPER,$roleValue)) { ?>
				<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>papers"> Papers </a></li>
                                  <?php } ?>
                          
                            <?php if(in_array(SA_ACAD_PROFESSOR,$roleValue)) { ?>
				<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>professor"> Professor </a></li>
                                <?php } ?>
                                <?php if(in_array(SA_ACAD_FEE_CATEGORY,$roleValue)) { ?>
				<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>feescategory"> Fee Category </a></li>
                                <?php } ?>
                                 <?php if(in_array(SA_ACAD_FEE_HEADS,$roleValue)) { ?>
				<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>feeshead"> Fee Head </a></li>
                                <?php } ?>
                                 <?php if(in_array(SA_ACAD_FEE_STRUCTURE,$roleValue)) { ?>
				<li class="nav-item"> <a class="nav-link" href="<?= base_url()?>feestructure"> Fee Structure </a></li>
                                <?php } ?>
                </ul>
              </div>
            </li>
           
          </ul>
        </nav>