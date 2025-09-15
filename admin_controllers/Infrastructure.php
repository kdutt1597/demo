<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\coreModule\SettingModel;
use App\Models\Cms\CmsModel;
use App\Models\Cms\InfrastructureModel;
use App\Models\Cms\EngineeringProcessModel;



class Infrastructure extends BaseController
{
    
    public function __construct()
	{

	    $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}



 function infrastructure()
  {
   
   	$model = new InfrastructureModel();

    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return  redirect()->to('admin/permission-denied');
    }
    
     $data['page_title']  ='All Infrastructure List';
     $data['config_logo'] = $this->config_logo;

    		 // pagination
        $pager=service('pager'); 
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];

	   // end
    echo view('admin/cms/infrastructure',$data);

 }



 function add_infrastructure($id=false)
 {
 	
 	$data['typeList'] = array('corporate'=>'Corporate','innovation'=>'Innovation','production'=>'Production');
 
   $model = new CmsModel(); 
    
  if ($id) {
    $data['page_title'] = ' Edit Infrastructure';
    $data['form_action'] ='admin/add_infrastructure/'.$id;
    $row = $this->AdminModel->fs('infrastructure',array('id'=>$id));
    $data['name'] = $row->name; 
    $data['heading'] = $row->heading; 
    $data['sub_heading'] = $row->sub_heading; 
    $data['slider_link'] = $row->slider_link; 
    $data['description'] = $row->description; 
	$data['sortOrder'] = $row->sortOrder; 
	$data['thumbnail'] = $row->thumbnail; 
	$data['status'] = $row->status; 
	$data['slug'] = $row->slug; 
	$data['type'] = $row->type;
	$data['industry'] = $row->industry;
	$data['address'] = $row->address;
	$data['map'] = $row->map;


    $data['faqList'] = $this->AdminModel->all_fetch('infrastructure_faq',array('infra_id'=>$row->id),'id','asc');

    $data['sliderList'] = $this->AdminModel->all_fetch('infrastructure_image',array('infra_id'=>$row->id),'id','asc');
       
    }else{
    $data['page_title'] = ' Add Infrastructure';
    $data['form_action'] ='admin/add_infrastructure';
    $data['name'] = '';
    $data['heading'] = '';
    $data['sub_heading'] = '';
    $data['slider_link'] = '';
    $data['description'] = '';
    $data['sortOrder'] = '';
    $data['thumbnail'] ='';
    $data['status'] = '';
    $data['industry'] ='';
	$data['address'] = '';
	$data['map'] ='';
	$data['type'] ='';
    $data['slug'] = ''; 
    $data['faqList'] =  array();
    $data['sliderList'] = array();
   
    }

 
	if($this->request->getMethod()=='post'){

	$rules =[
		'name'=>'required'
	];

    if ($this->validate($rules)==false) {

		$data['validation'] = $this->validator;
     } else{
  
    $save= array();
    $save['info']['name'] = $this->request->getVar('name');
    $save['info']['heading'] = $this->request->getVar('heading');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['status'] = $this->request->getVar('status');
    $save['info']['sortOrder'] = $this->request->getVar('sortOrder');

	$save['info']['slug'] = sfu($this->request->getVar('name'));
	$save['info']['industry'] = $this->request->getVar('industry');
	$save['info']['address'] = $this->request->getVar('address');
	$save['info']['map'] = $this->request->getVar('map');
	$save['info']['type'] = $this->request->getVar('type');


    $file = $this->request->getFile('thumbnail');
		  if(!empty($_FILES['thumbnail']['name'])){
		   if($file->isValid() && !$file->hasMoved()){
			   $file_name = $file->getRandomName();
			   if($file->move('uploads/images/', $file_name)){
				   $save['info']['thumbnail'] = 'uploads/images/'.$file_name;
			   }
			}else{
			   throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			   exit;
		   }
		 }


	// gallery
      $uploadImgData = array();
	  if ($this->request->getFileMultiple('images')) {
		foreach($this->request->getFileMultiple('images') as $key => $file)
	   {  
		   if($file->isValid() && !$file->hasMoved()){
		   $file_name = $file->getRandomName();
		   if($file->move('uploads/product/', $file_name)){
			   $uploadImgData[$key] = 'uploads/product/'.$file_name;
		   }	 
		 }
	   }	
     }
                 
        
	$save['images'] = $uploadImgData;
	$save['old_image'] = $this->request->getVar('old_image');
    $save['gallery_sort_order'] = $this->request->getVar('gallery_sort_order');



	// faq
	$save['question'] = $this->request->getVar('question'); 
	$save['answer'] = $this->request->getVar('answer'); 
	$save['sort_order'] = $this->request->getVar('sort_order');   

    if ($id) {
    $save['id'] = $id;
    $result = $model->save_infrastructure($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Update successfully');
        return redirect()->to('admin/add_infrastructure/'.$id);
      }else{
        $this->session->setFlashdata('error','Error in Update ');
        return redirect()->to('admin/add_infrastructure/'.$id);
      }
    }else{
     $save['id'] = '';
      $result = $model->save_infrastructure($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Insert successfully');
        return redirect()->to('admin/infrastructure');
      }else{
        $this->session->setFlashdata('success','Record not inserted');
         return redirect()->to('admin/add_infrastructure');
      }
    }

   }
 }
  return view('admin/cms/add_infrastructure',$data);
}


function delete_infrastructure()
{

 $array =  $this->request->getVar('selected');
if (!empty($array)) {
  
  foreach ($array as $key => $value) {
    $this->AdminModel->deleteData('infrastructure',array('id'=>$value));
    $this->AdminModel->deleteData('infrastructure_faq',array('infra_id'=>$value));
    $this->AdminModel->deleteData('infrastructure_image',array('infra_id'=>$value));
  }
  $this->session->setFlashdata('success','Record Delete successfully');
   return   redirect()->to('admin/infrastructure');
 }   
}

///////////////////////////



 function engineering_process()
  {
 
   	$model = new EngineeringProcessModel();

    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if(empty($permission)){
       return  redirect()->to('admin/permission-denied');
    }
    
     $data['page_title']  ='All Engineering Process List';
     $data['config_logo'] = $this->config_logo;

    	// pagination
        $pager=service('pager'); 
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->select('engineering_process.*,inf.name as infra_name')->join('infrastructure inf','engineering_process.infra_id=inf.id')->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];

	   // end
    echo view('admin/cms/engineering_process',$data);

 }



 function add_engineering_process($id=false)
 {
 		
  $InfrastructureModel = new InfrastructureModel();
  $data['infraList'] = $InfrastructureModel->asObject()->where('status',1)->findAll();
   $model = new EngineeringProcessModel(); 
    
  if ($id) {
    $data['page_title'] = ' Edit Engineering Process';
    $data['form_action'] ='admin/add_engineering_process/'.$id;
    $row = $model->asObject()->where('id',$id)->first();
    $data['name'] = $row->name; 
    $data['description'] = $row->description; 
    $data['sortOrder'] = $row->sortOrder; 
    $data['status'] = $row->status; 
    $data['infra_id'] = $row->infra_id; 
    
    $data['sliderList'] = $this->AdminModel->all_fetch('engineering_images',array('engg_id'=>$id));
    
    }else{
    $data['page_title'] = ' Add Engineering Process';
    $data['form_action'] ='admin/add_engineering_process';
    $data['name'] = '';
    $data['description'] = '';
    $data['sortOrder'] = '';
    $data['status'] = '';
    $data['infra_id'] =  '';
     $data['sliderList'] = array();
    }

 
	if($this->request->getMethod()=='post'){

	$rules =[
		'name'=>'required'
	];

    if ($this->validate($rules)==false) {

		$data['validation'] = $this->validator;
     
     } else{
  
    $save= array();
    $save['info']['name'] = $this->request->getVar('name');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['status'] = $this->request->getVar('status');
    $save['info']['sortOrder'] = $this->request->getVar('sortOrder');
    $save['info']['infra_id'] = $this->request->getVar('infra_id');



  // gallery
      $uploadImgData = array();
    if ($this->request->getFileMultiple('images')) {
    foreach($this->request->getFileMultiple('images') as $key => $file)
     {  
       if($file->isValid() && !$file->hasMoved()){
       $file_name = $file->getRandomName();
       if($file->move('uploads/product/', $file_name)){
         $uploadImgData[$key] = 'uploads/product/'.$file_name;
       }   
     }
     }  
     }
                 
        
  $save['images'] = $uploadImgData;
  $save['old_image'] = $this->request->getVar('old_image');
  $save['gallery_sort_order'] = $this->request->getVar('gallery_sort_order');

 

    if ($id) {
    $save['info']['id'] = $id;
    $result = $model->save($save['info']);

    if ($result) {
      $model->save_images($save);
        $this->session->setFlashdata('success','Record Update successfully');
        return redirect()->to('admin/add_engineering_process/'.$id);
      }else{
        $this->session->setFlashdata('error','Error in Update ');
        return redirect()->to('admin/add_engineering_process/'.$id);
      }

    }else{

      $result = $model->insert($save['info']);
      if ($result) {
           $save['info']['id'] = $this->db->insertID();
           $model->save_images($save);
           $this->session->setFlashdata('success','Record Insert successfully');
           return redirect()->to('admin/engineering-process');
      }else{
        $this->session->setFlashdata('success','Record not inserted');
         return redirect()->to('admin/add_engineering_process');
      }
     }

   }
 }
  return view('admin/cms/add_engineering_process',$data);
}


function delete_engineering_process()
{
 $model = new EngineeringProcessModel();
 $array =  $this->request->getVar('selected');
if (!empty($array)) {
  
  foreach ($array as $key => $value) {
    $model->delete(array('id'=>$value));

  }
  $this->session->setFlashdata('success','Record Delete successfully');
   return   redirect()->to('admin/engineering_process');
 }   
}


//////////////////////

}

?>