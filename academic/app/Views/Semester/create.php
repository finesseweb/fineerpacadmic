<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Semester</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url()?>semester/store">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="semester_name" required />
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="academic_year_id">Academic Year Code</label>
							<div class="col-sm-9">
                            <select name="academic_year_id" id="academic_year_id" class="form-control" required>
							<?php foreach ($academicyears as $academicyear): ?>
                                            <option value="<?= $academicyear['academic_year_id'] ?>"><?= $academicyear['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
							</select>
							</div>
                        </div>
						</div>
                    </div>
					
                    <div class="row">
					<div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="start_date">Start Date</label>
							<div class="col-sm-9">
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
							</div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="end_date">End Date</label>
							<div class="col-sm-9">
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
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
                                        <?php foreach ($colleges as $college): ?>
                                            <option value="<?= $college['college_id'] ?>"><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
						 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Common Term</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="cmn_terms" required>
                                        <?php //foreach ($colleges as $college): ?>
                                            <option value="t1">Sem 1</option>
											<option value="t2">Sem 2</option>
											<option value="t3">Sem 3</option>
											<option value="t4">Sem 4</option>
											<option value="t5">Sem 5</option>
											<option value="t6">Sem 6</option>
											<option value="t7">Sem 7</option>
											<option value="t8">Sem 8</option>
                                        <?php //endforeach; ?>
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
					
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                    <a href="<?= base_url()?>feescategory" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
