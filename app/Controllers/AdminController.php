<?php
namespace App\Controllers;

use App\Models\ApplicantModel;
use App\Models\UserAdminModel;

class AdminController extends BaseController
{
    protected ApplicantModel $applicantModel;
    protected UserAdminModel $userAdminModel;

    public function __construct()
    {
        $this->applicantModel = new ApplicantModel();
        $this->userAdminModel = new UserAdminModel();
    }

    public function dashboard()
    {
        $data = [
            'total_applicants' => $this->applicantModel->countAll(),
            'submitted' => $this->applicantModel->where('application_status', 'submitted')->countAllResults(),
            'paid' => $this->applicantModel->where('payment_status', 'paid')->countAllResults(),
            'pending_payment' => $this->applicantModel->where('payment_status', 'pending')->countAllResults(),
            'master_applicants' => $this->applicantModel->where('program_level', 'master')->countAllResults(),
            'doctoral_applicants' => $this->applicantModel->where('program_level', 'doctoral')->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }

    public function applicants()
    {
        $page = $this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search') ?? '';
        $status = $this->request->getVar('status') ?? '';
        $program = $this->request->getVar('program') ?? '';
        $perPage = 20;

        $query = $this->applicantModel;

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('full_name', $search)
                ->orLike('email', $search)
                ->orLike('registration_number', $search)
                ->groupEnd();
        }

        if (!empty($status)) {
            $query = $query->where('application_status', $status);
        }

        if (!empty($program)) {
            $query = $query->where('program_level', $program);
        }

        $data = [
            'applicants' => $query->paginate($perPage),
            'pager' => $this->applicantModel->pager,
            'search' => $search,
            'status' => $status,
            'program' => $program,
            'total' => $query->countAllResults(),
        ];

        return view('admin/applicants', $data);
    }

    public function detail($id)
    {
        $applicant = $this->applicantModel->find($id);

        if (!$applicant) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Applicant not found');
        }

        $data = [
            'applicant' => $applicant,
        ];

        return view('admin/applicant-detail', $data);
    }

    public function updateStatus($id)
    {
        log_message('debug', 'updateStatus called with ID: ' . $id);

        $applicant = $this->applicantModel->find($id);
        if (!$applicant) {
            log_message('error', 'Applicant not found with ID: ' . $id);
            return redirect()->back()->with('error', 'Applicant not found');
        }

        $status = $this->request->getPost('status') ?? $this->request->getGet('status');
        log_message('debug', 'Status received: ' . $status);

        if (!$status) {
            return redirect()->back()->with('error', 'Status is required');
        }

        $result = $this->applicantModel->update($id, ['application_status' => $status]);
        log_message('debug', 'Update result: ' . ($result ? 'success' : 'failed'));

        return redirect()->back()->with('message', 'Status updated successfully');
    }

    public function updatePaymentStatus($id)
    {
        log_message('debug', 'updatePaymentStatus called with ID: ' . $id);

        $applicant = $this->applicantModel->find($id);
        if (!$applicant) {
            log_message('error', 'Applicant not found with ID: ' . $id);
            return redirect()->back()->with('error', 'Applicant not found');
        }

        $payment_status = $this->request->getPost('payment_status');
        log_message('debug', 'Payment status received: ' . $payment_status);

        if (!$payment_status) {
            return redirect()->back()->with('error', 'Payment status is required');
        }

        $result = $this->applicantModel->update($id, ['payment_status' => $payment_status]);
        log_message('debug', 'Update result: ' . ($result ? 'success' : 'failed'));

        return redirect()->back()->with('message', 'Payment status updated successfully');
    }

    public function export()
    {
        $applicants = $this->applicantModel->findAll();

        $csv = "Registration No,Full Name,Email,Phone,Program Level,Study Program,Country,Application Status,Payment Status,Created At\n";

        foreach ($applicants as $app) {
            $csv .= "\"" . implode("\",\"", [
                $app['registration_number'],
                $app['full_name'],
                $app['email'],
                $app['phone'],
                $app['program_level'],
                $app['study_program'],
                $app['country'],
                $app['application_status'],
                $app['payment_status'] ?? 'pending',
                $app['created_at']
            ]) . "\"\n";
        }

        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="applicants-' . date('Y-m-d') . '.csv"')
            ->setBody($csv);
    }

    public function statistics()
    {
        $data = [
            'by_program' => $this->applicantModel->select('program_level, COUNT(*) as count')
                ->groupBy('program_level')
                ->findAll(),
            'by_country' => $this->applicantModel->select('country, COUNT(*) as count')
                ->groupBy('country')
                ->orderBy('count', 'DESC')
                ->limit(10)
                ->findAll(),
            'by_status' => $this->applicantModel->select('application_status, COUNT(*) as count')
                ->groupBy('application_status')
                ->findAll(),
            'by_payment' => $this->applicantModel->select('payment_status, COUNT(*) as count')
                ->groupBy('payment_status')
                ->findAll(),
        ];

        return view('admin/statistics', $data);
    }

    public function login()
    {
        return view('admin/login', [
            'login_error' => session('login_error'),
        ]);
    }

    public function authenticate()
    {
        helper('url');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Get user from database
        $user = $this->userAdminModel->getByUsername($username);

        if ($user && $this->userAdminModel->verifyPassword($password, $user['password'])) {
            session()->set([
                'isAdminLoggedIn' => true,
                'admin_id' => $user['id'],
                'admin_username' => $user['username'],
                'admin_email' => $user['email'],
                'admin_full_name' => $user['full_name'],
            ]);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('login_error', 'Username atau password salah.');
    }

    public function logout()
    {
        helper('url');
        session()->destroy();
        return redirect()->to(site_url('admin/login'));
    }
}
