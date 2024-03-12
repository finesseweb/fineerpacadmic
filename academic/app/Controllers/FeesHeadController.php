<?php

namespace App\Controllers;

use App\Models\FeesHeadModel;
use App\Models\FeesCategoryModel;
use App\Models\CollegeModel;
use CodeIgniter\Controller;

class FeesHeadController extends Controller
{
    private $feecategoryModel;
    private $collegeModel;
	private $feehaedModel;
    private $session;

    public function __construct()
    {
        $this->session = session();
        $this->feecategoryModel = new FeesCategoryModel();
		$this->feehaedModel = new FeesHeadModel();
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
        $data['fees'] = $this->feehaedModel->findAllActivefeeshead();
		//print_r($data); die();
        $this->loadCommonViews('Feeshead/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['fees'] = $this->feecategoryModel->findAllActivefeesCategory();
        $this->loadCommonViews('Feeshead/create', $data);
    }

    public function store()
    {
        $feehaedModel = $this->feehaedModel;
        $validationRules = $feehaedModel->getValidationRules();
//print_r($validationRules); die();
///print_r($_POST); die();
        
        if ($this->request->getMethod() === 'post') {
			
			for ($i=0;$i<count($this->request->getPost('fee_head_name'));$i++) {
				$heads=$this->request->getPost('fee_head_name'); 
           
		   
		     $data= [
			    'fee_head_name' =>$heads[$i],
				'fee_category_id'=>$this->request->getPost('fee_category_id'),
				'status'=>$this->request->getPost('status'),
				'college_id'=>$this->request->getPost('college_id')
              ];
			 
			 //print_r($data); die();
			 
             $insert= $this->feehaedModel->insert($data);
			 
			 
			 
           }
            return redirect()->to('/feeshead')->with('success', 'Head added successfully'); 
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['fees'] = $this->feecategoryModel->findAllActivefeesCategory();
		 $this->loadCommonViews('Feeshead/create', $data);
    }

    public function edit($id)
    {
        $data['fees'] = $this->feehaedModel->find($id);
      // print_r($data); die();
        if (!$data['fees']) {
            return redirect()->to('/feeshead')->with('error', 'Fees Category not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['feescategorys'] = $this->feecategoryModel->findAllActivefeesCategory();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Feeshead/edit', $data);
    }

    public function update($id)
    {
        $feehaed = $this->feehaedModel->find($id);

        if (!$feehaed) {
            return redirect()->to('/feeshead')->with('error', 'fees category not found');
        }

        $validationRules = $this->feehaedModel->getValidationRules();

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
            $this->feehaedModel->update($id, [
                'fee_head_name' => $this->request->getPost('fee_head_name'),
				'college_id' => $this->request->getPost('college_id'),
				'fee_category_id' => $this->request->getPost('fee_category_id'),
                'status' => $this->request->getPost('status'),
            ]);

            return redirect()->to('/feeshead')->with('success', 'Fees Category updated successfully');
        }

        $data['feehaed'] = $feehaed;
       $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['feescategorys'] = $this->feecategoryModel->findAllActivefeesCategory();
		//$data['degrees'] = $this->degreeModel->GetData();
		//$data['department'] = $this->departmentModel->findAllActiveDepartments();
        $this->loadCommonViews('Feeshead/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/Feeshead')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/Feeshead')->with('success', 'Course deleted successfully');
    }
}
