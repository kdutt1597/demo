<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\coreModule\BackendModel;
use App\Models\coreModule\AdminGroupModel;
use App\Models\coreModule\MenuModel;
use App\Models\coreModule\FrontMenuModel;
use App\Models\coreModule\SettingModel;

use App\Models\Cms\IndustryModel;
use App\Models\module\CareerModel;
use App\Models\module\EnquiryModel;

use App\Models\Cms\ServiceModel;
use App\Models\Cms\SolutionModel;




class Backend extends BaseController
{

	public function __construct()
	{

	    $session = \Config\Services::session();
	  	$this->admin_id = $session->get('adminLogin');

         $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}


  public function index()
	{ 


    $model = new BackendModel();	
    $IndustryModel = new IndustryModel(); 
    $ServiceModel = new ServiceModel(); 
    $CareerModel = new CareerModel(); 
    $EnquiryModel = new EnquiryModel(); 
     $SolutionModel = new SolutionModel(); 



    $data['page_title'] = 'Dashboard';

    $data['admin'] = $model->asObject()->findAll();

    $data['careerCount'] = $CareerModel->countAllResults();
    $data['ServiceCount'] = $ServiceModel->countAllResults();
    $data['SolutionCount'] = $SolutionModel->countAllResults();
     $data['indusryCount'] = $IndustryModel->countAllResults();
     
    $data['enquiryCount'] = $EnquiryModel->countAllResults();
    
    $data['letestProduct'] = $ServiceModel->asObject()->orderBy('id','DESC')->limit(3)->findAll();

	return view('admin/backend/dashboard',$data);
	
	}



	public function profile()
	{
   
   
	  $model = new BackendModel();
	  
	  $data['page_title']= 'Profile';
	  $data['detail'] = $model->asObject()->where(array('id'=>$this->admin_id))->first('admin');
	  $data['form_action'] ='admin/profile';


	 
	 if($this->request->getMethod()=='post'){
	
	 $rules['username'] = ['label'=>'Username','rules'=>'trim|required|admin_username['.$this->admin_id.']'];
   $rules['email'] = ['label'=>'Email','rules'=>'required|admin_email['.$this->admin_id.']'];
   $rules['firstname'] = ['label'=>'First Name','rules'=>'required'];


    if (!empty($this->request->getVar('password'))) {
     $rules['password'] = ['label'=>'Password','rules'=>'required|min_length[6]|max_length[50]'];
     $rules['confirm'] = ['label'=>'Confirm Password','rules'=>'required|matches[password]'];

    } 

	  if ($this->validate($rules)==FALSE) {
		$data['validation'] = $this->validator;
	  }else{
		$save = array();
		$save['username'] = $this->request->getVar('username');
		$save['firstname'] = $this->request->getVar('firstname');
		$save['lastname'] = $this->request->getVar('lastname');
		$save['email'] = $this->request->getVar('email');
		$save['modify_date'] = date('Y-m-d H:i:s');
		
		if (!empty($this->request->getVar('password'))) {
		$save['password'] = password_hash($this->request->getVar('password'),PASSWORD_BCRYPT);
		}
		
	  
		$file = $this->request->getFile('photo');
		if(!empty($file->getClientName())){
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/images/', $file_name)){
					$save['photo'] = 'uploads/images/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}
	  

		$result = $model->update(array('id'=>$this->admin_id),$save);
		if ($result) {
		  $this->session->setFlashdata('success','Record update successfully');
		return   redirect()->to('admin/profile');
		}else{
			$this->session->setFlashdata('error','Record update unsuccessful!');
			redirect()->to('admin/profile');
		}
	   }
	  }
	  return view('admin/backend/profile',$data);
  }





// user

function users()
 {

 	$model = new BackendModel();
    if(empty($this->AdminModel->permission($this->uri->getSegment(2)))){
     return redirect()->to('admin/permission-denied');
    } 
    
     $data['detail'] = $model->asObject()->findAll();

     $users = $this->AdminModel->all_fetch('admin_group',null);
     foreach ($users as $key => $value) {
       $urlist[$value->id] = $value->name;
     }
     $data['user_list'] = $urlist;
     $data['page_title']  ='Users List';
     echo view('admin/backend/users',$data);

 }


 function add_user($id=false)
 {
 $model = new BackendModel();	

 $data['user_list'] = $this->AdminModel->all_fetch('admin_group',null);
  
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit User';
    $data['form_action'] ='admin/add_user/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();

    $data['menu_id'] = json_decode($row->permission);
    $data['firstname'] =  $row->firstname;   
    $data['lastname'] =  $row->lastname; 
    $data['username'] =  $row->username; 
    $data['email'] =  $row->email; 
    $data['photo'] =  $row->photo; 
    $data['status'] =  $row->status; 
    $data['user_group_id'] =  $row->user_group_id; 
    
    $this->form_user_id = $id;
    }else{
    
     $data['page_title'] = ' Add User';
     $data['form_action'] ='admin/add_user';
     $data['firstname'] =  '';   
     $data['lastname'] =  '';
     $data['username'] = '';   
     $data['email'] = '';   
     $data['photo'] = '';   
     $data['status'] = '';   
     $data['menu_id'] = ''; 
     $data['user_group_id'] = ''; 

    }


  if($this->request->getMethod()=='post'){

	$rules['username'] = ['label'=>'Username','rules'=>'trim|required|admin_username['.$id.']'];
	$rules['email'] = ['label'=>'Email','rules'=>'required|admin_email['.$this->admin_id.']'];
	$rules['firstname'] = ['label'=>'First Name','rules'=>'required'];


  	if (!empty($this->request->getVar('password'))) {
  	$rules['password'] = ['label'=>'Password','rules'=>'required|min_length[6]|max_length[50]'];
  	 $rules['confirm'] = ['label'=>'Confirm Password','rules'=>'required|matches[password]'];

  	}


    if ($this->validate($rules)==false) {
       
    $data['validation'] = $this->validator;
     } else{

     // echo '<pre>';
     // print_r($_POST); exit;
      $save= array();
      $save['firstname'] =     $this->request->getVar('firstname');
      $save['lastname'] =     $this->request->getVar('lastname');
      $save['email'] =     $this->request->getVar('email');
      $save['status'] =     $this->request->getVar('status');
      $save['username'] =     $this->request->getVar('username');
       // $save['permission'] =     json_encode($this->request->getVar('permission'));
      $save['user_group_id'] =     $this->request->getVar('user_group_id');
      
       if (!empty($this->request->getVar('password'))) {
      $save['password'] = password_hash(trim($this->request->getVar('password')),PASSWORD_BCRYPT);
      }
         

     $file = $this->request->getFile('photo');
     if(!empty($file->getClientName())){
      $file = $this->request->getFile('photo');
      if($file->isValid() && !$file->hasMoved()){
         $file_name = $file->getRandomName();
         if($file->move('uploads/images/', $file_name)){
         $save['photo'] = 'uploads/images/'.$file_name;
       }
      }else{
        throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        exit;
      }
    }

  
             
      if ($id) {
          $save['modify_date'] =  date('Y-m-d');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          redirect()->to('admin/user');
          }else{
          $this->session->setFlashdata('error','Record not update');
          redirect()->to('admin/add_user/'.$id);
          }
      }else{
         $save['create_date'] =  date('Y-m-d');
          $save['modify_date'] =  date('Y-m-d');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          redirect()->to('admin/user');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          redirect()->to('admin/add_user');
          }

      }

   }
  }
return view('admin/backend/add_user',$data);
}



function delete_users()
{ 
    $model = new BackendModel();
    if ($this->request->getPost()) {
      $id = $this->request->getVar('selected');
      $last_record = $model->countAllResults(); 
     if ($last_record >= 2) {  
     	foreach ($id as  $value) {
     		 $check =  $model->delete(array('id'=>$value));
     	}
     
     if ($check=1) {
       $this->session->setFlashdata('success','Record Delete successfully');
     }else{
      $this->session->setFlashdata('error','User can not be deleted ');
     }
    }else{
      $this->session->setFlashdata('error','Last User can not be deleted');
     
    }     
   }
  return redirect()->to('admin/users');
}


///////////////////////////////////


function user_group()
 {
 	$model = new AdminGroupModel();
    if(empty($this->AdminModel->permission($this->uri->getSegment(2)))){
     return redirect()->to('admin/permission-denied');
    } 
    
     $data['detail'] = $model->asObject()->findAll();
     $data['totals'] = $model->countAllResults();
     $data['page_title']  ='User Groups';
     echo view('admin/backend/user_group',$data);

 }


 function add_user_group($id=false)
 {
 	
 $model = new AdminGroupModel();
 $data['menu_list'] = $this->AdminModel->all_fetch('menu',array('parent_id'=>0,'status'=>1,'visible'=>1),'sort_order','asc');
  
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit User Group';
    $data['form_action'] ='admin/add_user_group/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['menu_id'] = json_decode($row->permission);

    $data['name'] =  $row->name;   
    $this->form_user_id = $id;
    }else{
    
     $data['page_title'] = ' Add User Group';
     $data['form_action'] ='admin/add_user_group';
     $data['name'] =  '';   
     $data['menu_id'] = array(); 
     
    }

 

  if($this->request->getMethod()=='post'){

  $rules = [
    'name'=>['label'=>'Name','rules'=>'trim|required'],
  ];  


    if ($this->validate($rules)==false) {
       
    $data['validation'] = $this->validator;
     } else{


      $save= array();
      $save['name'] =     $this->request->getVar('name');
      $save['permission'] =     json_encode($this->request->getVar('permission'));
 
                       
      if ($id) {
         
          $save['modify_date'] =  date('Y-m-d');
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
         return redirect()->to('admin/user_group');
          }else{
          $this->session->setFlashdata('error','Record not update');
         return redirect()->to('admin/add_user_group/'.$id);
          }
      }else{
         $save['create_date'] =  date('Y-m-d');
         $save['modify_date'] =  date('Y-m-d');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/user_group');
          }else{
          $this->session->setFlashdata('error','Record not insert');
         return redirect()->to('admin/add_user_group');
          }

      }

   }
  }
return view('admin/backend/add_user_group',$data);
}



function delete_user_group()
{ 
    $model = new AdminGroupModel();
    if ($this->request->getPost()) {
      $id = $this->request->getVar('selected');
      $last_record = $model->countAllResults(); 
     if ($last_record >= 2) {  
     	foreach ($id as  $value) {
     	  $check =  $model->delete(array('id'=>$value));
     	}
    
     if ($check=1) {
       $this->session->setFlashdata('success','Record Delete successfully');
     }else{
      $this->session->setFlashdata('error','User can not be deleted ');
     }
    }else{
      $this->session->setFlashdata('error','Last User can not be deleted');
     
    }     
   }
  return redirect()->to('admin/user_group');
    
}




/////////////////////////

// BACKEND MENU

  function menu()
  {

  	$model = new MenuModel();
    if(empty($this->AdminModel->permission($this->uri->getSegment(2)))){
    redirect('admin/permission-denied');
    } 

   $data['page_title']  ='All Backend Menu Managment';
// pagination
	$data['perPage'] = 5;
	$data['menu'] = $model->asObject()->where(array('parent_id'=>0,'status'=>1,'visible'=>1))->orderBy('id','asc')->paginate($data['perPage']);
	$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

	$data['total'] = $model->where(array('parent_id'=>0,'status'=>1,'visible'=>1))->countAllResults();

	$data['data'] = $model->paginate($data['perPage']);
	$data['pager'] = $model->pager;

	$data['pages'] = round($data['total']/$data['perPage']);
	$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
// end


    echo view('admin/backend/menu',$data);

  }

  /////////////////


function add_menu($id=false)
{
  $model = new MenuModel();	
   $data['menu_list'] = $model->asObject()->where(array('parent_id'=>'0'))->findAll();

 if(@$id) {
   
   $data['page_title'] = ' Edit Menu ';
   $data['form_action'] ='admin/add_menu/'.$id;
   $row = $this->AdminModel->fs('menu',array('id'=>$id));
   $data['name'] =  $row->name;   
  $data['fafa'] =  $row->fafa; 
  $data['link'] =  $row->link; 
  $data['sort_order'] =  $row->sort_order; 
  $data['status'] =  $row->status; 
  $data['parent_id'] =  $row->parent_id; 
   }else{
   
   $data['page_title'] = ' Add Menu';
   $data['form_action'] ='admin/add_menu';
   $data['name'] =  '';   
   $data['fafa'] =  ''; 
   $data['link'] =  '';  
   $data['sort_order'] =  '';  
   $data['status'] =  '';  
   $data['parent_id'] =  '';
   }

 
   if ($this->request->getMethod()=='post') {

  $rules = [
    'name'=>'required',
  ];
  
    if ($this->validate($rules)==false) {
     $data['validation'] = $this->validator;
  } else{
   

   $save= array();
   $save['name'] =     $this->request->getVar('name');
   $save['fafa'] =     $this->request->getVar('fafa');
   $save['link'] =     $this->request->getVar('link');
   $save['sort_order'] =     $this->request->getVar('sort_order');
   $save['status'] =     $this->request->getVar('status');
   $save['parent_id'] =     $this->request->getVar('parent_id');
    
    
   if ($id) {
     $save['modify_date'] =   date('Y-m-d H:i:s');
     $save['id'] =  $id;
     $result=  $model->update(array('id'=>$id),$save);
     if ($result) {
     $this->session->setFlashdata('success','Record Update successfully');
     redirect()->to('admin/add_menu/'.$id);
     }else{
     $this->session->setFlashdata('error','Record not update');
     redirect()->to('admin/add_menu/'.$id);
     }
   }else{
     $save['create_date'] =   date('Y-m-d H:i:s');
     $save['modify_date'] =   date('Y-m-d H:i:s');
    $result=  $model->insert($save);
     if ($result) {    
     $this->session->setFlashdata('success','Record insert successfully');
     return redirect()->to('admin/menu');
     }else{
     $this->session->setFlashdata('error','Record not insert');
     return redirect()->to('admin/add_menu');
     }

   }

   }
  
 }
 return  view('admin/backend/add_menu',$data);
}


function delete_menu(){
	$model = new MenuModel();
   $ids = $this->request->getVar('selected');
   if (!empty($ids)) {
   
   foreach($ids as $value){
   $model->delete(array('id'=>$value));    
   }
  }
   $this->session->setFlashdata('success','Record Delete successfully');
   return redirect()->to('admin/menu');
   
}

///////////////////////////

// FRONT MENU


function front_menu()
 {
    $model = new FrontMenuModel();
    if(empty($this->AdminModel->permission($this->uri->getSegment(2)))){
    redirect('admin/permission-denied');
    } 

     // $data['detail'] = $model->asObject()->where(array('parent_id'=>0))->findAll();
     $data['page_title']  ='Frontend Menu Managment';

  // pagination
    $data['perPage'] = 15;
    $data['detail'] = $model->asObject()->where(array('parent_id'=>0))->orderBy('id','asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->where(array('parent_id'=>0))->countAllResults();
    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = round($data['total']/$data['perPage']);
    $data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
  // end

    return view('admin/backend/front_menu',$data);

 }

function add_front_menu($id=false)
 {
 
    $model = new FrontMenuModel();
    $data['menu_list'] = $model->asObject()->where(array('parent_id'=>'0'))->findAll();
 
  if(@$id) {
    
    $data['page_title'] = ' Edit Front Menu ';
    $data['form_action'] ='admin/add_front_menu/'.$id;
    $row = $this->AdminModel->fs('front_menu',array('id'=>$id));
    $data['name'] =  $row->name;   
    $data['subTitle'] =  $row->subTitle;
    $data['description'] =  $row->description;
    $data['title'] =  $row->title;
     $data['image'] =  $row->image; 
    $data['link'] =  $row->link; 
    $data['sort_order'] =  $row->sort_order; 
    $data['status'] =  $row->status; 
    $data['parent_id'] =  $row->parent_id; 
    $data['header'] =  $row->header; 
    $data['footer'] =  $row->footer; 
    $data['position'] =  $row->position;
    $data['sort_order_footer'] =  $row->sort_order_footer;
    $data['metaTitle'] =  $row->metaTitle;
    $data['metaKeyword'] =  $row->metaKeyword;
    $data['metaDescription'] =  $row->metaDescription;
    
     $data['title1'] =  $row->title1;
     $data['description1'] =  $row->description1;
     $data['title2'] =  $row->title2;
     $data['description2'] =  $row->description2;
     $data['additionalImage'] =  $row->additionalImage;
     $data['hamburger'] =  $row->hamburger;
    
    
    
    
    
    }else{
    
    $data['page_title'] = ' Add Front Menu';
    $data['form_action'] ='admin/add_front_menu';
    $data['name'] =  '';   
    $data['subTitle'] =  ''; 
    $data['link'] =  '';  
    $data['sort_order'] =  '';  
    $data['title'] =  ''; 
    $data['status'] =  '';  
    $data['parent_id'] =  '';
    $data['header'] =  '';
    $data['footer'] =  '';
    $data['position'] =  '';
    $data['sort_order_footer'] =  '';
    $data['metaTitle'] =  '';
    $data['metaKeyword'] =  '';
    $data['metaDescription'] = '';
    $data['image'] = ''; 
    $data['description'] = '';
    $data['title1'] =  '';
     $data['description1'] =  '';
     $data['title2'] =  '';
     $data['description2'] =  '';
     $data['additionalImage'] =  '';
       $data['hamburger'] =  '';
    
    
    }

    
    if ($this->request->getMethod()=='post') {   
   
    $rules = [
      'name'=>'required'
    ];    

    if ($this->validate($rules)==false) {
      $data['validation'] = $this->validator;
    } else{

 
        $save= array();
        $save['name'] =     $this->request->getVar('name');
        $save['subTitle'] =     $this->request->getVar('subTitle');
        $save['link'] =     $this->request->getVar('link');
        $save['sort_order'] =  $this->request->getVar('sort_order');
        $save['status'] =     $this->request->getVar('status');
        $save['parent_id'] =     $this->request->getVar('parent_id');
        $save['title'] =     $this->request->getVar('title');
        $save['header'] =     $this->request->getVar('header');
        $save['footer'] =     $this->request->getVar('footer');
        $save['position'] =     $this->request->getVar('position');
        $save['metaTitle'] =     $this->request->getVar('metaTitle');
        $save['metaKeyword'] =     $this->request->getVar('metaKeyword');
        $save['metaDescription'] =     $this->request->getVar('metaDescription');
        $save['sort_order_footer'] =     $this->request->getVar('sort_order_footer');  
        $save['description'] = $this->request->getVar('description');

        $save['title1'] = $this->request->getVar('title1');
        $save['description1'] = $this->request->getVar('description1');
        $save['title2'] = $this->request->getVar('title2');
        $save['description2'] = $this->request->getVar('description2');
       $save['hamburger'] = $this->request->getVar('hamburger');


     if(!empty($_FILES['image']['name'])) {
      $file = $this->request->getFile('image');
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
        
 
     if(!empty($_FILES['additionalImage']['name'])) {
      $file = $this->request->getFile('additionalImage');
      if($file->isValid() && !$file->hasMoved()){
         $file_name = $file->getRandomName();
         if($file->move('uploads/images/', $file_name)){
         $save['additionalImage'] = 'uploads/images/'.$file_name;
       }
      }else{
        throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        exit;
      }
    }
        
      if ($id) {
          $save['modify_date'] =   date('Y-m-d H:i:s');
          $save['id'] =  $id;
          $result=  $model->update(array('id'=>$id),$save);
          if ($result) {
          $this->session->setFlashdata('success','Record Update successfully');
          return redirect()->to('admin/add_front_menu/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_front_menu/'.$id);
          }
      }else{
        $save['create_date'] =   date('Y-m-d H:i:s');
        $save['modify_date'] =   date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/front_menu');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_front_menu');
          }

      }
    }
   }
    return view('admin/backend/add_front_menu',$data);
}



function delete_front_menu(){
    $model = new FrontMenuModel();
    $ids = $this->request->getVar('selected');
    foreach($ids as $value){
    $model->delete(array('id'=>$value));    
    }
    $this->session->setFlashdata('success','Record Delete successfully');
    return redirect()->to('admin/front_menu');
    
}

////////////////////////////////////

// WEB SETTING


  public function setting()
  {
  
    $model = new SettingModel(); 
    if(empty($this->AdminModel->permission($this->uri->getSegment(2)))){
    redirect('admin/permission-denied');
    } 
    
     $data['page_title']  ='Web Setting';
   
     $data['config'] = websetting();
   
    return view('admin/backend/setting',$data);

  }



  function edit_setting($id=false)
  {
     
     $model = new SettingModel(); 
     $all_setting = array();
     // $data['country_list'] = $this->AdminModel->all_fetch('country',null);
     // $data['state_list'] = $this->AdminModel->all_fetch('state',null);
    
  
     $data['page_title'] = ' Edit Setting';
     $data['form_action'] ='admin/edit_setting';
     $setting = $model->asObject()->where(array('code'=>'config'))->findAll();

     foreach ($setting as $key => $value) {
     $all_setting[$value->key] = $value->value;
     }
   
     $data['config'] = $all_setting;
   
    if($this->request->getMethod()=='post'){
   
     $rules = [
       'config_name'=>['lable'=>'Store Name','rules'=>'required'],
     ]; 
   
     if ($this->validate($rules)==false) {
    $data['validation'] = $this->validator;
    }else{
   
     $save= array();
     $save = $this->request->getPost();
    

     $file = $this->request->getFile('config_logo');
     if(!empty($file->getClientName())){
         if($file->isValid() && !$file->hasMoved()){
              $file_name = $file->getRandomName();
              if($file->move('uploads/images/', $file_name)){
                $save['config_logo'] = 'uploads/images/'.$file_name;
            }
         }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
       exit;
     }
      }else{
    $save['config_logo'] = $this->request->getVar('old_config_logo');
    unset($save['old_config_logo']);
    
    }

    
    $file = $this->request->getFile('config_footer_logo');
    if(!empty($file->getClientName())){
    $file = $this->request->getFile('config_footer_logo');
    if($file->isValid() && !$file->hasMoved()){
       $file_name = $file->getRandomName();
       if($file->move('uploads/images/', $file_name)){
         $save['config_footer_logo'] = 'uploads/images/'.$file_name;
       }
    }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
     }else{
     $save['config_footer_logo'] = $this->request->getVar('old_config_footer_logo');
     unset($save['old_config_footer_logo']);
   }
   
   $file = $this->request->getFile('config_favicon');
   if(!empty($file->getClientName())){
    $file = $this->request->getFile('config_favicon');
    if($file->isValid() && !$file->hasMoved()){
       $file_name = $file->getRandomName();
       if($file->move('uploads/images/', $file_name)){
         $save['config_favicon'] = 'uploads/images/'.$file_name;
       }
    }else{
      throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
      exit;
    }
     }else{
     $save['config_favicon'] = $this->request->getVar('old_config_favicon');
     unset($save['old_config_favicon']);
   }

         
   
     $result = $model->save_setting($save);


     
    if ($result) {
     $this->session->setFlashdata('success','Record Update successfully');
     return  redirect()->to('admin/setting');
     }else{
     $this->session->setFlashdata('error','Record not insert');
     return redirect()->to('admin/edit_setting');
     }
   
    }
   
   }
  return  view('admin/backend/add_setting',$data);

}




/////////////////////////////

public function chartData(): void {
  
    $model = new BackendModel();
    $json = [];

  
    $json['order'] = [];
    $json['customer'] = [];
    $json['xaxis'] = [];
    $json['order']['label'] = 'Orders';
    $json['customer']['label'] = ['Coustomer'];

    $json['order']['data'] = [];



    if (!empty($this->request->getVar('range'))) {
      $range = $this->request->getVar('range');
    } else {
      $range = 'day';
    }

    switch ($range) {
      default:
      case 'day':

        $results = [];// $model->getTotalOrdersByDay();

        // foreach ($results as $key => $value) {
        //   $json['order']['data'][] = [$key, $value['total']];
        // }
        $json['order']['data'] = array('0'=>array('0'=>'1','1'=>'5'),'1'=>array('0'=>'2','1'=>'6'));

        $results = []; // $modal->getTotalCustomersByDay();

        // foreach ($results as $key => $value) {
        //   $json['customer']['data'][] =  [$key, $value['total']];
        // }
           $json['customer']['data'] =  array('0'=>array('0'=>'1','1'=>'5'),'1'=>array('0'=>'2','1'=>'6'));

        for ($i = 0; $i < 24; $i++) {
          $json['xaxis'][] = [$i, $i];
        }
        break;
      case 'week':
    
       $results = [];// $model->getTotalOrdersByDay();

        // foreach ($results as $key => $value) {
        //   $json['order']['data'][] = [$key, $value['total']];
        // }
        $json['order'] = ['10','20','30','40','50'];

        $results = []; // $modal->getTotalCustomersByDay();

        // foreach ($results as $key => $value) {
        //   $json['customer']['data'][] =  $value['total'];
        // }
           $json['customer'] = ['5','10','15','20','25'];

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
          $date = date('Y-m-d', $date_start + ($i * 86400));

          $json['xaxis'][] = [date('w', strtotime($date)), date('D', strtotime($date))];
        }
        break;
      case 'month':
       $results = [];// $model->getTotalOrdersByDay();

        // foreach ($results as $key => $value) {
        //   $json['order']['data'][] = $value['total'];
        // }
        $json['order'] = ['10','20','30'];

        $results = []; // $modal->getTotalCustomersByDay();

        // foreach ($results as $key => $value) {
        //   $json['customer']['data'][] =  $value['total'];
        // }
           $json['customer'] = ['5','10','15'];

        for ($i = 1; $i <= date('t'); $i++) {
          $date = date('Y') . '-' . date('m') . '-' . $i;

          $json['xaxis'][] = [date('j', strtotime($date)), date('d', strtotime($date))];
        }
        break;
      case 'year':
        $results = [];// $model->getTotalOrdersByDay();

        // foreach ($results as $key => $value) {
        //   $json['order']['data'][] = $value['total'];
        // }
        $json['order'] = ['10','20','30'];

        $results = []; // $modal->getTotalCustomersByDay();

        // foreach ($results as $key => $value) {
        //   $json['customer']['data'][] =  $value['total'];
        // }
           $json['customer'] = ['5','10','15'];


        for ($i = 1; $i <= 12; $i++) {
          $json['xaxis'][] = [$i, date('M', mktime(0, 0, 0, $i))];
        }
        break;
    }

   echo  json_encode($json);


 // data

//    (
//     [order] => Array
//         (
//             [label] => Orders
//             [data] => Array
//                 (
//                     [0] => Array
//                         (
//                             [0] => 0
//                             [1] => 0
//                         )

//                     [1] => Array
//                         (
//                             [0] => 1
//                             [1] => 0
//                         )

//                 )

//         )

//     [customer] => Array
//         (
//             [label] => Customers
//             [data] => Array
//                 (
//                     [0] => Array
//                         (
//                             [0] => 0
//                             [1] => 0
//                         )

//                     [1] => Array
//                         (
//                             [0] => 1
//                             [1] => 0
//                         )

                   

//                 )

//         )

//     [xaxis] => Array
//         (
//             [0] => Array
//                 (
//                     [0] => 0
//                     [1] => Sun
//                 )

//             [1] => Array
//                 (
//                     [0] => 1
//                     [1] => Mon
//                 )
//         )

// )



  }







   function permission_denied(){
         $data['page_title']= 'Permision Denied';
         return view('admin/permission_denied',$data);
    }


	function logout(){
		$this->session->remove('adminLogin');
		return redirect()->route('admin_console');
	}


}
