<?php

namespace App\Controllers;

use App\Models\CasteCategoryModel;
use App\Models\AcademicYearModel;
use App\Models\CollegeModel;
use App\Models\FeeStructureModel;
use App\Models\FeesCategoryModel;
use App\Models\FeesHeadModel;
use App\Models\FeeStructureDetailsModel;
use App\Models\CourseModel;
use App\Models\SemesterModel;
use App\Models\FeeStructureItemModel;



use CodeIgniter\Controller;

class FeeStructureController extends Controller
{
    private $castategoryModel;
    private $collegeModel;
    private $academicyearModel;
	private $feestructureModel;
	private $feescategoryModel;
    private $feesheadModel;
	private $feestructuredetailsModel;
	private $coursesModel;
    private $session;
	private $feestructureitemModel;

    public function __construct()
    {
        $this->session = session();
        $this->castategoryModel = new CasteCategoryModel();
		$this->collegeModel = new CollegeModel();
		$this->academicyearModel = new AcademicYearModel();
		$this->feestructureModel = new FeeStructureModel();
		$this->feescategoryModel = new FeesCategoryModel();
        $this->feesheadModel = new FeesHeadModel();
		$this->coursesModel = new CourseModel();
		$this->feestructuredetailsModel = new FeeStructureDetailsModel();
		$this->semesterModel = new SemesterModel();
		$this->feestructureitemModel = new FeeStructureItemModel();
		
    }

    // Common method to load header, sidebar, and footer views
    private function loadCommonViews($viewName, $data = [])
    {
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view($viewName, $data);
        echo view('templates/footer', $data);
    }
	
	 private function loadCommonViews1($viewName, $data = [])
    {
        //echo view('templates/header', $data);
        //echo view('templates/sidebar', $data);
        echo view($viewName, $data);
       // echo view('templates/footer', $data);
    }

    public function index()
    {
        $data['feestructures'] = $this->feestructureModel->findAllActivefeesstructure();
		$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feeheadmodel'] = $this->feesheadModel;
		$data['feesdetails'] = $this->feestructuredetailsModel;
		$data['courses'] = $this->coursesModel->findAllActiveCourses();
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		//print_r($data); die();
        $this->loadCommonViews('Feestructure/index', $data);
    }

    public function create()
    {
        
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feeheadmodel'] = $this->feesheadModel;
		$data['courses'] = $this->coursesModel->findAllActiveCourses();
		//$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		//$data['academics'] = $this->academicyearModel->GetData();
		//$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		//$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feesdetails'] = $this->feestructuredetailsModel;
		$data['heads'] = $this->feesheadModel->getAllheads();
		//$data['courses'] = $this->coursesModel->findAllActiveCourses();
		$data['semesters']=$this->semesterModel->findAllActiveSemester();
        $this->loadCommonViews('Feestructure/create', $data);
    }

    public function store()
    {
        $feestructureModel = $this->feestructureModel;
		$feestructuredetailsModel = $this->feestructuredetailsModel;
		$feestructureitemModel = $this->feestructureitemModel;
        $validationRules = $feestructureModel->getValidationRules();
      
    
        
        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
			
			
            // Save caste data
            $feestructureModel->save([
                'academic_year_id' => $this->request->getPost('academic_year_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
			    'course_id' => $this->request->getPost('course_id'),
            ]);
			
			
			 $terms_fee = $this->request->getPost('terms_fee'); //Get AddMore Fields From View
             $terms_id = $this->request->getPost('term_id');
			 
			  
			   
			   foreach ($terms_fee['grand_result1'] as $key => $grand_result1) {
				   
                            $fee_data = array("stucture_id" => $feestructureModel->getInsertID(),
                            "total_grand_value" => $terms_fee['grandtotal_total'][$key],
                            );

                            for($i=0;$i<count($terms_id); $i++)

                            {

                                //$date = "t".($i+1)."_date";

                                $grand_terms =  "grand_term".($i+1)."_result";

                                $grand_results = "grand_result".($i+1);

                               //$fee_data[$date] = $terms_fee[$date];

                               $fee_data [$grand_terms] = $terms_fee[$grand_results][$key];

                            }
           
                           if(!$feestructureitemModel->insertVal($fee_data)){
                           echo "Data not insert into fee Structure table";die; 
                        
                            }

                        }
						
				$feestructuredetailsModel->DeleteRecord($feestructureModel->getInsertID());
			    $terms = $this->request->getPost('terms');
				$datacategorys = $this->feescategoryModel->findAllActivefeesCategory();
			//  echo "<pre>"; print_r($terms); die();
			
			for ($i = 0; $i < count($datacategorys); $i++) {
				
				 $terms_data['fee_structure_id'] = $feestructureModel->getInsertID();
                 $terms_data['fee_category_id'] = $terms['category_id'][$i];
                 $fee_heads = $this->feesheadModel->gethead($datacategorys[$i]['fee_category_id']);
				
			for ($j = 0; $j < count($fee_heads); $j++) {
			
             for ($k = 1; $k <= count($terms_id); $k++) {
				//$heads=$this->request->getPost('fee_head_id'); 
				//$amt=$this->request->getPost('amount'); 
				
				$terms_data['term_id'] = $terms_id[$k-1];
				$terms_data['fee_head_id'] = $fee_heads[$j]['fee_head_id'];
				$terms_data['fee_head_total'] = empty($terms['feeheads_total_val' . $terms['category_id'][$i] . ''][$j])?0:$terms['feeheads_total_val' . $terms['category_id'][$i] . ''][$j];
				$terms_data['amount'] = empty($_POST['amount_' . $datacategorys[$i]['fee_category_id'] . '_' . $fee_heads[$j]['fee_head_id'] . '_' . $k . ''])?0:$_POST['amount_' . $datacategorys[$i]['fee_category_id'] . '_' . $fee_heads[$j]['fee_head_id'] . '_' . $k . ''];
                $terms_data['total_cat_value'] = empty($terms['cat_row_total' . $terms['category_id'][$i] . '_' . $i . ''])?0:$terms['cat_row_total' . $terms['category_id'][$i] . '_' . $i . ''];
                $terms_data['college_id'] =  $this->request->getPost('college_id');
				$terms_data['caste_category_id'] =  $this->request->getPost('caste_category_id');
				$terms_data['status'] =  $this->request->getPost('status');
				//$data= ['college_id']
			   // 'fee_structure_id' =>$id,
				///'amount'=>$amt[$i],
				//'fee_head_id'=>$heads[$i],
				//'status'=>$this->request->getPost('status'),
			//	'college_id'=>$this->request->getPost('college_id'),
			//	'caste_category_id' => $this->request->getPost('caste_category_id'),
			//	'term_id' => $this->request->getPost('term_id'),
			//	'fee_head_total' => $this->request->getPost('feeheads_total_val4'),
			//	'total_cat_value' => $this->request->getPost('cat_row_total4_0'),
             // ];
				  //print_r($data); die();
				// echo "<pre>" ; print_r($terms_data); die();
				 
				$insert= $feestructuredetailsModel->insert($terms_data);
			}
			}
			}
			

            return redirect()->to('/feestructure')->with('success', 'Fee Structure added successfully');
        }
          
       
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['courses'] = $this->coursesModel->findAllActiveCourses();
		 $this->loadCommonViews('Feestructure/create', $data);
    }

    public function edit($id)
    {
        $data['feesstructures'] = $this->feestructureModel->find($id);
      
        if (!$data['feesstructures']) {
            return redirect()->to('/feestructure')->with('error', 'Fees Structure not found');
        }

        $data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		$data['feesdetails'] = $this->feestructuredetailsModel;
		$data['heads'] = $this->feesheadModel->getAllheads();
		$data['courses'] = $this->coursesModel->findAllActiveCourses();
		$data['semesters']=$this->semesterModel;
		//$data['feestructureItem']=$this->feestructureitemMode;
		$data['feestructureItem'] = $this->feestructureitemModel->getStructureRecords($id);
		$feestructureitemModel = $this->feestructureitemModel;
        $this->loadCommonViews('Feestructure/edit', $data);
    }

    public function update($id)
    {
		$feestructuredetailsModel = $this->feestructuredetailsModel;
		$feestructureitemModel = $this->feestructureitemModel;
        $feesstructure = $this->feestructureModel->find($id);
		

        if (!$feesstructure) {
            return redirect()->to('/feestructure')->with('error', 'fees Structure not found');
        }

        $validationRules = $this->feestructureModel->getValidationRules();
		
		

        if ($this->request->getMethod() === 'post' && $this->validate($validationRules)) {
            // Update caste data
			$terms_fee = $this->request->getPost('terms_fee');
			
			$terms_id=$this->request->getPost('term_id');
            $this->feestructureModel->update($id, [
               'academic_year_id' => $this->request->getPost('academic_year_id'),
				'caste_category_id' => $this->request->getPost('caste_category_id'),
				'college_id' => $this->request->getPost('college_id'),
                'status' => $this->request->getPost('status'),
				'course_id' => $this->request->getPost('course_id'),
				
            ]);
			  $feestructureitemModel->DeleteRecord($id);
			  foreach ($terms_fee['grand_result1'] as $key => $grand_result1) {
			//$fee_data = array("structure_id" => $id,
                   //  "total_grand_value" => $terms_fee['grandtotal_total'][$key],
                      //      );
					  
					  $fee_data = [
					  'stucture_id' => $id,
					  'total_grand_value' => $terms_fee['grandtotal_total'][$key]
					  ];
			        for($i=0;$i<count($terms_id); $i++){
                        
                        $grand_terms =  "grand_term".($i+1)."_result";
                        $grand_results = "grand_result".($i+1);
//                        $fee_data[$date] = $terms_fee[$date];
                        $fee_data [$grand_terms] = $terms_fee[$grand_results][$key];
                    }
                  
                    if(!$feestructureitemModel->insertVal($fee_data)){
                        echo "Data not insert into fee Structure table";die; 
                        
                    }
                     // $feestructureitemModel->delete(array('stucture_id =?' =>  $id));
				  // print_r($this->feestructureitemModel); die();
//                    $feestructureitemModel->save($fee_data);
					//if($feestructureitemModel->save($fee_data)){
					//return true;
					//		}else{
					//print_r($feestructureitemModel->error());
					//return false;
					//	} 
			  }
			
			 $feestructuredetailsModel->DeleteRecord($id);
			 
			 $terms = $this->request->getPost('terms');
			
			
			$datacategorys = $this->feescategoryModel->findAllActivefeesCategory();
			//echo "<pre>" ; print_r($terms); die();
			for ($i = 0; $i < count($datacategorys); $i++) {
				
				 $terms_data['fee_structure_id'] = $id;
                 $terms_data['fee_category_id'] = $terms['category_id'][$i];
                $fee_heads = $this->feesheadModel->gethead($datacategorys[$i]['fee_category_id']);
				
			for ($j = 0; $j < count($fee_heads); $j++) {
			
             for ($k = 1; $k <= count($terms_id); $k++) {
				//$heads=$this->request->getPost('fee_head_id'); 
				//$amt=$this->request->getPost('amount'); 
				
				$terms_data['term_id'] = $terms_id[$k-1];
				$terms_data['fee_head_id'] = $fee_heads[$j]['fee_head_id'];
				$terms_data['fee_head_total'] = empty($terms['feeheads_total_val' . $terms['category_id'][$i] . ''][$j])?0:$terms['feeheads_total_val' . $terms['category_id'][$i] . ''][$j];
				$terms_data['amount'] = empty($_POST['amount_' . $datacategorys[$i]['fee_category_id'] . '_' . $fee_heads[$j]['fee_head_id'] . '_' . $k . ''])?0:$_POST['amount_' . $datacategorys[$i]['fee_category_id'] . '_' . $fee_heads[$j]['fee_head_id'] . '_' . $k . ''];
                $terms_data['total_cat_value'] = empty($terms['cat_row_total' . $terms['category_id'][$i] . '_' . $i . ''])?0:$terms['cat_row_total' . $terms['category_id'][$i] . '_' . $i . ''];
                $terms_data['college_id'] =  $this->request->getPost('college_id');
				$terms_data['caste_category_id'] =  $this->request->getPost('caste_category_id');
				$terms_data['status'] =  $this->request->getPost('status');
				//$data= ['college_id']
			   // 'fee_structure_id' =>$id,
				///'amount'=>$amt[$i],
				//'fee_head_id'=>$heads[$i],
				//'status'=>$this->request->getPost('status'),
			//	'college_id'=>$this->request->getPost('college_id'),
			//	'caste_category_id' => $this->request->getPost('caste_category_id'),
			//	'term_id' => $this->request->getPost('term_id'),
			//	'fee_head_total' => $this->request->getPost('feeheads_total_val4'),
			//	'total_cat_value' => $this->request->getPost('cat_row_total4_0'),
             // ];
				  //print_r($data); die();
				// echo "<pre>" ; print_r($terms_data); die();
				 
				$insert= $feestructuredetailsModel->insert($terms_data);
			}
			}
			}
		   
		   
            return redirect()->to('/feestructure')->with('success', 'Fees Structure updated successfully');
        }

        $data['feesstructures'] = $feesstructure;
      
		$data['colleges'] = $this->collegeModel->findAllActiveColleges();
		$data['academics'] = $this->academicyearModel->GetData();
		$data['castcategorys'] = $this->castategoryModel->findAllActiveCategories();
		$data['courses'] = $this->coursesModel->findAllActiveCourses();
        $this->loadCommonViews('Feestructure/edit', $data);
    }

    public function delete($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course) {
            return redirect()->to('/feestructure')->with('error', 'Course not found');
        }

        $this->courseModel->delete($id);
        return redirect()->to('/feestructure')->with('success', 'Course deleted successfully');
    }
	
	
 public function ajaxGetFeeDetailsView() {
	 
	 
         $feestructuredetailsModel = $this->feestructuredetailsModel;
		$feestructureitemModel = $this->feestructureitemModel;
		$feestructure= $this->feestructureModel;
		$semester= $this->semesterModel;
		$this->feestructureitemModel;

         if ($this->request->isAJAX()) {
        $id= $this->request->getPost('id');

          $result=  $feestructuredetailsModel->getItemRecords($id);
          $result1 = $feestructureitemModel->getStructureRecords($id);
          $academic_year_id  = $feestructure->getAcademicId($id);
		  $terms_data = $semester->GetDataByAcademic($academic_year_id['academic_year_id']);
		  $data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		  $data['heads'] = $this->feesheadModel->getAllheads();
          $data['result']=$result;
		  $data['result1']=$result1;
		  $data['academic']=$academic_year_id;
		  $data['term_data']=$terms_data;
		  $data['feestructures']=$this->feestructuredetailsModel;
		  $data['structures_id']=$id;
          $this->loadCommonViews1('Feestructure/ajaxGetFeeDetailsView', $data);
       

    }
 }
 
 
 public function getdatacollegewise() {
	 
	 
         $feestructuredetailsModel = $this->feestructuredetailsModel;
		$feestructureitemModel = $this->feestructureitemModel;
		$feestructure= $this->feestructureModel;
		$semester= $this->semesterModel;
		$this->feestructureitemModel;

         if ($this->request->isAJAX()) {
          $college= $this->request->getPost('college');
          $acad= $this->request->getPost('acad');
		   
          //$result=  $feestructuredetailsModel->getItemRecords($id);
         // $result1 = $feestructureitemModel->getStructureRecords($id);
          $data['feestructures']  = $feestructure->getStructureRecords($college,$acad);
		  ///$terms_data = $semester->GetDataByAcademic($academic_year_id['academic_year_id']);
		  //$data['feescategorys'] = $this->feescategoryModel->findAllActivefeesCategory();
		 // $data['heads'] = $this->feesheadModel->getAllheads();
         // $data['result']=$result;
		 // $data['result1']=$result1;
		 // $data['academic']=$academic_year_id;
		 // $data['term_data']=$terms_data;
		 // $data['feestructures']=$this->feestructuredetailsModel;
		 // $data['structures_id']=$id;
          $this->loadCommonViews1('Feestructure/getdatacollegewise', $data);
       

    }
 }
	
	
}
