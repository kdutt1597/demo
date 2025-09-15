<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\coreModule\SettingModel;
use App\Models\Cms\CmsModel;
use App\Models\Cms\CollectionModel;
use App\Models\Cms\IndustryModel;
use App\Models\Cms\GalleryCategoryModel;
use App\Models\Cms\GalleryModel;
use App\Models\Cms\InfrastructureModel;
use App\Models\Cms\AddressModel;
use App\Models\Cms\ParterTagModel;
use App\Models\Cms\CsrModel;
use App\Models\Cms\EventCategoryModel;
use App\Models\Cms\EventsModel;



class Cms extends BaseController
{
    
    public function __construct()
	{

	    $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}


function home_heading(){

	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Home Heading';
	  $data['detail'] = $this->AdminModel->all_fetch('home_heading',null);
	  echo view('admin/cms/home_heading',$data);
	}
	  
	 
	
	function add_home_heading($id=false)
	 {
	 	
		$model = new CmsModel();
		
	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_home_heading/'.$id;
		$row = $this->AdminModel->fs('home_heading',array('id'=>$id));
	
		$data['title'] =  $row->title; 
		$data['description'] = $row->description; 
		$data['solutionTitle'] = $row->solutionTitle; 
		$data['image'] =  $row->image;  
	    $data['solutionDescription'] =  $row->solutionDescription;  
	    $data['keyTitle'] =  $row->keyTitle;
		$data['whyTitle'] =  $row->whyTitle;
		$data['customerTitle'] = $row->customerTitle;  
		$data['cultureDescription'] = $row->cultureDescription;
		$data['partnerTitle'] =  $row->partnerTitle;
		$data['successTitle'] =  $row->successTitle;
		$data['successDescription'] =  $row->successDescription;
		$data['successImage'] =  $row->successImage;
		$data['blogTitle'] =  $row->blogTitle;
		$data['serTitle'] =  $row->serTitle;
		$data['serDescription'] =  $row->serDescription;
		$data['serimage'] =  $row->serimage;
		
		$data['btn_link'] =  $row->btn_link;
		$data['btn_name'] =  $row->btn_name;
	
		
		
		
		
		$data['featureList'] =  $this->AdminModel->all_fetch('home_feature',array('home_id'=>$row->id));


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_home_heading';

		$data['title'] = '';  
		$data['description'] = ''; 
		$data['solutionTitle'] = ''; 
		$data['image'] = '';  
	   $data['solutionDescription'] = '';   

	    $data['keyTitle'] = ''; 
		$data['whyTitle'] = '';  
	
		$data['customerTitle'] = '';  
		$data['cultureDescription'] = ''; 
	
		$data['partnerTitle'] = '';  
		$data['successTitle'] = '';  
		$data['successDescription'] = '';  
		$data['successImage'] = ''; 
		$data['blogTitle'] = ''; 
			$data['serTitle'] =  ''; 
		$data['serDescription'] =  ''; 
		$data['serimage'] =  ''; 
			$data['btn_link'] = ''; 
		$data['btn_name'] =  ''; 
	
	
        $data['featureList'] =  array();


		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'title'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{
			
		 $save= array();
		

		$save['info']['title'] =   $this->request->getVar('title');

		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['partnerTitle'] =  $this->request->getVar('partnerTitle');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['solutionTitle'] =  $this->request->getVar('solutionTitle');
		$save['info']['solutionDescription'] =   $this->request->getVar('solutionDescription');
		$save['info']['productDescription'] =   $this->request->getVar('productDescription');
		$save['info']['cultureDescription'] =   $this->request->getVar('cultureDescription');
		$save['info']['keyTitle'] =  $this->request->getVar('keyTitle');
		$save['info']['whyTitle'] =  $this->request->getVar('whyTitle');
		$save['info']['customerTitle'] =   $this->request->getVar('customerTitle');
     	$save['info']['newsTitle'] = $this->request->getVar('newsTitle');
		$save['info']['successTitle'] =  $this->request->getVar('successTitle');
	 $save['info']['successDescription'] =  $this->request->getVar('successDescription');
	 $save['info']['blogTitle'] =  $this->request->getVar('blogTitle');
	
    $save['info']['btn_link'] =  $this->request->getVar('btn_link');
	$save['info']['btn_name'] =  $this->request->getVar('btn_name');
	
  

   $save['info']['serTitle'] =  $this->request->getVar('serTitle');
	 $save['info']['serDescription'] =  $this->request->getVar('serDescription');

  


  
  		  $file = $this->request->getFile('serimage');
		  if(!empty($_FILES['serimage']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['serimage'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
  
	
		


		// why us
	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('featureImage')) {
			foreach($this->request->getFileMultiple('featureImage') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImage'] = $featureImagesData;
	   $save['old_feature_image'] = $this->request->getVar('old_feature_image');

		$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureValue'] = $this->request->getVar('featureValue');
// 		$save['featureSymbol'] = $this->request->getVar('featureSymbol');


        $featureImagesData2 = array();
    		  if ($this->request->getFileMultiple('featureImage2')) {
    			foreach($this->request->getFileMultiple('featureImage2') as $key => $file)
    		   {  
    			   if($file->isValid() && !$file->hasMoved()){
    			   $file_name = $file->getRandomName();
    			   if($file->move('uploads/product/', $file_name)){
    				   $featureImagesData2[$key] = 'uploads/product/'.$file_name;
    			   }	 
    			 }
    		   }
    	     }
                    
           $save['featureImage2'] = $featureImagesData2;
    	   $save['old_feature_image2'] = $this->request->getVar('old_feature_image2');


	
		  $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
		 	  $file = $this->request->getFile('successImage');
		  if(!empty($_FILES['successImage']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['successImage'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

   
		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_home_heading($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_home_heading/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_home_heading/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_home_heading($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/home_heading');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_home_heading');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_home_heading',$data);

	}
	

	function delete_home_heading(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('home_heading',array('id'=>$value));
				$this->AdminModel->deleteData('home_feature',array('home_id'=>$value));
				$this->AdminModel->deleteData('home_gallery',array('home_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/home_heading');
	}

////////////////////////////



function about_heading(){
	
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'About Heading';
	  $data['detail'] = $this->AdminModel->all_fetch('about_heading',null);
	  echo view('admin/cms/about_heading',$data);
	}
	  
	 
	
	function add_about_heading($id=false)
	 {
	 		
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_about_heading/'.$id;
		$row = $this->AdminModel->fs('about_heading',array('id'=>$id));
	
		$data['title'] =  $row->title; 
		$data['description'] =  $row->description;    
		$data['description2'] =  $row->description2;   
		$data['image'] = $row->image; 
		$data['wtitle'] = $row->wtitle; 
		$data['wdescription'] = $row->wdescription;  
		$data['mTitle'] = $row->mTitle;
		$data['jfTitle'] = $row->jfTitle;
		$data['jfDescription'] = $row->jfDescription;
	
// 		$data['jtitle'] = $row->jtitle;
		$data['jDescription2'] = $row->jDescription2;
	
		$data['image1'] = $row->image1;
		$data['patentTitle'] = $row->patentTitle;
		$data['patentDescription'] = $row->patentDescription;

		$data['companyTitle'] = $row->companyTitle;
		$data['companyDescription'] = $row->companyDescription;
		$data['image2'] = $row->image2;
		$data['letTitle'] = $row->letTitle;
		$data['letDescription'] = $row->letDescription;
		
		
		$data['visionList'] =  $this->AdminModel->all_fetch('visions',array('home_id'=>$row->id));
		$data['whyusList'] =  $this->AdminModel->all_fetch('whyus',array('home_id'=>$row->id));
	


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_about_heading';

		$data['title'] =   '';
		$data['description'] =   '';    
		$data['description2'] =   '';     
		$data['image'] =   ''; 
		$data['wtitle'] =   '';  
		$data['wdescription'] =   '';  
		$data['mTitle'] =   '';
		$data['jfTitle'] =   '';
		$data['jfDescription'] =   ''; 
				$data['jtitle'] =   '';
		$data['jDescription2'] =   ''; 
       $data['image1'] = ''; 
		$data['patentTitle'] = ''; 
		$data['patentDescription'] = ''; 

		$data['companyTitle'] =''; 
		$data['companyDescription'] = ''; 
		$data['image2'] = ''; 
		$data['letTitle'] = ''; 
		$data['letDescription'] = ''; 
		
		
		$data['visionList'] =  array();
		$data['whyusList'] =  array();
	


		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'description'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{

		
		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['description2'] =   $this->request->getVar('description2');
		$save['info']['wtitle'] =  $this->request->getVar('wtitle');
		$save['info']['wdescription'] =   $this->request->getVar('wdescription');
		$save['info']['mTitle'] =  $this->request->getVar('mTitle');
		$save['info']['jfTitle'] =   $this->request->getVar('jfTitle');
		$save['info']['jfDescription'] =   $this->request->getVar('jfDescription');
		
		  //$save['info']['jtitle'] =   $this->request->getVar('jtitle');
        $save['info']['jDescription2'] =   $this->request->getVar('jDescription2');

		 $save['info']['patentTitle'] =   $this->request->getVar('patentTitle');
		 $save['info']['patentDescription'] =   $this->request->getVar('patentDescription');
		 $save['info']['companyTitle'] =   $this->request->getVar('companyTitle');
		 $save['info']['companyDescription'] =   $this->request->getVar('companyDescription');
		 $save['info']['letTitle'] =   $this->request->getVar('letTitle');
		 $save['info']['letDescription'] =   $this->request->getVar('letDescription');


        $file = $this->request->getFile('image1');
		  if(!empty($_FILES['image1']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image1'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

        $file = $this->request->getFile('image2');
		  if(!empty($_FILES['image2']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image2'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }



        $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }



		 // mision
		$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureDescription'] = $this->request->getVar('featureDescription');
		$save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


		// why us
	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('whyimage')) {
			foreach($this->request->getFileMultiple('whyimage') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImages'] = $featureImagesData;
	   $save['old_why_image'] = $this->request->getVar('old_why_image');

     	$save['whyTitle'] =  $this->request->getVar('whyTitle');
		$save['whyDescription'] = $this->request->getVar('whyDescription');
		$save['whySortOrder'] = $this->request->getVar('whySortOrder');



		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_about_heading($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_about_heading/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_about_heading/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_about_heading($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/about_heading');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_about_heading');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_about_heading',$data);

	}
	

	function delete_about_heading(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('about_heading',array('id'=>$value));
				$this->AdminModel->deleteData('whyus',array('home_id'=>$value));
				$this->AdminModel->deleteData('visions',array('home_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/about_heading');
	}

///////////////////////////////




function service_heading(){
	
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Life @ Proactive';
	  $data['detail'] = $this->AdminModel->all_fetch('service_heading',null);
	  echo view('admin/cms/service_heading',$data);
	}
	  
	 
	
	function add_service_heading($id=false)
	 {
	 		
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_service_heading/'.$id;
		$row = $this->AdminModel->fs('service_heading',array('id'=>$id));
	
		$data['description'] =  $row->description; 
		$data['title'] =  $row->title;    
		$data['image'] =  $row->image;   
		$data['image2'] = $row->image2; 
		$data['image3'] = $row->image3; 
		$data['ctitle'] = $row->ctitle;  
		$data['cdescription'] = $row->cdescription;
		$data['otitle'] =  $row->otitle;
		$data['odescription'] =  $row->odescription;
		$data['etitle'] =  $row->etitle;
		$data['edescription'] =  $row->edescription;
		
		$data['opentingTitle'] =  $row->opentingTitle;
		$data['fitTitle'] =  $row->fitTitle;
		$data['fitDescription'] =  $row->fitDescription;

				

		
		$data['featureList'] =  $this->AdminModel->all_fetch('area_feature',array('heading_id'=>$row->id));
		$data['areaList'] =  $this->AdminModel->all_fetch('service_area',array('heading_id'=>$row->id));


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_service_heading';

		$data['description'] = '';   
		$data['title'] = '';  
		$data['image'] = '';   
		$data['image2'] = ''; 
		$data['image3'] = ''; 
		$data['ctitle'] = '';   
		$data['cdescription'] = ''; 
		$data['otitle'] = '';  
		$data['odescription'] = '';  
		$data['etitle'] = '';  
		$data['edescription'] = ''; 
 		$data['opentingTitle'] =  ''; 
		$data['fitTitle'] =  ''; 
		$data['fitDescription'] =  ''; 


        $data['featureList'] =  array();
        $data['areaList'] =     array();

		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'title'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{
			
		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['ctitle'] =  $this->request->getVar('ctitle');
		$save['info']['cdescription'] =   $this->request->getVar('cdescription');
		$save['info']['otitle'] =  $this->request->getVar('otitle');
		$save['info']['odescription'] =   $this->request->getVar('odescription');
		$save['info']['etitle'] =   $this->request->getVar('etitle');

		$save['info']['opentingTitle'] =   $this->request->getVar('opentingTitle');
		$save['info']['fitTitle'] =   $this->request->getVar('fitTitle');
		$save['info']['fitDescription'] =   $this->request->getVar('fitDescription');



	
		 $file = $this->request->getFile('edescription');
		  if(!empty($_FILES['edescription']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['edescription'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
		 
		  $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 	  $file = $this->request->getFile('image2');
		  if(!empty($_FILES['image2']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image2'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 	  $file = $this->request->getFile('image3');
		  if(!empty($_FILES['image3']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image3'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 // feature

	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('featureImages')) {
			foreach($this->request->getFileMultiple('featureImages') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImages'] = $featureImagesData;
	   $save['old_feature_image'] = $this->request->getVar('old_feature_image');
	   	$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


		// area


		$save['areaTitle'] = $this->request->getVar('areaTitle');
		$save['areaDescription'] = $this->request->getVar('areaDescription');
		$save['areaSortOrder'] = $this->request->getVar('areaSortOrder');


		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_service_heading($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_service_heading/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_service_heading/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_service_heading($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/service_heading');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_service_heading');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_service_heading',$data);

	}
	

	function delete_service_heading(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('service_heading',array('id'=>$value));
				$this->AdminModel->deleteData('area_feature',array('heading_id'=>$value));
				$this->AdminModel->deleteData('service_area',array('heading_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/service_heading');
	}

///////////////////////////////




function our_technology(){
	
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Our Technology';
	  $data['detail'] = $this->AdminModel->all_fetch('our_technology',null);
	  echo view('admin/cms/our_technology',$data);
	}
	  
	 
	
	function add_our_technology($id=false)
	 {
	 		
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_our_technology/'.$id;
		$row = $this->AdminModel->fs('our_technology',array('id'=>$id));
	
		$data['description'] =  $row->description; 
		$data['title'] =  $row->title;    
		$data['wiredDescription'] =  $row->wiredDescription;   
		$data['wirelessDescription'] = $row->wirelessDescription; 
		$data['atitle'] = $row->atitle; 
		$data['adescription'] = $row->adescription;  
		$data['wiredSecurityDescription'] = $row->wiredSecurityDescription;
		$data['wirelessSecurityDescription'] =  $row->wirelessSecurityDescription;

		$data['ctitle'] =  $row->ctitle;
		$data['cdescription'] =  $row->cdescription;
		$data['htitle'] =  $row->htitle;
		$data['link'] =  $row->link;
		
		
		$data['featureList'] =  $this->AdminModel->all_fetch('technology_feature',array('heading_id'=>$row->id));
		$data['conclusionList'] =  $this->AdminModel->all_fetch('technology_conclution',array('heading_id'=>$row->id));


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_our_technology';

		$data['description'] = '';  
		$data['title'] = '';  
		$data['wiredDescription'] = '';    
		$data['wirelessDescription'] = ''; 
		$data['atitle'] = ''; 
		$data['adescription'] = '';  
		$data['wiredSecurityDescription'] = ''; 
		$data['wirelessSecurityDescription'] = '';  

		$data['ctitle'] = '';  
		$data['cdescription'] = '';  
		$data['htitle'] = '';  
		$data['link'] = '';  

        $data['featureList'] =  array();
        $data['conclusionList'] =     array();

		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'description'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{
			
		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['wiredDescription'] =  $this->request->getVar('wiredDescription');
		$save['info']['wirelessDescription'] =   $this->request->getVar('wirelessDescription');
		$save['info']['atitle'] =   $this->request->getVar('atitle');
		$save['info']['adescription'] =   $this->request->getVar('adescription');
		$save['info']['htitle'] =   $this->request->getVar('htitle');
		$save['info']['link'] =   $this->request->getVar('link');
		$save['info']['ctitle'] =   $this->request->getVar('ctitle');
		$save['info']['cdescription'] =   $this->request->getVar('cdescription');
		$save['info']['wiredSecurityDescription'] =   $this->request->getVar('wiredSecurityDescription');
		$save['info']['wirelessSecurityDescription'] =   $this->request->getVar('wirelessSecurityDescription');
		




		$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureDescription'] = $this->request->getVar('featureDescription');
		$save['featureSortOrder'] = $this->request->getVar('featureSortOrder');

	

	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('featureImages')) {
			foreach($this->request->getFileMultiple('featureImages') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImages'] = $featureImagesData;
	   $save['old_feature_image'] = $this->request->getVar('old_feature_image');

		$save['conclusionTitle'] = $this->request->getVar('conclusionTitle');
		$save['wired'] = $this->request->getVar('wired');
	    $save['wireless'] = $this->request->getVar('wireless');


		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_technology($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_our_technology/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_our_technology/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_technology($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/our_technology');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_our_technology');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_our_technology',$data);

	}
	

	function delete_our_technology(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('our_technology',array('id'=>$value));
				$this->AdminModel->deleteData('technology_feature',array('heading_id'=>$value));
				$this->AdminModel->deleteData('technology_conclution',array('heading_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/our_technology');
	}

////////////////////////////////////////////////




  function collection(){

	$model = new CollectionModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Collection List';
	  $data['detail'] = $model->asObject()->findAll();

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


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/collection',$data);

}
  
 

function add_collection($id=false)
 {
 
 	$model = new CollectionModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit collection';
    $data['form_action'] ='admin/add_collection/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['city'] =  $row->city;   
    $data['state'] = $row->state;
    $data['address1'] = $row->address1;
    $data['address2'] = $row->address2;
	$data['address3'] = $row->address3;
	$data['partnerName'] = $row->partnerName; 
	$data['branchManagerName'] = $row->branchManagerName; 
	$data['contact'] = $row->contact; 
	$data['branchExits'] = $row->branchExits; 


         
    }else{
    
    $data['page_title'] = ' Add collection';
    $data['form_action'] ='admin/add_collection';
    $data['city'] =  '';    
    $data['state'] =  ''; 
    $data['address1'] =  ''; 
    $data['address2'] =  ''; 
	$data['address3'] =  ''; 
	$data['partnerName'] =  ''; 
	$data['branchManagerName'] =  ''; 
	$data['contact'] =  ''; 
	$data['branchExits'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'city' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		$save['city'] =     $this->request->getVar('city');
		$save['state'] =     $this->request->getVar('state');
		$save['address1'] =     $this->request->getVar('address1');
		$save['address2'] =     $this->request->getVar('address2');
		$save['address3'] =     $this->request->getVar('address3');
		$save['partnerName'] =     $this->request->getVar('partnerName');
		$save['branchManagerName'] =     $this->request->getVar('branchManagerName');
		$save['contact'] =     $this->request->getVar('contact');
		$save['branchExits'] =     $this->request->getVar('branchExits');


 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_collection/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_collection/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/collection');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_collection');
          }

      }

  }

  }
 echo view('admin/cms/add_collection',$data);

}

function delete_collection(){
	 $model = new CollectionModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/collection');
}

///////////////////////////////





  function gallery_category(){
 
	$model = new GalleryCategoryModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Gallery Category';
	  $data['detail'] = $model->asObject()->findAll();

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


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/gallery_category',$data);

}
  
 

function add_gallery_category($id=false)
 {
  
 	$model = new GalleryCategoryModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Gallery Category';
    $data['form_action'] ='admin/add_gallery_category/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['name'] =  $row->name;   
    $data['sortOrder'] = $row->sortOrder;
    $data['status'] = $row->status;


    }else{
    
    $data['page_title'] = ' Add Gallery Category';
    $data['form_action'] ='admin/add_gallery_category';
    $data['name'] =  '';    
    $data['sortOrder'] =  ''; 
    $data['status'] =  ''; 

      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		$save['name'] =     $this->request->getVar('name');
		$save['sortOrder'] =     $this->request->getVar('sortOrder');
		$save['status'] =     $this->request->getVar('status');
		

 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_gallery_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_gallery_category/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/gallery_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_gallery_category');
          }

      }

  }

  }
 echo view('admin/cms/add_gallery_category',$data);

}

function delete_gallery_category(){
	 $model = new GalleryCategoryModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/gallery_category');
}


////////////////


  function gallery(){
  
	$model = new GalleryModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 

	$categoryModel = new GalleryCategoryModel();
	$data['categoryList'] = $categoryModel->asObject()->where('status',1)->findAll();
	$catList = array();
	if (!empty($data['categoryList'])) {
		foreach ($data['categoryList'] as $key => $value) {
			$catList[$value->id]= $value->name;
		}
	}
	$data['catList'] = $catList;

	$data['page_title'] = 'All Gallery List';

	  
	   $like = array();
	   if(!empty($_GET['category'])){
	        $like['category_id'] = $_GET['category']; 
	    }


	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->like($like)->orderBy('id','desc')->paginate($data['perPage']);

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/gallery',$data);

}
  
 

function add_gallery($id=false)
 {
   
 	$model = new GalleryModel();
 	$categoryModel = new GalleryCategoryModel();
	$data['categoryList'] = $categoryModel->asObject()->where('status',1)->findAll();


  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Gallery';
    $data['form_action'] ='admin/add_gallery/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['category_id'] =  json_decode($row->category_id); 

    $data['image'] = $row->image;
    $data['status'] = $row->status;


    }else{
    
    $data['page_title'] = ' Add Gallery';
    $data['form_action'] ='admin/add_gallery';
    $data['category_id'] =  array();   
    $data['image'] =  ''; 
    $data['status'] =  ''; 

      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'category_id' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		$save['category_id'] =     json_encode($this->request->getVar('category_id'));
		$save['status'] =     $this->request->getVar('status');
		
	     $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_gallery/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_gallery/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/gallery');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_gallery');
          }

      }

  }

  }
 echo view('admin/cms/add_gallery',$data);

}

function delete_gallery(){
	 $model = new GalleryModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/gallery');
}

/////////////////



  function address(){
  	
		$model = new AddressModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 


	   $data['page_title'] = 'All Address List';

	  
	   $like = array();
	   if(!empty($_GET['category'])){
	        $like['category_id'] = $_GET['category']; 
	    }


	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->like($like)->orderBy('id','desc')->paginate($data['perPage']);

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/address',$data);

}
  
 

function add_address($id=false)
 {
   	
 	$model = new AddressModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Address';
    $data['form_action'] ='admin/add_address/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    $data['image'] = $row->image;
    $data['status'] = $row->status;
      $data['name'] = $row->name;
        $data['address'] = $row->address;
    $data['map'] = $row->map;
   $data['sortOrder'] = $row->sortOrder;
    $data['image'] = $row->image;
    }else{
    
    $data['page_title'] = ' Add Address';
    $data['form_action'] ='admin/add_address';
 
    $data['image'] =  ''; 
    $data['status'] =  ''; 
     $data['name'] =  ''; 
    $data['address'] =  ''; 
     $data['map'] =  ''; 
      $data['sortOrder'] =  ''; 
          $data['image'] =  ''; 

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		
		$save['status'] =     $this->request->getVar('status');
		$save['name'] =     $this->request->getVar('name');
		$save['address'] =     $this->request->getVar('address');
		$save['map'] =     $this->request->getVar('map');
	    $save['sortOrder'] =     $this->request->getVar('sortOrder');
			
	     $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_address/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_address/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/address');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_address');
          }

      }

  }

  }
 echo view('admin/cms/add_address',$data);

}

function delete_address(){
	 $model = new AddressModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/address');
}


//////////////////////////////



  function parter_tag(){
  
		$model = new ParterTagModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 


	   $data['page_title'] = 'All Parter Category List';

	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->orderBy('id','desc')->paginate($data['perPage']);

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/parter_tag',$data);

}
  
 

function add_parter_tag($id=false)
 {

 	$model = new ParterTagModel();
    $data['typeList'] = array('PARTNER'=>'PARTNER','CUSTOMER'=>'CUSTOMER'); 
 
  if(!empty($id)) {

    
    $data['page_title'] = ' Edit Category';
    $data['form_action'] ='admin/add_parter_tag/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    // $data['image'] = $row->image;
    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;
     $data['type'] = $row->type;
    }else{
    
    $data['page_title'] = ' Add Category';
    $data['form_action'] ='admin/add_parter_tag';
 
    $data['image'] =  ''; 
    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
    $data['type'] =  ''; 

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		
		$save['status'] =     $this->request->getVar('status');
		$save['name'] =     $this->request->getVar('name');
	    $save['sortOrder'] =     $this->request->getVar('sortOrder');
		$save['type'] =     $this->request->getVar('type');
			
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_parter_tag/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_parter_tag/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/parter_tag');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_parter_tag');
          }

      }

  }

  }
 echo view('admin/cms/add_parter_tag',$data);

}

function delete_parter_tag(){
	 $model = new ParterTagModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/parter_tag');
}
////////////////////////////




function sustainability(){
	error_reporting(0);
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Heading';
	  $data['detail'] = $this->AdminModel->all_fetch('sustainability',null);
	  echo view('admin/cms/sustainability',$data);

	}
	  
	 
	
	function add_sustainability($id=false)
	 {
	 		error_reporting(0);
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_sustainability/'.$id;
		$row = $this->AdminModel->fs('sustainability',array('id'=>$id));
	
		$data['title'] =  $row->title; 
		$data['description'] =  $row->description;    
		$data['image'] = $row->image; 
		$data['pillarTitle'] = $row->pillarTitle; 
		$data['pillarDescription'] = $row->pillarDescription;  
		$data['goalTitle'] = $row->goalTitle;
		$data['goalDescription'] = $row->goalDescription;
		$data['goalImage'] = $row->goalImage;
		$data['commitTitle'] = $row->commitTitle;
		$data['commitDescription'] = $row->commitDescription;
		$data['committedImage'] = $row->committedImage;
		$data['bottomImage'] = $row->bottomImage;

		
		
		$data['pillarList'] =  $this->AdminModel->all_fetch('sustainability_pillar',array('sustainability_id'=>$row->id));
		$data['commitList'] =  $this->AdminModel->all_fetch('sustainability_commit',array('sustainability_id'=>$row->id));
	


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_sustainability';

		$data['title'] =   '';
		$data['description'] =   '';        
		$data['image'] =   ''; 
		$data['pillarTitle'] =  ''; 
		$data['pillarDescription'] =  ''; 
		$data['goalTitle'] = ''; 
		$data['goalDescription'] =''; 
		$data['goalImage'] =''; 
		$data['commitTitle'] = ''; 
		$data['commitDescription'] = ''; 
		$data['committedImage'] = ''; 
		$data['bottomImage'] = ''; 

		
		$data['pillarList'] =  array();
		$data['commitList'] =  array();
	


		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'description'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{


		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['pillarTitle'] =   $this->request->getVar('pillarTitle');
		$save['info']['pillarDescription'] =  $this->request->getVar('pillarDescription');
		$save['info']['goalTitle'] =   $this->request->getVar('goalTitle');
		$save['info']['goalDescription'] =  $this->request->getVar('goalDescription');
		$save['info']['commitTitle'] =   $this->request->getVar('commitTitle');
		$save['info']['commitDescription'] =   $this->request->getVar('commitDescription');


        $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 $file = $this->request->getFile('bottomImage');
		  if(!empty($_FILES['bottomImage']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['bottomImage'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }


		// pillar
	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('featureImage')) {
			foreach($this->request->getFileMultiple('featureImage') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImages'] = $featureImagesData;
	   $save['old_feature_image'] = $this->request->getVar('old_feature_image');

     	$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureDescription'] = $this->request->getVar('featureDescription');
		$save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


		// commitment

       $commitImagesData = array();
		  if ($this->request->getFileMultiple('commitImage')) {
			foreach($this->request->getFileMultiple('commitImage') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $commitImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['commitImage'] = $commitImagesData;
	   $save['old_commit_image'] = $this->request->getVar('old_commit_image');
	   $save['commitSortOrder'] = $this->request->getVar('commitSortOrder');



		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_sustainability($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_sustainability/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_sustainability/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_sustainability($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/sustainability');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_sustainability');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_sustainability',$data);

	}
	

	function delete_sustainability(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('sustainability',array('id'=>$value));
				$this->AdminModel->deleteData('sustainability_commit',array('sustainability_id'=>$value));
				$this->AdminModel->deleteData('sustainability_pillar',array('sustainability_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/sustainability');
	}
////////////////////////////////////





  function csr(){
  error_reporting(0);
		$model = new CsrModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 


	   $data['page_title'] = 'All CSR';

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


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/csr',$data);

}
  
 

function add_csr($id=false)
 {
 	error_reporting(0);

 	$model = new CsrModel();
 	$data['typeList'] = array('RESPONSIBLE'=>'RESPONSIBLE','GOAL'=>'GOAL');
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit CSR';
    $data['form_action'] ='admin/add_csr/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    $data['image'] = $row->image;
    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;
  $data['type'] = $row->type;
 $data['description'] = $row->description;
$data['small'] = $row->small;

    }else{
    
    $data['page_title'] = ' Add CSR';
    $data['form_action'] ='admin/add_csr';
 
    $data['image'] =  ''; 
    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      $data['type'] =  '';
    $data['description'] =  '';
$data['small'] = '';

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		
		$save['status'] =     $this->request->getVar('status');
		$save['name'] =     $this->request->getVar('name');
	    $save['sortOrder'] =     $this->request->getVar('sortOrder');
	    $save['type'] =     $this->request->getVar('type');
	   $save['description'] =     $this->request->getVar('description');
 		   $save['small'] =     $this->request->getVar('small');


        $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }
 

      if ($id) {
          $save['id'] =  $id;

          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_csr/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_csr/'.$id);
          }
      }else{

         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/csr');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_csr');
          }

      }

  }

  }
 echo view('admin/cms/add_csr',$data);

}

function delete_csr(){
	 $model = new CsrModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/csr');
}
///////////////////////////




  function event_category(){
  error_reporting(0);
		$model = new EventCategoryModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 


	   $data['page_title'] = 'All Event Category';

	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->orderBy('id','desc')->paginate($data['perPage']);

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/event_category',$data);

}
  
 

function add_event_category($id=false)
 { error_reporting(0);

 	$model = new EventCategoryModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit event category';
    $data['form_action'] ='admin/add_event_category/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['sortOrder'] = $row->sortOrder;

    }else{
    
    $data['page_title'] = ' Add event category';
    $data['form_action'] ='admin/add_event_category';
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
    $data['sortOrder'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		
		$save['status'] =     $this->request->getVar('status');
		$save['name'] =     $this->request->getVar('name');
	    $save['sortOrder'] =     $this->request->getVar('sortOrder');
			
 
      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_event_category/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_event_category/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/event_category');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_event_category');
          }

      }

  }

  }
 echo view('admin/cms/add_event_category',$data);

}

function delete_event_category(){
	 $model = new EventCategoryModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/event_category');
}
//////////////////////////////



  function events(){

		$model = new EventsModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 


	   $data['page_title'] = 'All Events';

	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->select('events.*,ec.name as categoryName')->join('event_category ec','events.categoryId=ec.id','left')->orderBy('events.id','desc')->paginate($data['perPage']);

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/cms/events',$data);

}
  
 

function add_event($id=false)
 { error_reporting(0);

 	$model = new EventsModel();
    $EventCategoryModel = new EventCategoryModel();
 	$data['categoryList'] = $EventCategoryModel->asObject()->where('status',1)->findAll();
 	
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Event';
    $data['form_action'] ='admin/add_event/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    $data['status'] = $row->status;
    $data['name'] = $row->name;
    $data['image'] = $row->image;
    $data['categoryId'] = $row->categoryId;

    }else{
    
    $data['page_title'] = ' Add Event';
    $data['form_action'] ='admin/add_event';
        $data['category_id'] =  ''; 
 

    $data['status'] =  ''; 
    $data['name'] =  ''; 
       $data['image'] =  ''; 
    $data['categoryId'] =  ''; 
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'categoryId' =>'required',
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{

        $save= array();
		
		$save['status'] =     $this->request->getVar('status');
		$save['categoryId'] =     $this->request->getVar('categoryId');
	    $save['sortOrder'] =     $this->request->getVar('sortOrder');
	 
 

 
      if ($id) {
  
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_event/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_event/'.$id);
          }
      }else{

         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/events');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_event');
          }

      }

  }

  }
 echo view('admin/cms/add_event',$data);

}

function delete_events(){
	 $model = new EventsModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/events');
}

//////////////////////



public function financial_year()
	{
	   
	  $permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		   return  redirect()->to('admin/permission-denied');
		} 

	$data['page_title']         ='All financial years List';
	$data['details']		    = $this->AdminModel->all_fetch('financial_years',null);	
	$data['config_logo'] 		= $this->config_logo;
	return view('admin/cms/financial_years',$data); 

 	}


	
 public function add_financial_year($id=false)
	{			  


    if (!empty($id)) {
		$data['page_title']   ='Edit financial year';
		$data['form_action']  = 'admin/add_financial_year/'.$id;
		$row 			      = $this->AdminModel->fs('financial_years',array('id'=>$id));

		$data['name']         = $row->name;	
		$data['photo'] = @$row->photo;	
		$data['sortOrder'] = @$row->sortOrder;	
        $data['status'] = $row->status;

    }else{

	    $data['page_title']  ='Add financial year';	
	    $data['form_action'] = 'admin/add_financial_year';
	    $data['name']       = '';
	    $data['photo']       = '';
	    $data['status']         = '';
	    $data['sortOrder']         = '';
    }

    if ($this->request->getMethod()=='post') {
  
    $rules = [
		'name'=> ['label'=>'Name','rules'=>'required']
		
    ];
	
	if ($this->validate($rules)==false) {
	  $data['validation'] = $this->validator;
	}else{

	  $save= array();
      $save['sortOrder'] =     $this->request->getVar('sortOrder');
      $save['status'] =     $this->request->getVar('status');
      $save['name'] =     $this->request->getVar('name');
     
    	if(!empty($_FILES['photo']['name'])){
			$file = $this->request->getFile('photo');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['photo'] =  'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}


      if ($id) {
          $save['id'] =  $id;
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('financial_years',$save,array('id'=>$id));
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_financial_year/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_financial_year/'.$id);
          }
      }else{

         $save['created_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $this->AdminModel->insertData('financial_years',$save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/financial_year');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/financial_year');
          }

        }
	 
	  } 
     }
	return view('admin/cms/add_financial_year',$data);

 	}

 

function delete_financial_year(){

  if ($this->request->getVar('selected')) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$this->AdminModel->deleteData('financial_years',array('id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/financial_year');
}




//////////////////////




function cx_heading(){
	error_reporting(0);
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Heading';
	  $data['detail'] = $this->AdminModel->all_fetch('cx_heading',null);
	  echo view('admin/cms/cx_heading',$data);

	}
	  
	 
	
	function add_cx_heading($id=false)
	 {
	 		error_reporting(0);
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Heading';
		$data['form_action'] ='admin/add_cx_heading/'.$id;
		$row = $this->AdminModel->fs('cx_heading',array('id'=>$id));
	
		$data['title'] =  $row->title; 
		$data['description'] =  $row->description;    
		$data['image'] = $row->image; 
		$data['pillarTitle'] = $row->pillarTitle; 
		$data['pillarDescription'] = $row->pillarDescription;  
		$data['goalTitle'] = $row->goalTitle;
		$data['goalDescription'] = $row->goalDescription;
		$data['goalImage'] = $row->goalImage;
		$data['commitTitle'] = $row->commitTitle;
		$data['commitDescription'] = $row->commitDescription;
		$data['committedImage'] = $row->committedImage;
		$data['bottomImage'] = $row->bottomImage;

		
		$data['featureList'] =  $this->AdminModel->all_fetch('cx_feature',array('cx_id'=>$row->id));
		$data['faqList'] =  $this->AdminModel->all_fetch('cx_faq',array('cx_id'=>$row->id));
	


		}else{
		
		$data['page_title'] = ' Add Heading';
		$data['form_action'] ='admin/add_cx_heading';

		$data['title'] =   '';
		$data['description'] =   '';        
		$data['image'] =   ''; 
		$data['pillarTitle'] =  ''; 
		$data['pillarDescription'] =  ''; 
		$data['goalTitle'] = ''; 
		$data['goalDescription'] =''; 
		$data['goalImage'] =''; 
		$data['commitTitle'] = ''; 
		$data['commitDescription'] = ''; 
		$data['committedImage'] = ''; 
		$data['bottomImage'] = ''; 

		
		$data['featureList'] =  array();
		$data['faqList'] =  array();
	


		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'description'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{


		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['pillarTitle'] =   $this->request->getVar('pillarTitle');
		$save['info']['pillarDescription'] =  $this->request->getVar('pillarDescription');
		$save['info']['goalTitle'] =   $this->request->getVar('goalTitle');
		$save['info']['goalDescription'] =  $this->request->getVar('goalDescription');
		$save['info']['commitTitle'] =   $this->request->getVar('commitTitle');
		$save['info']['commitDescription'] =   $this->request->getVar('commitDescription');


        $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 $file = $this->request->getFile('bottomImage');
		  if(!empty($_FILES['bottomImage']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['bottomImage'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }


		// pillar
	     $featureImagesData = array();
		  if ($this->request->getFileMultiple('featureImage')) {
			foreach($this->request->getFileMultiple('featureImage') as $key => $file)
		   {  
			   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/product/', $file_name)){
				   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			   }	 
			 }
		   }
	     }
                
       $save['featureImages'] = $featureImagesData;
	   $save['old_feature_image'] = $this->request->getVar('old_feature_image');

     	$save['featureTitle'] =  $this->request->getVar('featureTitle');
		$save['featureDescription'] = $this->request->getVar('featureDescription');
		$save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


		// commitment

//       $commitImagesData = array();
// 		  if ($this->request->getFileMultiple('commitImage')) {
// 			foreach($this->request->getFileMultiple('commitImage') as $key => $file)
// 		   {  
// 			   if($file->isValid() && !$file->hasMoved()){
// 			   $file_name = $file->getRandomName();
// 			   if($file->move('uploads/product/', $file_name)){
// 				   $commitImagesData[$key] = 'uploads/product/'.$file_name;
// 			   }	 
// 			 }
// 		   }
// 	     }
                
    //   $save['commitImage'] = $commitImagesData;
	   //$save['old_commit_image'] = $this->request->getVar('old_commit_image');
	 
// faq	 
 $save['faqTitle'] = $this->request->getVar('faqTitle');
 $save['faqDescription'] = $this->request->getVar('faqDescription');
 $save['faqSortOrder'] = $this->request->getVar('faqSortOrder');



		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_cx_heading($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_cx_heading/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_cx_heading/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_cx_heading($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/cx_heading');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_cx_heading');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_cx_heading',$data);

	}
	

	function delete_cx_heading(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('cx_heading',array('id'=>$value));
				$this->AdminModel->deleteData('cx_feature',array('cx_id'=>$value));
				$this->AdminModel->deleteData('cx_faq',array('cx_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/cx_heading');
	}
////////////////////////////////////


function cx_feature(){
	error_reporting(0);
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
		return redirect()->to('admin/permission-denied');
	}
	  $data['page_title'] = 'Feature Tab';
	  $data['detail'] = $this->AdminModel->all_fetch('cx_feature_tab',null);
	  echo view('admin/cms/cx_feature',$data);

	}
	  
	 
	
	function add_cx_feature($id=false)
	 {
	 		error_reporting(0);
		$model = new CmsModel();

	 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Feature Tab';
		$data['form_action'] ='admin/add_cx_feature/'.$id;
		$row = $this->AdminModel->fs('cx_feature_tab',array('id'=>$id));
	
		$data['title'] =  $row->title; 
		$data['description'] =  $row->description;    
		$data['image'] = $row->image; 
		$data['pillarTitle'] = $row->pillarTitle; 
		$data['shotDescription'] = $row->shotDescription;  
		$data['goalTitle'] = $row->goalTitle;
		$data['goalDescription'] = $row->goalDescription;
		$data['goalImage'] = $row->goalImage;
		$data['commitTitle'] = $row->commitTitle;
		$data['commitDescription'] = $row->commitDescription;
		$data['committedImage'] = $row->committedImage;
		$data['bottomImage'] = $row->bottomImage;

		
		// $data['featureList'] =  $this->AdminModel->all_fetch('cx_feature',array('cx_id'=>$row->id));
		// $data['faqList'] =  $this->AdminModel->all_fetch('cx_faq',array('cx_id'=>$row->id));
	


		}else{
		
		$data['page_title'] = ' Add Feature Tab';
		$data['form_action'] ='admin/add_cx_feature';

		$data['title'] =   '';
		$data['description'] =   '';        
		$data['image'] =   ''; 
		$data['pillarTitle'] =  ''; 
		$data['shotDescription'] =  ''; 
		$data['goalTitle'] = ''; 
		$data['goalDescription'] =''; 
		$data['goalImage'] =''; 
		$data['commitTitle'] = ''; 
		$data['commitDescription'] = ''; 
		$data['committedImage'] = ''; 
		$data['bottomImage'] = ''; 

		
		$data['featureList'] =  array();
		$data['faqList'] =  array();
	


		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'description'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{


		$save= array();
		$save['info']['description'] =   $this->request->getVar('description');
		$save['info']['title'] =   $this->request->getVar('title');
		$save['info']['pillarTitle'] =   $this->request->getVar('pillarTitle');
		$save['info']['shotDescription'] =  $this->request->getVar('shotDescription');
		$save['info']['goalTitle'] =   $this->request->getVar('goalTitle');
		$save['info']['goalDescription'] =  $this->request->getVar('goalDescription');
		$save['info']['commitTitle'] =   $this->request->getVar('commitTitle');
		$save['info']['commitDescription'] =   $this->request->getVar('commitDescription');


        $file = $this->request->getFile('image');
		  if(!empty($_FILES['image']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['image'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }

		 $file = $this->request->getFile('bottomImage');
		  if(!empty($_FILES['bottomImage']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['bottomImage'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }


		// pillar
	  //    $featureImagesData = array();
		 //  if ($this->request->getFileMultiple('featureImage')) {
			// foreach($this->request->getFileMultiple('featureImage') as $key => $file)
		 //   {  
			//    if($file->isValid() && !$file->hasMoved()){
			//    $file_name = $file->getRandomName();
			//    if($file->move('uploads/product/', $file_name)){
			// 	   $featureImagesData[$key] = 'uploads/product/'.$file_name;
			//    }	 
			//  }
		 //   }
	  //    }
                
  //      $save['featureImages'] = $featureImagesData;
	 //   $save['old_feature_image'] = $this->request->getVar('old_feature_image');

  //    	$save['featureTitle'] =  $this->request->getVar('featureTitle');
		// $save['featureDescription'] = $this->request->getVar('featureDescription');
		// $save['featureSortOrder'] = $this->request->getVar('featureSortOrder');


		// commitment

//       $commitImagesData = array();
// 		  if ($this->request->getFileMultiple('commitImage')) {
// 			foreach($this->request->getFileMultiple('commitImage') as $key => $file)
// 		   {  
// 			   if($file->isValid() && !$file->hasMoved()){
// 			   $file_name = $file->getRandomName();
// 			   if($file->move('uploads/product/', $file_name)){
// 				   $commitImagesData[$key] = 'uploads/product/'.$file_name;
// 			   }	 
// 			 }
// 		   }
// 	     }
                
    //   $save['commitImage'] = $commitImagesData;
	   //$save['old_commit_image'] = $this->request->getVar('old_commit_image');
	 
// faq	 
 // $save['faqTitle'] = $this->request->getVar('faqTitle');
 // $save['faqDescription'] = $this->request->getVar('faqDescription');
 // $save['faqSortOrder'] = $this->request->getVar('faqSortOrder');



		  if ($id) {
			  $save['id'] =  $id;
			  $save['info']['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->save_cx_feature($save);
			  if ($result) {
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_cx_feature/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_cx_feature/'.$id);
			  }
		  }else{
	
			 $save['info']['create_date'] = date('Y-m-d H:i:s');
			 $save['info']['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->save_cx_feature($save);
			  if ($result) {
			 
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/cx_feature');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_cx_feature');
			  }
	
		  }
	
	   }
	 }
	return view('admin/cms/add_cx_feature',$data);

	}
	

	function delete_cx_feature(){
	  if ($this->request->getVar()) {
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$this->AdminModel->deleteData('cx_feature_tab',array('id'=>$value));
				// $this->AdminModel->deleteData('cx_feature',array('cx_id'=>$value));
				// $this->AdminModel->deleteData('cx_faq',array('cx_id'=>$value));
			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/cx_feature');
	}






}
