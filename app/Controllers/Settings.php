<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\DataTables;
use CodeIgniter\Exceptions\PageNotFoundException;

class Settings extends BaseController
{
    protected $SettingsModel;
    protected $DataTables;
    public function __construct()
    {
        // Init Models
        $this->SettingsModel = new SettingsModel();
        $this->DataTables = new DataTables();
    }

    public function index()
    {
        // User Table Count
        $db = db_connect();
        $countadmin = $db->table('user')->where('role', 'Administrator')->countAllResults();
        $data = [
            'countadmin' => $countadmin,
            'title' => 'Settings',
            'agent' => $this->request->getUserAgent()
        ];
        return view('dashboard/settings/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Change User Information',
            'agent' => $this->request->getUserAgent(),
            'validation' => \Config\Services::validation()
        ];
        echo view('dashboard/settings/edit', $data);
    }

    public function update()
    {
        // Validate
        if (session()->get('username') == $this->request->getVar('username')) {
            $username = 'required|alpha_numeric_punct';
        } else {
            $username = 'required|is_unique[user.username]|alpha_numeric_punct';
        }
        if (!$this->validate([
            'fullname' => [
                'label' => 'Full Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!',
                ]
            ],
            'username' => [
                'label' => 'User Name',
                'rules' => $username,
                'errors' => [
                    'required' => '{field} is required!',
                    'is_unique' => '{field} must be different from other {field}s!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        // Save Data
        $this->SettingsModel->save([
            'id_user' => session()->get('id_user'),
            'fullname' => $this->request->getVar('fullname'),
            'username' => $this->request->getVar('username'),
        ]);
        // Set Information into Toast
        if ($this->request->getVar('fullname') == session()->get('fullname') && $this->request->getVar('username') == session()->get('username')) {
            session()->setFlashdata('info', 'No changes you&#39;ve made of your username!');
        } else {
            session()->remove('fullname');
            session()->remove('username');
            session()->set('fullname', $this->request->getVar('fullname'));
            session()->set('username', $this->request->getVar('username'));
            session()->setFlashdata('msg', 'Your username has been been successfully!');
        }
        return redirect()->back();
    }

    public function deleteaccount()
    {
        $db = db_connect();
        $countadmin = $db->table('user')->where('role', 'Administrator')->countAllResults();
        if ($countadmin > 1) {
            $data = [
                'title' => 'Delete Account',
                'agent' => $this->request->getUserAgent()
            ];
            return view('dashboard/settings/deleteaccount', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function about()
    {
        $db = db_connect();
        $php_extensions = get_loaded_extensions();
        $query_version = $db->query('SELECT VERSION() as version');
        $query_comment = $db->query('SHOW VARIABLES LIKE "version_comment"');
        $row_version = $query_version->getRow();
        $row_comment = $query_comment->getRow();
        $agent = $this->request->getUserAgent();
        $data = [
            'php_extensions' => implode(', ', $php_extensions),
            'version' => $row_version->version,
            'version_comment' => $row_comment->Value,
            'agent' => $agent,
            'title' => 'About This System',
            'agent' => $this->request->getUserAgent()
        ];
        return view('dashboard/settings/about', $data);
    }
}
