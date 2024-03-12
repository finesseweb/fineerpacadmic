<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Fee Structure </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url()?>feestructure/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Head List</h4>
                    <table class="table table-striped table-bordered" id="example1">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Academic Year</th>
								<!--<th>Cast Category Name</th>-->
								<th>College Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $slNo = 1; ?>
                            <?php foreach ($feestructures as $feestructure): ?>
                                <tr>
                                    <td><?= $slNo++ ?></td>
									<td><?= $feestructure['academic_year_code']?></td>
                                   <!-- <td><?// $feestructure['caste_category_name']?></td>-->
									 <td><?= $feestructure['college_name'] ?></td>
									 <td><?= $feestructure['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="<?= base_url()?>feestructure/edit/<?= $feestructure['fee_structure_id'] ?>">
                                            <i class="mdi mdi-file-check btn-icon-append">Edit</i>
                                        </a>
										<a href="#" class=" btn btn-primary btn-rounded btn-icon-text" id="showhidedetails"> <i class="mdi mdi-file-check btn-icon-append">View</i></a>
                                       <a href="#" class=" btn btn-primary btn-rounded btn-icon-text" id="showbtndetails"> <i class="mdi mdi-file-check btn-icon-append">Hide</i></a>
                                        <!-- Other table data -->
                                    </td>
								
									
                                </tr>
							<tr class="showdetails">	
							<td></td>
							
							<td>Sl No</td>
                            <td>Particulars</td>
							<td colspan="3">1</td>
                            </tr>
							<tr class="showdetails">
							<td></td>
							<?php $i=1; foreach($feescategorys as $feescategory) :?>
							<td><?=$i?></td>
							<td colspan="3"><?=$feescategory['fee_category_name']?>
							<?php $heads= $feeheadmodel->gethead($feescategory['fee_category_id']);
							foreach($heads as $head):
							 $amountfees=$feesdetails->getamountbyhead($feestructure['fee_structure_id'],$head['fee_head_id']);
							?><tr class="showdetails">
							<td></td>
							<td><input type="hidden" name="fee_head_id[]" value="<?=$head['fee_head_id']?>" ></td>
							<td><?=$head['fee_head_name']?></td>
							<td colspan="2"><?php //$amountfees['amount']?></td></tr></td>
							</tr><?php endforeach;?>
							<tr class="showdetails"><td colspan="3"> Total Amount</td><td colspan="2"><input type="text" name="total_grand_value1" value="<?=$feestructure['total_grand_value1']?>" class="cost" readonly></td></tr>
                        
							<?php endforeach; ?>
                            <?php endforeach; ?>
							</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
