<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\AuthModelEdit;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    protected $AuthModel;
    public function __construct()
    {
        // Init Models
        $this->AuthModel = new AuthModel();
    }

    public function index()
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            $data = [
                'title' => 'Users',
                'agent' => $this->request->getUserAgent()
            ];
            return view('dashboard/users/index', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function getUsers()
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            $data = $this->AuthModel->where('id_user !=', session()->get('id_user'))->orderBy('id_user', 'DESC')->get()->getResult();
            return $this->response->setJSON($data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function getUser($id)
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            $data = $this->AuthModel->where('id_user !=', session()->get('id_user'))->find($id);
            return $this->response->setJSON($data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function addUser()
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            // Validate
            $validation = \Config\Services::validation();
            // Set base validation rules
            $validation->setRules([
                'fullname' => 'required|min_length[3]',
                'username' => 'required|is_unique[user.username]|min_length[3]|alpha_dash',
                'role' => 'required'
            ]);
            if ($this->request->getMethod() == 'post' && $validation->withRequest($this->request)->run()) {
                // Save Data
                $data = [
                    'fullname' => $this->request->getPost('fullname'),
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('username'), PASSWORD_DEFAULT),
                    'role' => $this->request->getPost('role')
                ];
                $this->AuthModel->save($data);
                return $this->response->setJSON(['success' => true, 'message' => 'User added successfully']);
            } else {
                // If validation fails
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function updateUser()
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            $validation = \Config\Services::validation();
            $userId = $this->request->getPost('id_user');
            // Set base validation rules
            $validation->setRules([
                'fullname' => 'required|min_length[3]',
                'username' => 'required|min_length[3]|alpha_dash',
                'role' => 'required'
            ]);
            // Validate only if username has changed
            if ($this->request->getPost('username') != $this->request->getPost('original_username')) {
                $validation->setRule('username', 'username', 'required|is_unique[user.username]|min_length[3]|alpha_dash');
            }
            if ($this->request->getMethod() == 'post' && $validation->withRequest($this->request)->run()) {
                // Save Data
                $data = [
                    'id_user' => $this->request->getPost('id_user'),
                    'fullname' => $this->request->getPost('fullname'),
                    'username' => $this->request->getPost('username'),
                    'role' => $this->request->getPost('role')
                ];
                $AuthModelEdit = new AuthModelEdit();
                $AuthModelEdit->save($data);
                return $this->response->setJSON(['success' => true, 'message' => 'User updated successfully']);
            } else {
                // If validation fails
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function deleteUser($id)
    {
        // Administrator Only
        if (session()->get('role') == 'Administrator') {
            $this->AuthModel->delete($id);
            $db = db_connect();
            // Reset Auto Increment Value
            $db->query('ALTER TABLE `user` auto_increment = 1');
            return $this->response->setJSON(['message' => 'User deleted successfully']);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
