

    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="main-panel">
 <div class="row">
<div class="col-12">
            <div class="card">
                <div class="card-body">
				  <h4 class="card-title">Edit Academic Year</h4>
                    <form method="post" action="<?= base_url()?>academicyears/update/<?= $academicYear['academic_year_id']; ?>">
                        <?= csrf_field() ?>
						<div class="row">
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="academic_year_code">Academic Year Code</label>
                            <input type="text" name="academic_year_code" id="academic_year_code" class="form-control" value="<?= $academicYear['academic_year_code']; ?>" required>
                        </div>
						</div>
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $academicYear['start_date']; ?>" required>
                        </div>
						</div>
						</div>
						<div class="row">
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $academicYear['end_date']; ?>" required>
                        </div>
						</div>
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="university_id">Select University</label>
                            <select name="university_id" id="university_id" class="form-control" required>
                                <option value="">Select a University</option>
                                <?php foreach ($universities as $university): ?>
                                    <option value="<?= $university['university_id']; ?>" <?= $university_id == $university['university_id'] ? 'selected' : ''; ?>>
                                        <?= $university['university_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
						</div>
						</div>
						<div class="row">
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="college_id">Select Colleges</label>
                            <select name="college_id[]" id="college_id" class="form-control" multiple required>
                                <?php foreach ($related_colleges as $college): ?>
                                    <option value="<?= $college['college_id']; ?>" <?= in_array($college['college_id'], $selected_colleges) ? 'selected' : ''; ?>>
                                        <?= $college['college_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
						</div>
						 <div class="col-md-6">
                        <div class="form-group">
                            <label for="Cast">Cast Category implementation</label>
                            <select name="cast_cat" id="cast_cat" class="form-control" required>
                                <option value="no" <?= $academicYear['cast_cat'] == 'no' ? 'selected' : ''; ?>>No</option>
                                <option value="yes" <?= $academicYear['cast_cat'] == 'yes' ? 'selected' : ''; ?>>Yes</option>
                            </select>
                        </div>
						</div>
						</div>
						<div class="row">
						 <div class="col-md-6">
                        <div class="form-group">
						<label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" <?= $academicYear['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $academicYear['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
						</div>
						</div>
						</div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                        <a href="<?= base_url()?>academicyears" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Listen for changes in the university dropdown
        $('#university_id').change(function () {
            var universityId = $(this).val();

            // Make an AJAX request to fetch colleges for the selected university
            $.ajax({
                type: 'GET',
                url: '/academicyear/getCollegesByUniversity/' + universityId,
                dataType: 'json',
                success: function (data) {
                    var collegeDropdown = $('#college_id');
                    collegeDropdown.empty(); // Clear previous options

                    if (data.length > 0) {
                        // Populate the college dropdown with fetched data
                        $.each(data, function (index, college) {
                            collegeDropdown.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
                        });
                    } else {
                        // If no colleges found for the selected university
                        collegeDropdown.append('<option value="">No colleges available</option>');
                    }
                },
                error: function () {
                    console.error('Error fetching colleges.');
                }
            });
        });
    });
</script>
