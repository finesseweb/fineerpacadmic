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
	 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">College</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="college_id" id="college_id" required>
									<option value="">Select</option>
                                        <?php foreach ($colleges as $college): ?>
                                            <option value="<?= $college['college_id'] ?>"><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
					  <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Academic Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="collegeacad_id" id="collegeacad_id" required>
									<option value="">Select</option>
                                        <?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>"><?= $academic['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Fee Structure List</h4>
                    <table class="table table-striped table-bordered" id="example1">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Academic Year</th>
								<th>Course</th>
								<th>College Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="getalldatacollegwise">
                            <?php //$slNo = 1; ?>
                            <?php
                            
							//foreach ($feestructures as $feestructure): ?>
                               <!-- <tr class="structid<?php //echo $feestructure['fee_structure_id']; ?>" >
                                    <td><? //$slNo++ ?></td>
									<td><? //$feestructure['academic_year_code']?></td>
                                    <td><? //$feestructure['course_name']?></td>
									 <td><? //$feestructure['college_name'] ?></td>
									 <td><? //$feestructure['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="<? //base_url()?>feestructure/edit/<? // $feestructure['fee_structure_id'] ?>">
                                            <i class="mdi mdi-file-check btn-icon-append">Edit</i>
                                        </a>
										<a href="#" class="btn btn-primary btn-rounded btn-icon-text showhidedetails" structid="<?php //echo $feestructure['fee_structure_id']; ?>" data-id="<?php //echo $feestructure['fee_structure_id']; ?>"> <i class="mdi mdi-file-check btn-icon-append">View</i></a>
                                        <!-- <a href="#" class=" btn btn-primary btn-rounded btn-icon-text" id="showbtndetails"> <i class="mdi mdi-file-check btn-icon-append">Hide</i></a>
                                       Other table data -->
                                    <!--</td>
								
									
                                </tr>-->
							
							<?php //endforeach; ?>
                            <?php //endforeach; ?>
							</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
