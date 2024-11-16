<?php

namespace App\Controllers;

use App\Models\ChangePasswordModel;

class ChangePassword extends BaseController
{
    protected $ChangePasswordModel;
    public function __construct()
    {
        // Init Models
        $this->ChangePasswordModel = new ChangePasswordModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Change Password - ' . $this->systemName,
            'agent' => $this->request->getUserAgent()
        ];
        return view('dashboard/changepassword/index', $data);
    }
    public function update()
    {
        // Validate
        if (!$this->validate([
            'current_password' => [
                'label' => 'Current Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required!'
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
        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password1');
        // Verify Password
        if (!password_verify($current_password, session()->get('password'))) {
            // Incorrect Old Password
            session()->setFlashdata('error', 'Incorrect old password!');
            return redirect()->back();
        } else {
            if ($current_password == $new_password) {
                // Same New Password
                session()->setFlashdata('error', 'The new password <strong>must be different</strong> from the old password!');
                return redirect()->back();
            } else {
                // New Password
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->ChangePasswordModel->save([
                    'id_user' => session()->get('id_user'),
                    'password' => $password_hash
                ]);
                session()->remove('password');
                session()->set('password', $password_hash);
                session()->setFlashdata('msg', 'Your password has been successfully changed to your new password!');
                return redirect()->back();
            }
        }
    }
}
