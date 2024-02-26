
 <div class="content-wrapper">
 <?php if(session()->has('message')) { ?>
			  <div class="alert <?= session()->getFlashdata('alert-class') ?>">
         <?= session()->getFlashdata('message') ?>
    </div>
<?php
}
?>
            <div class="page-header">
              <h3 class="page-title"> Session Info </h3>
			  
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url()?>session/add" class="btn btn-gradient-primary btn-fw">Add</a></li>
                
                </ol>
              </nav>
            </div>
            <div class="row">
             <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Session Lists</h4>
                    
                    <table class="table table-striped table-bordered" id="example">
                      <thead>
                        <tr class="table-info">
                          <th> # </th>
                          <th> Name </th>
                          <th> Status </th>
                          <th> Action </th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i=1;if(!empty($this->data)):
					    foreach($this->data as $row):
					  ?>
                        <tr>
                          <td> <?=$i?> </td>
                          <td> <?=strtoupper($row['session_name'])?> </td>
                          <td> <?php echo $row['status'] ?> </td>
                          <td> <a href="<?= base_url()?>session/edit/<?=$row['session_id']?>" class="btn btn-gradient-dark btn-icon-text"><i class="mdi mdi-file-check btn-icon-append"></i>Edit</a> 
                          <a href="<?= base_url()?>session/delete/<?=$row['session_id']?>" class="btn btn-gradient-danger btn-icon-text"><i class="mdi mdi-delete btn-icon-append"></i>Delete</a></td>
                          
                        </tr>
                        <?php  $i++; endforeach; endif;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>