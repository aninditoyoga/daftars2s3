<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Postgraduate Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            padding: 20px 0;
            position: sticky;
            top: 0;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 5px 0;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #34495e;
            border-left-color: #3498db;
            color: #fff;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            border-bottom: 2px solid rgba(0, 0, 0, 0.125);
        }

        .navbar-admin {
            background-color: #34495e;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            padding-left: 250px;
        }

        @media (max-width: 768px) {
            .main-content {
                padding-left: 0;
            }

            .sidebar {
                position: relative;
                min-height: auto;
            }
        }

        .badge {
            padding: 6px 10px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-group-vertical .btn {
            border: 1px solid #dee2e6;
            text-align: left;
            padding: 10px 15px;
        }

        .btn-group-vertical .btn:hover {
            background-color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="text-center mb-4">
                <h5 class="text-white">📊 Admin Panel</h5>
                <small class="text-muted">Postgraduate Registration</small>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= current_url() == site_url('admin/dashboard') ? 'active' : '' ?>"
                        href="<?= site_url('admin/dashboard') ?>">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= current_url() == site_url('admin/applicants') ? 'active' : '' ?>"
                        href="<?= site_url('admin/applicants') ?>">
                        <i class="fas fa-users"></i> Applicants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= current_url() == site_url(route_to('admin.statistics')) ? 'active' : '' ?>"
                        href="<?= site_url(route_to('admin.statistics')) ?>">
                        <i class="fas fa-chart-bar"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url(route_to('admin.export')) ?>">
                        <i class="fas fa-download"></i> Export Data
                    </a>
                </li>
                <hr class="bg-light">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('admin/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Top Navigation Bar -->
            <nav class="navbar navbar-admin navbar-expand-lg navbar-dark sticky-top">
                <div class="container-fluid">
                    <span class="navbar-text text-light">
                        <i class="fas fa-home"></i> Postgraduate Application System
                    </span>
                    <div class="ms-auto">
                        <span class="text-light me-3">
                            <i class="far fa-calendar"></i> <?= date('d-M-Y H:i') ?>
                        </span>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="main-section">
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Footer -->
            <footer class="bg-light text-center py-3 mt-5 border-top">
                <small class="text-muted">
                    &copy; 2026 Postgraduate Application System. All rights reserved.
                </small>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>