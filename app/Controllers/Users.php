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
                'systemName' => $this->systemName,
                'systemSubtitleName' => $this->systemSubtitleName,
                'companyName' => $this->companyName,
                'agent' => $this->request->getUserAgent()
            ];
            return view('dashboard/users/index', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function getUsers()
    {
        if (session()->get('role') == 'Administrator') {
            $request = $this->request->getPost();
            $search = $request['search']['value']; // Search value
            $start = $request['start']; // Start index for pagination
            $length = $request['length']; // Length of the page
            $draw = $request['draw']; // Draw counter for DataTables

            // Get sorting parameters
            $order = $request['order'];
            $sortColumnIndex = $order[0]['column']; // Column index
            $sortDirection = $order[0]['dir']; // asc or desc

            // Map column index to the database column name
            $columnMapping = [
                0 => 'id_user',
                1 => 'id_user',
                2 => 'fullname',
                3 => 'username',
                4 => 'role',
            ];

            // Get the column to sort by
            $sortColumn = $columnMapping[$sortColumnIndex] ?? 'id_user';

            $this->AuthModel->select('*')->where('id_user !=', session()->get('id_user'));
            if ($search) {
                $this->AuthModel->groupStart()
                    ->like('fullname', $search)
                    ->orLike('username', $search)
                    ->groupEnd();
            }

            // Get filtered records count
            $filteredRecords = $this->AuthModel->where('id_user !=', session()->get('id_user'))->countAllResults(false);

            // Apply sorting and pagination
            $this->AuthModel->where('id_user !=', session()->get('id_user'))->orderBy($sortColumn, $sortDirection);
            $users = $this->AuthModel->findAll($length, $start);

            // Get total records count
            $totalRecords = $this->AuthModel->where('id_user !=', session()->get('id_user'))->countAllResults(false);

            // Format the data
            $data = [];
            foreach ($users as $user) {
                $data[] = $user;
            }

            // Return the JSON response
            return $this->response->setJSON([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
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
                'fullname' => 'min_length[3]',
                'username' => 'is_unique[user.username]|min_length[3]|alpha_dash',
                'role' => 'required'
            ]);

            if (!$this->validate($validation->getRules())) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

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
            if (!$this->validate($validation->getRules())) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

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
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function resetPassword($id)
    {
        if (session()->get('role') == 'Administrator') {
            $db = db_connect();
            $user = $this->AuthModel->find($id);
            $db->table('user')->set('password', password_hash($user['username'], PASSWORD_DEFAULT))->where('id_user', $id)->update();
            return $this->response->setJSON(['success' => true, 'message' => 'User password successfully reset']);
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
