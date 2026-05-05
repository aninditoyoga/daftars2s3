<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2">📋 Applicant Details</h1>
            <small class="text-muted"><?= esc($applicant['registration_number']) ?></small>
        </div>
        <div class="col-auto">
            <a href="<?= site_url('admin/applicants') ?>" class="btn btn-secondary">← Back</a>
        </div>
    </div>

    <?php if (session('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif ?>

    <?php if (session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif ?>

    <div class="row g-4">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">👤 Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small">Full Name</label>
                            <p><?= esc($applicant['full_name']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Email</label>
                            <p><a href="mailto:<?= esc($applicant['email']) ?>"><?= esc($applicant['email']) ?></a></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Phone</label>
                            <p><?= esc($applicant['phone']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Gender</label>
                            <p><?= ucfirst($applicant['gender']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Date of Birth</label>
                            <p><?= date('d-M-Y', strtotime($applicant['date_of_birth'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Place of Birth</label>
                            <p><?= esc($applicant['place_of_birth']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Blood Type</label>
                            <p><?= esc($applicant['blood_type'] ?? '-') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Height</label>
                            <p><?= esc($applicant['height'] ?? '-') ?> cm</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">ID Number</label>
                            <p><?= esc($applicant['id_number']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Country</label>
                            <p><?= esc($applicant['country']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Address -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">📍 Address Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small">Home Address</label>
                            <p><?= esc($applicant['home_address']) ?></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Mailing Address</label>
                            <p><?= esc($applicant['mailing_address']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Emergency Contact Name</label>
                            <p><?= esc($applicant['emergency_contact_name']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Emergency Phone</label>
                            <p><?= esc($applicant['emergency_contact_phone']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">🎓 Academic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Program Level</label>
                            <p>
                                <span
                                    class="badge <?= $applicant['program_level'] == 'master' ? 'bg-primary' : 'bg-danger' ?>">
                                    <?= ucfirst($applicant['program_level']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Study Program</label>
                            <p><?= esc($applicant['study_program']) ?></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Last University</label>
                            <p><?= esc($applicant['last_university']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">TOEFL/TOAFL Score</label>
                            <p><?= esc($applicant['toefl_toafl_score'] ?? '-') ?></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Available Days</label>
                            <p>
                                <?php
                                $days = json_decode($applicant['available_days'], true);
                                if ($days) {
                                    foreach ($days as $day) {
                                        echo '<span class="badge bg-light text-dark me-1">' . esc($day) . '</span>';
                                    }
                                } else {
                                    echo '-';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">ℹ️ Additional Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Occupation</label>
                            <p><?= esc($applicant['occupation'] ?? '-') ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Marital Status</label>
                            <p><?= esc(ucfirst($applicant['marital_status'] ?? '-')) ?></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Document File</label>
                            <p>
                                <?php if ($applicant['documents_path']): ?>
                                    <a href="/<?= esc($applicant['documents_path']) ?>" class="btn btn-sm btn-outline-info"
                                        download>
                                        📥 Download
                                    </a>
                                    <small class="text-muted"><?= $applicant['file_size_mb'] ?> MB</small>
                                <?php else: ?>
                                    -
                                <?php endif ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Management -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">⚙️ Status Management</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small">Application Status</label>
                            <p>
                                <span
                                    class="badge bg-<?= $applicant['application_status'] == 'submitted' ? 'info' : ($applicant['application_status'] == 'approved' ? 'success' : 'warning') ?>">
                                    <?= ucfirst($applicant['application_status']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-12">
                            <form method="POST"
                                action="<?= site_url(route_to('admin.updateStatus', $applicant['id'])) ?>"
                                class="d-flex gap-2">
                                <?= csrf_field() ?>
                                <select name="status" class="form-select form-select-sm" required>
                                    <option value="submitted" <?= $applicant['application_status'] == 'submitted' ? 'selected' : '' ?>>Submitted</option>
                                    <option value="reviewed" <?= $applicant['application_status'] == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                                    <option value="approved" <?= $applicant['application_status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="rejected" <?= $applicant['application_status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Payment Status</label>
                            <p>
                                <span
                                    class="badge bg-<?= ($applicant['payment_status'] ?? 'pending') == 'paid' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($applicant['payment_status'] ?? 'pending') ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-12">
                            <form method="POST"
                                action="<?= site_url(route_to('admin.updatePaymentStatus', $applicant['id'])) ?>"
                                class="d-flex gap-2">
                                <?= csrf_field() ?>
                                <select name="payment_status" class="form-select form-select-sm" required>
                                    <option value="pending" <?= ($applicant['payment_status'] ?? 'pending') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="paid" <?= ($applicant['payment_status'] ?? 'pending') == 'paid' ? 'selected' : '' ?>>Paid</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </form>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Virtual Account Number</label>
                            <p><code><?= esc($applicant['payment_va']) ?></code></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small">Submitted Date</label>
                            <p><?= date('d-M-Y H:i', strtotime($applicant['created_at'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>