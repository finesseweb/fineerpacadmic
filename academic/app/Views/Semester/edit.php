<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Category</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url()?>semester/update/<?= $semester['semester_id'] ?>">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="semester_name" value="<?= $semester['semester_name'] ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="academic_year_id">Academic Year Code</label>
							<div class="col-sm-9">
                            <select name="academic_year_id" id="academic_year_id" class="form-control" required>
							<?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>"><?= $academic['academic_year_code'] ?></option>
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
                            <input type="date" name="start_date" id="start_date" value="<?= $semester['start_date'] ?>" class="form-control" required>
							</div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="end_date">End Date</label>
							<div class="col-sm-9">
                            <input type="date" name="end_date" id="end_date" value="<?= $semester['end_date'] ?>" class="form-control" required>
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
                                            <option value="t1" <?= ($semester['cmn_terms'] == 't1') ? 'selected' : '' ?>>Sem 1</option>
											<option value="t2" <?= ($semester['cmn_terms'] == 't2') ? 'selected' : '' ?>>Sem 2</option>
											<option value="t3" <?= ($semester['cmn_terms'] == 't3') ? 'selected' : '' ?>>Sem 3</option>
											<option value="t4" <?= ($semester['cmn_terms'] == 't4') ? 'selected' : '' ?>>Sem 4</option>
											<option value="t5" <?= ($semester['cmn_terms'] == 't5') ? 'selected' : '' ?>>Sem 5</option>
											<option value="t6" <?= ($semester['cmn_terms'] == 't6') ? 'selected' : '' ?>>Sem 6</option>
											<option value="t7" <?= ($semester['cmn_terms'] == 't7') ? 'selected' : '' ?>>Sem 7</option>
											<option value="t8" <?= ($semester['cmn_terms'] == 't8') ? 'selected' : '' ?>>Sem 8</option>
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
                                        <option value="active" <?= ($semester['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($semester['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
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
                                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    <a href="<?= base_url()?>semester" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
