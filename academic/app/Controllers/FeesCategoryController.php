<?php

namespace App\Controllers;

use App\Models\FeesCategoryModel;
use App\Models\CollegeModel;
use CodeIgniter\Controller;

class FeesCategoryController extends Controller
{
    private $feecategoryModel;
    private $collegeModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->feecategoryModel = new FeesCategoryModel();
		$this->collegeModel = new CollegeModel();
        
		
    }

    // Common method to load header, sidebar, and footer views
    private function loadCommonViews($viewName, $data = [])
    {
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view($viewName, $data);
        echo view('templates/footer', $data);
    }

    public function index()
    {
        $data['fees'] = $this->feecategoryModel->findAllActivefeesCategory();
		//print_r($data); die();
        $this->loadCommonViews('Feescategory/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
        $this->loadCommonViews('Feescategory/create', $data);
    }

    public function store()
    {
        $feecategoryModel = $this->feecategoryModel;
        $validationRules = $feecategoryModel->getValidationRules();
//print_r($validationRules); die();

        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $feecategoryModel->save([
                'fee_category_name' => $this->request->getPost('fee_category_name'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/feescategory')->with('success', 'Category added successfully');
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		 $this->loadCommonViews('Feescategory/create', $data);
    }

    public function edit($id)
    {
        $data['fees'] = $this->feecategoryModel->find($id);
      // print_r($data); die();
        if (!$data['fees']) {
            return redirect()->to('/feescategory')->with('error', 'Fees Category not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Feescategory/edit', $data);
    }

    public function update($id)
    {
        $feescategory = $this->feecategoryModel->find($id);

        if (!$feescategory) {
            return redirect()->to('/feescategory')->with('error', 'fees category not found');
        }

        $validationRules = $this->feecategoryModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->feecategoryModel->update($id, [
               'fee_category_name' => $this->request->getPost('fee_category_name'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/feescategory')->with('success', 'Fees Category updated successfully');
        }

        $data['feescategory'] = $feescategory;
       $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->AcademicYearModel->GetData();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Professor/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/courses')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/courses')->with('success', 'Course deleted successfully');
    }
}
