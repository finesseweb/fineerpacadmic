<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Fee Head </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url()?>feeshead/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Head List</h4>
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Name</th>
								<th>Category Name</th>
								<th>College Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $slNo = 1; ?>
                            <?php foreach ($fees as $fee): ?>
                                <tr>
                                    <td><?= $slNo++ ?></td>
									<td><?= $fee['fee_head_name']?></td>
                                    <td><?= $fee['fee_category_name']?></td>
									 <td><?= $fee['college_name'] ?></td>
									 <td><?= $fee['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="<?= base_url()?>feeshead/edit/<?= $fee['fee_head_id'] ?>">
                                            <i class="mdi mdi-file-check btn-icon-append">Edit</i>
                                        </a>
                                        <!-- Other table data -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
