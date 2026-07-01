<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    private $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    // 1. READ: Display all employees
    public function index()
    {
        $data['employees'] = $this->employeeModel->findAll();
        return view('employees/index', $data);
    }

    // 2. CREATE: Show form
    public function create()
    {
        return view('employees/create');
    }

    // 3. CREATE: Store data with Validation
    public function store()
    {
        $rules = [
            'name'       => 'required|min_length[3]',
            'email'      => 'required|valid_email|is_unique[employees.email]',
            'department' => 'required',
            'position'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('employees/create', ['validation' => $this->validator]);
        }

        $this->employeeModel->save([
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'department' => $this->request->getPost('department'),
            'position'   => $this->request->getPost('position'),
        ]);

        return redirect()->to('/employees')->with('success', 'Employee added successfully!');
    }

    // 4. UPDATE: Show Edit form
    public function edit($id = null)
    {
        $data['employee'] = $this->employeeModel->find($id);
        
        if (!$data['employee']) {
            return redirect()->to('/employees');
        }

        return view('employees/edit', $data);
    }

    // 5. UPDATE: Save changed data
    public function update($id = null)
    {
        // For unique email check during update, exclude current employee's ID
        $rules = [
            'name'       => 'required|min_length[3]',
            'email'      => "required|valid_email|is_unique[employees.email,id,{$id}]",
            'department' => 'required',
            'position'   => 'required',
        ];

        if (!$this->validate($rules)) {
            $data['employee'] = $this->employeeModel->find($id);
            $data['validation'] = $this->validator;
            return view('employees/edit', $data);
        }

        $this->employeeModel->update($id, [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'department' => $this->request->getPost('department'),
            'position'   => $this->request->getPost('position'),
        ]);

        return redirect()->to('/employees')->with('success', 'Employee updated successfully!');
    }

    // 6. DELETE: Remove data
    public function delete($id = null)
    {
        if ($id) {
            $this->employeeModel->delete($id);
        }
        return redirect()->to('/employees')->with('success', 'Employee deleted successfully!');
    }
}