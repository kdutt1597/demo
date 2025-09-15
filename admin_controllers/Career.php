<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\module\CareerModel;
use App\Models\module\CareerEnquiryModel;
use App\Models\coreModule\SettingModel;


class Career extends BaseController
{
   
    public function __construct()
	{

	    $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}



   public function careers()
    {
        $model = new CareerModel();
        $data['page_title'] ='All Careers';
         // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end
        echo view('admin/module/careers',$data);
    }


    function add_career($id=false)
     {
      error_reporting(0);
    	
        $model = new CareerModel();
        if(!empty($id)) {
        
        $data['page_title'] = ' Edit Career';
        $data['form_action'] ='admin/add_career/'.$id;
        $row = $model->asObject()->find($id);
        
        $data['title'] =  $row->title;  
        $data['location'] =  $row->location;  
        $data['description'] = $row->description;
        $data['status'] = $row->status; 
        $data['salary'] = $row->salary; 
        $data['experience'] = $row->experience; 
        $data['jobType'] = $row->jobType; 
        $data['sort_order'] = $row->sort_order; 
        $data['image'] = $row->image; 
        $data['slug'] = $row->slug; 
        $data['metaTitle'] = $row->metaTitle; 
        $data['metaKeyword'] = $row->metaKeyword; 
        $data['metaDescription'] = $row->metaDescription; 

        $data['responsibility'] = $row->responsibility; 
        $data['jobFunction'] = $row->jobFunction; 
        $data['role'] = $row->role; 
        $data['desireSkill'] = $row->desireSkill; 
        $data['skill'] = $row->skill; 
        $data['grade'] = $row->grade; 
        $data['qualification'] = $row->qualification; 
  $data['link'] = $row->link; 

                     
        }else{

        $data['page_title'] = ' Add Career';
        $data['form_action'] ='admin/add_career';
        $data['title'] = '';    
        $data['location'] = ''; 
        $data['image'] = ''; 
        $data['description'] = ''; 
        $data['status'] = '';
        $data['image'] = '';
        $data['sort_order'] = ''; 
        $data['slug'] = '';
        $data['metaTitle'] = ''; 
        $data['metaKeyword'] = ''; 
        $data['metaDescription'] = ''; 
        $data['salary'] = ''; 
        $data['experience'] = ''; 
        $data['jobType'] = ''; 
         $data['link'] = ''; 

        $data['responsibility'] = ''; 
        $data['jobFunction'] =''; 
        $data['role'] = '';
        $data['desireSkill'] = ''; 
        $data['skill'] = '';
        $data['grade'] = '';
        $data['qualification'] = '';

        }
        
        if($this->request->getMethod()=='post'){
            
            $rules = [
                'title'=>'required'
            ];
        
         if ($this->validate($rules)==false) {
                $data['validation'] = $this->validator;
          } else{
          $save= array();
          $save['title'] =     $this->request->getVar('title');
          $save['location'] =     $this->request->getVar('location');
          $save['description'] =     $this->request->getVar('description');
          $save['status'] =     $this->request->getVar('status');
          $save['sort_order'] =     $this->request->getVar('sort_order');
      		$save['salary'] =     $this->request->getVar('salary');
      		$save['experience'] =     $this->request->getVar('experience');
      	
        	$save['jobType'] =     $this->request->getVar('jobType');
          $save['responsibility'] =     $this->request->getVar('responsibility');
          $save['jobFunction'] =     $this->request->getVar('jobFunction');
          $save['role'] =     $this->request->getVar('role');
          $save['desireSkill'] =     $this->request->getVar('desireSkill');
          $save['skill'] =     $this->request->getVar('skill');
          $save['grade'] =     $this->request->getVar('grade');
          $save['qualification'] =     $this->request->getVar('qualification');
          $save['link'] =     $this->request->getVar('link');



          if($this->request->getVar('slug')){
            $save['slug'] =     sfu($this->request->getVar('slug'));  
          }else{
            $save['slug'] =     sfu($this->request->getVar('title'));
          }
         
          $save['metaTitle'] =     $this->request->getVar('metaTitle');
          $save['metaKeyword'] =     $this->request->getVar('metaKeyword');
          $save['metaDescription'] =     $this->request->getVar('metaDescription');
                                
           if(!empty($_FILES['image']['name'])){
      			$file = $this->request->getFile('image');
      			if($file->isValid() && !$file->hasMoved()){
      				$file_name = $file->getRandomName();
      				if($file->move('uploads/images/', $file_name)){
      					$save['image'] =  'uploads/images/'.$file_name;
      				}
      			}else{
      				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      				exit;
      			}
      		}
           

     
          if ($id) {
            
              $save['modify_date'] = date('Y-m-d H:i:s');
             $result = $model->update(array('id'=>$id),$save);
              if ($result) {
              $this->session->setFlashdata('success','Record Update successfully');
              return redirect()->to('admin/add_career/'.$id);
              }else{
              $this->session->setFlashdata('error','Record not update');
              return redirect()->to('admin/add_career/'.$id);
              }
          }else{
             $save['jobId'] = rand(111111,999999);
             $save['create_date'] = date('Y-m-d H:i:s');
             $save['modify_date'] = date('Y-m-d H:i:s');
             $result=  $model->insert($save);
              if ($result) {
             
              $this->session->setFlashdata('success','Record insert successfully');
              return redirect()->to('admin/careers');
              }else{
              $this->session->setFlashdata('error','Record not insert');
              return redirect()->to('admin/add_career');
              }
    
            }
    
          }
        }
        return view('admin/module/add_career',$data);
    
    }
    
    function delete_careers(){
        $model = new CareerModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete($value);
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/careers');
    }


//////////////////////////

 public function career_enquiry()
    {
       $model = new CareerEnquiryModel();
       $careerModel = new CareerModel();

        $data['page_title'] ='All Careers Enquiry';


        // pagination
        $data['perPage'] = 10;
        $data['detail'] = $model->asObject()->select('ce.*,cr.title as career_name')->join('careers cr','ce.job_id=cr.id')->orderBy('ce.id','desc')->paginate($data['perPage']);


        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        $data['total'] = $model->countAllResults();

        $data['data'] = $model->paginate($data['perPage']);
        $data['pager'] = $model->pager;

        $data['pages'] = floor($data['total']/$data['perPage']);
        $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
         // end

        echo view('admin/module/career_enquiry',$data);
    }
    
    
    
    function delete_career_enquiry(){
       $model = new CareerEnquiryModel();
      if ($this->request->getVar()) {
          $id = $this->request->getVar('selected');
         if ($id) {
             
            foreach($id as $value){
                $model->delete(array('id'=>$value));
               }
           $this->session->setFlashdata('success','Record Delete successfully');
         }else{
          $this->session->setFlashdata('error','');
         }
         
        }
         
      return redirect()->to('admin/career_enquiry');
    }


}
