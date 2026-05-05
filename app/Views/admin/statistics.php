<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2">📈 Statistics & Analytics</h1>
        </div>
        <div class="col-auto">
            <a href="<?= site_url(route_to('admin.dashboard')) ?>" class="btn btn-secondary">← Back to Dashboard</a>
        </div>
    </div>

    <!-- Application Status Distribution -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Application Status Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_status = array_sum(array_column($by_status, 'count'));
                                foreach ($by_status as $row):
                                    $percentage = $total_status > 0 ? round(($row['count'] / $total_status) * 100, 1) : 0;
                                    ?>
                                    <tr>
                                        <td>
                                            <span
                                                class="badge bg-<?= $row['application_status'] == 'submitted' ? 'info' : ($row['application_status'] == 'approved' ? 'success' : 'warning') ?>">
                                                <?= ucfirst($row['application_status']) ?>
                                            </span>
                                        </td>
                                        <td class="text-end"><strong><?= $row['count'] ?></strong></td>
                                        <td class="text-end"><?= $percentage ?>%</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="progress" style="height: 25px;">
                        <?php
                        $colors = ['submitted' => 'info', 'reviewed' => 'warning', 'approved' => 'success', 'rejected' => 'danger'];
                        $position = 0;
                        foreach ($by_status as $row):
                            $percentage = $total_status > 0 ? round(($row['count'] / $total_status) * 100, 1) : 0;
                            ?>
                            <div class="progress-bar bg-<?= $colors[$row['application_status']] ?? 'secondary' ?>"
                                role="progressbar" style="width: <?= $percentage ?>%;"
                                title="<?= ucfirst($row['application_status']) ?>">
                                <?php if ($percentage > 5):
                                    echo $percentage . '%';
                                endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status Distribution -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Payment Status Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_payment = array_sum(array_column($by_payment, 'count'));
                                foreach ($by_payment as $row):
                                    $percentage = $total_payment > 0 ? round(($row['count'] / $total_payment) * 100, 1) : 0;
                                    ?>
                                    <tr>
                                        <td>
                                            <span
                                                class="badge bg-<?= ($row['payment_status'] ?? 'pending') == 'paid' ? 'success' : 'warning' ?>">
                                                <?= ucfirst($row['payment_status'] ?? 'pending') ?>
                                            </span>
                                        </td>
                                        <td class="text-end"><strong><?= $row['count'] ?></strong></td>
                                        <td class="text-end"><?= $percentage ?>%</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="progress" style="height: 25px;">
                        <?php
                        foreach ($by_payment as $row):
                            $percentage = $total_payment > 0 ? round(($row['count'] / $total_payment) * 100, 1) : 0;
                            ?>
                            <div class="progress-bar bg-<?= ($row['payment_status'] ?? 'pending') == 'paid' ? 'success' : 'warning' ?>"
                                role="progressbar" style="width: <?= $percentage ?>%;"
                                title="<?= ucfirst($row['payment_status'] ?? 'pending') ?>">
                                <?php if ($percentage > 5):
                                    echo $percentage . '%';
                                endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Program Distribution -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Program Level Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Program Level</th>
                                    <th class="text-end">Count</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_program = array_sum(array_column($by_program, 'count'));
                                foreach ($by_program as $row):
                                    $percentage = $total_program > 0 ? round(($row['count'] / $total_program) * 100, 1) : 0;
                                    ?>
                                    <tr>
                                        <td>
                                            <span
                                                class="badge bg-<?= $row['program_level'] == 'master' ? 'primary' : 'danger' ?>">
                                                <?= ucfirst($row['program_level']) ?>
                                            </span>
                                        </td>
                                        <td class="text-end"><strong><?= $row['count'] ?></strong></td>
                                        <td class="text-end"><?= $percentage ?>%</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Countries -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Top 10 Countries</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th class="text-end">Applicants</th>
                                    <th class="text-end">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_countries = array_sum(array_column($by_country, 'count'));
                                foreach ($by_country as $row):
                                    $percentage = $total_countries > 0 ? round(($row['count'] / $total_countries) * 100, 1) : 0;
                                    ?>
                                    <tr>
                                        <td><?= esc($row['country']) ?></td>
                                        <td class="text-end"><strong><?= $row['count'] ?></strong></td>
                                        <td class="text-end"><?= $percentage ?>%</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>