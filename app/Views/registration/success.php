<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">✅ Registration Submitted</h4>
                </div>
                <div class="card-body">
                    <p>Your postgraduate application has been successfully submitted.</p>
                    <p><strong>Registration Number:</strong> <?= esc($regNumber) ?></p>
                    <p><strong>Virtual Account Number:</strong> <?= esc($vaNumber) ?></p>
                    <p>Please keep this information for payment and future tracking.</p>
                    <a href="/registration" class="btn btn-primary">Submit another application</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>