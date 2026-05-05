<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2">👥 Applicants List</h1>
        </div>
        <div class="col-auto">
            <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">← Back to Dashboard</a>
            <a href="<?= site_url(route_to('admin.export')) ?>" class="btn btn-info">📥 Export CSV</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name, email, or reg no..." value="<?= $search ?>">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="submitted" <?= $status == 'submitted' ? 'selected' : '' ?>>Submitted</option>
                        <option value="reviewed" <?= $status == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                        <option value="approved" <?= $status == 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="rejected" <?= $status == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="program" class="form-select">
                        <option value="">All Programs</option>
                        <option value="master" <?= $program == 'master' ? 'selected' : '' ?>>Master (S2)</option>
                        <option value="doctoral" <?= $program == 'doctoral' ? 'selected' : '' ?>>Doctoral (S3)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Applicants Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Total: <?= $total ?> applicants</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Registration No</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Program Level</th>
                        <th>Study Program</th>
                        <th>Country</th>
                        <th>Application Status</th>
                        <th>Payment Status</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($applicants)): ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">No applicants found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($applicants as $app): ?>
                            <tr>
                                <td><strong><?= esc($app['registration_number']) ?></strong></td>
                                <td><?= esc($app['full_name']) ?></td>
                                <td><?= esc($app['email']) ?></td>
                                <td><?= esc($app['phone']) ?></td>
                                <td>
                                    <span class="badge <?= $app['program_level'] == 'master' ? 'bg-primary' : 'bg-danger' ?>">
                                        <?= ucfirst($app['program_level']) ?>
                                    </span>
                                </td>
                                <td><?= esc(substr($app['study_program'], 0, 30)) ?></td>
                                <td><?= esc($app['country']) ?></td>
                                <td>
                                    <span
                                        class="badge bg-<?= $app['application_status'] == 'submitted' ? 'info' : ($app['application_status'] == 'approved' ? 'success' : 'warning') ?>">
                                        <?= ucfirst($app['application_status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-<?= ($app['payment_status'] ?? 'pending') == 'paid' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($app['payment_status'] ?? 'pending') ?>
                                    </span>
                                </td>
                                <td><?= date('d-M-Y', strtotime($app['created_at'])) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/applicants/' . $app['id']) ?>"
                                        class="btn btn-sm btn-outline-primary">👁️ View</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <nav class="mt-4">
            <?= $pager->links() ?>
        </nav>
    <?php endif ?>
</div>

<?= $this->endSection() ?>