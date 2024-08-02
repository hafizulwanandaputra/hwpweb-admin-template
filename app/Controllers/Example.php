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
        $examples = $this->ExampleModel->orderBy('id', 'DESC')->findAll();
        $data = [];
        foreach ($examples as $example) {
            $example['image_url'] = base_url('uploads/images/' . $example['image']);
            $data[] = $example;
        }
        return $this->response->setJSON($data);
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
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]',
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
            'image' => 'if_exist|max_size[image,2048]|is_image[image]',
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
