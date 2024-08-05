<?php

namespace App\Controllers;

use App\Models\ExampleModel;

class Example extends BaseController
{
    protected $ExampleModel;
    public function __construct()
    {
        // Init Models
        $this->ExampleModel = new ExampleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Example CRUD',
            'agent' => $this->request->getUserAgent()
        ];
        return view('dashboard/example/index', $data);
    }

    public function getExamples()
    {
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
            0 => 'id',
            1 => 'id',
            2 => 'id',
            3 => 'name',
            4 => 'email',
            5 => 'phonenumber',
            6 => 'address',
        ];

        // Get the column to sort by
        $sortColumn = $columnMapping[$sortColumnIndex] ?? 'id';

        // Get total records count
        $totalRecords = $this->ExampleModel->countAll();

        // Apply search query
        if ($search) {
            $this->ExampleModel->like('name', $search)
                ->orLike('email', $search)
                ->orLike('phonenumber', $search)
                ->orLike('address', $search)
                ->orderBy($sortColumn, $sortDirection);
        }

        // Get filtered records count
        $filteredRecords = $this->ExampleModel->countAllResults(false);

        // Fetch the data
        $examples = $this->ExampleModel->orderBy($sortColumn, $sortDirection)
            ->findAll($length, $start);

        // Format the data
        $data = [];
        foreach ($examples as $example) {
            $example['image_url'] = base_url('uploads/images/' . $example['image']);
            $data[] = $example;
        }

        // Return the JSON response
        return $this->response->setJSON([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    public function getExample($id)
    {
        $data = $this->ExampleModel->find($id);
        return $this->response->setJSON($data);
    }

    public function addExample()
    {
        // Validate
        $validation = \Config\Services::validation();
        // Set base validation rules
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'phonenumber' => 'required|integer',
            'address' => 'required',
            'image' => 'uploaded[image]|max_size[image,8192]|is_image[image]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/images', $newName);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => ['image' => 'Image upload failed']]);
        }

        // Update in database
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phonenumber' => $this->request->getPost('phonenumber'),
            'address' => $this->request->getPost('address'),
            'image' => $newName
        ];

        $this->ExampleModel->save($data);

        return $this->response->setJSON(['success' => true, 'message' => 'Example data added successfully!']);
    }

    public function updateExample()
    {
        // Validate
        $validation = \Config\Services::validation();
        // Set base validation rules
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'phonenumber' => 'required|integer',
            'address' => 'required',
            'image' => 'if_exist|max_size[image,8192]|is_image[image]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $exampleId = $this->request->getPost('id');
        $exampleData = $this->ExampleModel->find($exampleId);

        $data = [
            'id' => $exampleId,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phonenumber' => $this->request->getPost('phonenumber'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle image upload
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/images', $newName);

            // Update data with new image paths
            $data['image'] = $newName;

            // Optionally, delete the old images
            if ($exampleData['image']) {
                unlink(FCPATH . 'uploads/images/' . $exampleData['image']);
            }
        }

        $this->ExampleModel->save($data);

        return $this->response->setJSON(['success' => true, 'message' => 'Example data updated successfully!']);
    }

    public function deleteExample($id)
    {
        $exampleData = $this->ExampleModel->find($id);
        if ($exampleData) {
            // Delete the associated images
            if ($exampleData['image']) {
                @unlink(FCPATH . 'uploads/images/' . $exampleData['image']);
            }

            // Delete the user from the database
            $this->ExampleModel->delete($id);
            $db = db_connect();
            // Reset Auto Increment Value
            $db->query('ALTER TABLE `example` auto_increment = 1');
            return $this->response->setJSON(['success' => true, 'message' => 'Example data deleted successfully!']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Example data not found!']);
        }
    }
}
