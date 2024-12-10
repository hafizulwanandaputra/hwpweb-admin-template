<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $AuthModel;
    public function __construct()
    {
        // Init Models
        $this->AuthModel = new AuthModel();
    }

    public function index()
    {
        $data = [
            'title' =>  $this->systemName,
            'agent' => $this->request->getUserAgent(),
            'systemName' => $this->systemName,
            'systemSubtitleName' => $this->systemSubtitleName,
            'companyName' => $this->companyName
        ];
        return view('auth/login', $data);
    }

    public function check_login()
    {
        // Validate
        if (!$this->validate([
            'username' => [
                'label' => 'User Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');
        $url = $this->request->getVar('url');
        $check = $this->AuthModel->login($username);
        // Check Login
        if ($check) {
            if (password_verify($password, $check['password'])) {
                $db = db_connect();
                $session_token = bin2hex(random_bytes(32));

                $user_agent = $this->request->getUserAgent()->getAgentString();
                $ip_address = $this->request->getIPAddress();

                $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $db->table('user_sessions')->insert([
                    'id_user' => $check['id_user'],
                    'session_token' => $session_token,
                    'user_agent' => $user_agent,
                    'ip_address' => $ip_address,
                    'created_at' => date('Y-m-d H:i:s'),
                    'expires_at' => $expires_at
                ]);
                session()->set('id_user', $check['id_user']);
                session()->set('fullname', $check['fullname']);
                session()->set('username', $check['username']);
                session()->set('password', $check['password']);
                session()->set('role', $check['role']);
                session()->set('session_token', $session_token);
                session()->set('created_at', date('Y-m-d H:i:s'));
                session()->set('expires_at', $expires_at);
                session()->set('url', $url);
                return redirect()->to($url);
            } else {
                // Failed Password
                session()->setFlashdata('error', 'Wrong password!');
                return redirect()->back();
            }
        } else {
            // Failed Authentication
            session()->setFlashdata('error', 'Username not registered!');
            return redirect()->back();
        }
    }

    public function register()
    {
        $data = [
            'title' =>  'User Registration - ' . $this->systemName,
            'agent' => $this->request->getUserAgent(),
            'systemName' => $this->systemName,
            'systemSubtitleName' => $this->systemSubtitleName,
            'companyName' => $this->companyName
        ];
        return view('auth/register', $data);
    }

    public function create()
    {
        // Validate
        if (!$this->validate([
            'fullname' => [
                'label' => 'Full Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ],
            'username' => [
                'label' => 'User Name',
                'rules' => 'required|is_unique[user.username]|alpha_numeric_punct',
                'errors' => [
                    'required' => '{field} is required!',
                    'is_unique' => '{field} is already taken!'
                ]
            ],
            'new_password1' => [
                'label' => 'New Password',
                'rules' => 'required|min_length[3]|matches[new_password2]',
                'errors' => [
                    'required' => '{field} is required!',
                    'min_length' => '{field} is at least 3 characters!',
                    'matches' => '{field} does not match with Confirm Password!'
                ]
            ],
            'new_password2' => [
                'label' => 'Confirm Password',
                'rules' => 'required|min_length[3]|matches[new_password1]',
                'errors' => [
                    'required' => '{field} is required!',
                    'min_length' => '{field} is at least 3 characters!',
                    'matches' => '{field} does not match with New Password!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        // Save Data
        $this->AuthModel->save([
            'fullname' => $this->request->getVar('fullname'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('new_password1'), PASSWORD_DEFAULT),
            'role' => 'User'
        ]);
        session()->setFlashdata('msg', 'Successfully register account "' . $this->request->getVar('fullname') . '" (@' . $this->request->getVar('username') . ')!');
        return redirect()->to(base_url());
    }

    public function logout()
    {
        $db = db_connect();
        $db->table('user_sessions')
            ->where('id_user', session()->get('id_user'))
            ->where('session_token', session()->get('session_token'))
            ->delete();
        $db->query('ALTER TABLE `user_sessions` auto_increment = 1');
        session()->remove('id_user');
        session()->remove('fullname');
        session()->remove('username');
        session()->remove('password');
        session()->remove('role');
        session()->remove('session_token');
        session()->remove('created_at');
        session()->remove('expires_at');
        session()->remove('url');
        session()->setFlashdata('msg', 'Logout successful!');
        return redirect()->to(base_url());
    }

    public function delete()
    {
        // Validate
        if (!$this->validate([
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        if (!password_verify($this->request->getVar('password'), session()->get('password'))) {
            session()->setFlashdata('error', 'Incorrect password!');
            return redirect()->back();
        }

        // Begin transaction
        $db = db_connect();
        $db->transBegin();

        try {
            // Delete the user from the database
            $this->AuthModel->delete(session()->get('id_user'));

            // Reset auto-increment value for the 'user' table
            $db->query('ALTER TABLE `user` AUTO_INCREMENT = 1');

            // If all operations succeed, commit the transaction
            if ($db->transStatus() === false) {
                $db->transRollback();
                session()->setFlashdata('error', 'An error occurred while deleting your account. Please try again.');
                return redirect()->back();
            }

            $db->transCommit();
            $db->table('user_sessions')
                ->where('id_user', session()->get('id_user'))
                ->where('session_token', session()->get('session_token'))
                ->delete();
            $db->query('ALTER TABLE `user_sessions` auto_increment = 1');
            session()->remove('id_user');
            session()->remove('fullname');
            session()->remove('username');
            session()->remove('password');
            session()->remove('role');
            session()->remove('session_token');
            session()->remove('created_at');
            session()->remove('expires_at');
            session()->remove('url');

            // Set success message and redirect to home
            session()->setFlashdata('msg', 'Account removed! Thank you!');
            return redirect()->to(base_url());
        } catch (\Exception $e) {
            // Rollback transaction in case of any error
            $db->transRollback();
            session()->setFlashdata('error', 'An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
