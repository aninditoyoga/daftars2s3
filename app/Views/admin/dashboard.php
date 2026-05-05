<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2">📊 Admin Dashboard</h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Total Applicants</h6>
                    <h3 class="mb-0"><?= $total_applicants ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Submitted</h6>
                    <h3 class="mb-0"><?= $submitted ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Payment Verified</h6>
                    <h3 class="mb-0"><?= $paid ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Pending Payment</h6>
                    <h3 class="mb-0"><?= $pending_payment ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Program Distribution -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Program Distribution</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <h4 class="text-primary"><?= $master_applicants ?></h4>
                                <small class="text-muted">Master (S2)</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h4 class="text-danger"><?= $doctoral_applicants ?></h4>
                                <small class="text-muted">Doctoral (S3)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Actions</h5>
                    <div class="btn-group-vertical w-100" role="group">
                        <a href="<?= site_url('admin/applicants') ?>" class="btn btn-outline-primary text-start">👥 View
                            All Applicants</a>
                        <a href="<?= site_url(route_to('admin.statistics')) ?>"
                            class="btn btn-outline-success text-start">📈 View
                            Statistics</a>
                        <a href="<?= site_url(route_to('admin.export')) ?>" class="btn btn-outline-info text-start">📥
                            Export to
                            CSV</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Recent Applications</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Registration No</th>
                        <th>Full Name</th>
                        <th>Program</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($total_applicants)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">No applications yet</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>