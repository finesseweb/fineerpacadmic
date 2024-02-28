<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Fee Structure</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url()?>feestructure/store">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Academic Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="academic_year_id" id="academic_year_id" required>
									   <option value="">Select</option>
                                        <?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>"><?= $academic['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cast Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="caste_category_id" id="caste_category_id">
                                        <?php foreach ($castcategorys as $castcategory): ?>
                                            <option value="<?= $castcategory['caste_category_id'] ?>"><?= $castcategory['caste_category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					 <div class="row">
					  <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">College</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="college_id" required>
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
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
					 <div class="row">
					 <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Particulars</th>
								
								<th>1</th>
                               
                            </tr>
							<tbody>
							<?php $i=1; foreach($feescategorys as $feescategory) :?>
							<tr>
							<td><?=$i?></td>
							<td><?=$feescategory['fee_category_name']?>
							<?php $heads= $feeheadmodel->gethead($feescategory['fee_category_id']);
							foreach($heads as $head):
							?>
							<tr>
							<td><input type="hidden" name="fee_head_id[]" value="<?=$head['fee_head_id']?>" ></td><td><?=$head['fee_head_name']?></td><td><input type="text" name="amount[]"></td></tr></td>
							</tr><?php endforeach;?>
							<?php $i++ ;endforeach;?>
							</tbody>
                        </thead>
					 </table>
					 </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    <a href="<?= base_url()?>feestructure" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
