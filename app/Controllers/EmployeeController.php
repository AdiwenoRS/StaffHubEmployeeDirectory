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
        // 1. Get query parameters from the URL (Gethandlers)
        $search     = $this->request->getGet('search');
        $department = $this->request->getGet('department');
    
        // 2. Build the query dynamically using the Model so paginate() works
        $query = $this->employeeModel;
    
        if (!empty($search)) {
            // Look for matches in Name OR Email
            $query = $query->groupStart()
                           ->like('name', $search)
                           ->orLike('email', $search)
                           ->groupEnd();
        }
    
        if (!empty($department)) {
            // Look for exact match in Department
            $query = $query->where('department', $department);
        }
    
        // 3. Fetch unique departments for our filter dropdown menu
        $data['departments'] = (new EmployeeModel())->distinct()->findColumn('department') ?? [];
    
        // 4. Paginate the results (Change '5' to whatever number of rows per page you want)
        $data['employees'] = $query->paginate(5);
        $data['pager'] = $query->pager->only(['search', 'department']);
        // $data['pager']     = $this->employeeModel->pager;
    
        // 5. Retain search/filter values in the view inputs
        $data['search']          = $search;
        $data['selected_dept']   = $department;
    
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