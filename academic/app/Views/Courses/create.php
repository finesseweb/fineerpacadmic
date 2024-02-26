<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Course</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url()?>courses/store">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Course Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="course_name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Department Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department_id" required>
                                        <?php foreach ($department as $depart): ?>
                                            <option value="<?= $depart['department_id'] ?>"><?= strtoupper($depart['department_name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
					 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Academic Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="academic_year_id" required>
                                        <?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>"><?= $academic['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">College Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="college_id" required>
                                        <?php foreach ($colleges as $college): ?>
                                            <option value="<?= $college['college_id'] ?>"><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
					 <div class="row">
					 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Credits</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="credits" required />
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
                                    <a href="<?= base_url()?>courses" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
