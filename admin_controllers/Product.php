<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\coreModule\SettingModel;
use App\Models\Cms\ProductModel;
use App\Models\Cms\SolutionModel;
use App\Models\Cms\SectorModel;
use App\Models\Cms\ProductCategoryModel;
use App\Models\Cms\IndustryModel;
use App\Models\Cms\ServiceModel;
use App\Models\Cms\GlossaryModel;
use App\Models\Cms\WhatisModel;

class Product extends BaseController
{
    public function __construct()
	{

	    $settingModel = new SettingModel();
        $default_img = $settingModel->asObject()->where(array('key'=>'config_logo'))->first();
        $this->config_logo = $default_img->value; 
             
	}




/////////////////////////////////// Code added by KD

	function glossary(){

		$model = new GlossaryModel();
		$permission = $this->AdminModel->permission($this->uri->getSegment(2));
		if(empty($permission)){
		return  redirect()->to('admin/permission-denied');
		} 
		
		$data['page_title'] = 'All Glossary List';

		$query = array();
			$like = array();
			if(!empty($_GET['type'])){
				$query['type'] = $_GET['type'];
			}

		if(!empty($_GET['name'])){
				$like['keyword'] = $_GET['name']; 
			}


		// pagination
			$data['perPage'] = 10;
			$data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('alphabet','asc')->paginate($data['perPage']);
			$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

			$data['total'] = $model->where($query)->like($like)->countAllResults();

			$data['data'] = $model->paginate($data['perPage']);
			$data['pager'] = $model->pager;

			$data['pages'] = round($data['total']/$data['perPage']);
			$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
		// end


		$data['config_logo'] = $this->config_logo;
		echo view('admin/product/glossary',$data);

	}


	function add_glossary($id=false)
	{
	
		$model = new GlossaryModel();
	
		if(!empty($id)) {
			
			$data['page_title'] = ' Edit Glossary';
			$data['form_action'] ='admin/add_glossary/'.$id;
			$row = $model->asObject()->where(array('id'=>$id))->first();
		
			$data['alphabet'] =  $row->alphabet;  
			$data['keyword'] = $row->keyword;
			$data['description'] = $row->description;
			$data['status'] = $row->status;
			$data['metaTitle'] = $row->metaTitle;
			$data['metaKeyword'] = $row->metaKeyword;
			$data['metaDescription'] = $row->metaDescription;


			$rules = [
				'alphabet' =>'required',
				'keyword' => 'required',
				'description' => 'required'
			]; 	 
		// 	$data['featureList'] = $this->AdminModel->all_fetch('service_feature',array('service_id'=>$row->id)); 
		// 	$data['feeList'] = $this->AdminModel->all_fetch('solution_fee',array('solution_id'=>$row->id)); 

				
			}else{
			
			$data['page_title'] = ' Add Glossary';
			$data['form_action'] ='admin/add_glossary';
			$data['alphabet'] =  '';     
			$data['keyword'] =  ''; 
			$data['description'] =  ''; 
			$data['status'] =  ''; 
			$data['metaTitle'] =  ''; 
			$data['metaKeyword'] =  ''; 
			$data['metaDescription'] =  ''; 



		// 	$data['featureList'] = array();
		// 	$data['feeList'] = array();
			$rules = [
				'alphabet' =>'required',
				'keyword' => 'required|is_unique[glossary.keyword]',
				'description' => 'required'
			]; 	 
			

			}


			if ($this->request->getMethod()=='post') {

			
				
			if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
			} else{
			
			$save= array();
			$save['alphabet'] = $this->request->getVar('alphabet');
			$save['keyword'] = $this->request->getVar('keyword');
			$save['description'] = $this->request->getVar('description');
			$save['status'] = $this->request->getVar('status');
			$save['metaTitle'] = $this->request->getVar('metaTitle');
			$save['metaKeyword'] = $this->request->getVar('metaKeyword');
			$save['metaDescription'] = $this->request->getVar('metaDescription');





		// 	if (!empty($this->request->getVar('slug'))) {
		// 	   $save['info']['slug'] = sfu($this->request->getVar('slug'));
		// 	}else{
		// 	   $save['info']['slug'] = sfu($this->request->getVar('name'));
		// 	}

			
			
		// 	 if(!empty($_FILES['thumbnail']['name'])){
		// 			$file = $this->request->getFile('thumbnail');
		// 			if($file->isValid() && !$file->hasMoved()){
		// 				$file_name = $file->getRandomName();
		// 				if($file->move('uploads/product/', $file_name)){
		// 					$save['info']['thumbnail'] =  'uploads/product/'.$file_name;
		// 				}
		// 			}else{
		// 				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
		// 				exit;
		// 			}
		// 		}

		// 	   if(!empty($_FILES['image']['name'])){
		// 			$file = $this->request->getFile('image');
		// 			if($file->isValid() && !$file->hasMoved()){
		// 				$file_name = $file->getRandomName();
		// 				if($file->move('uploads/product/', $file_name)){
		// 					$save['info']['image'] =  'uploads/product/'.$file_name;
		// 				}
		// 			}else{
		// 				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
		// 				exit;
		// 			}
		// 		}


		//       $uploadImgData = array();
		// 	  if ($this->request->getFileMultiple('images')) {
		// 		foreach($this->request->getFileMultiple('images') as $key => $file)
		// 	   {  
		// 		   if($file->isValid() && !$file->hasMoved()){
		// 		   $file_name = $file->getRandomName();
		// 		   if($file->move('uploads/product/', $file_name)){
		// 			   $uploadImgData[$key] = 'uploads/product/'.$file_name;
		// 		   }	 
		// 		 }
		// 	   }
		//      }
						
				
		// 	$save['images'] = $uploadImgData;
		// 	$save['old_image'] = $this->request->getVar('old_image');

		// 	$save['title'] = $this->request->getVar('title'); 
		// 	$save['featureDescription'] = $this->request->getVar('featureDescription'); 
		// 	$save['feature_sort_order'] = $this->request->getVar('feature_sort_order'); 
		// $save['feature_slug'] = $this->request->getVar('feature_slug');




		// 	$save['area'] = $this->request->getVar('area'); 
		// 	$save['price'] = $this->request->getVar('price'); 
		//     $save['arrival'] = $this->request->getVar('arrival'); 



			if ($id) {
			$save['id'] = $id;
			$result = $model->save($save);
			if ($result) {
				$this->session->setFlashdata('success','Record Update successfully');
				return redirect()->to('admin/add_glossary/'.$id);
			}else{
				$this->session->setFlashdata('error','Error in Update ');
				return redirect()->to('admin/add_glossary/'.$id);
			}
			}else{
			//  $save['id'] = '';
			$result = $model->save($save);
			if ($result) {
				$this->session->setFlashdata('success','Record Insert successfully');
				return redirect()->to('admin/glossary');
			}else{
				$this->session->setFlashdata('success','Record not inserted');
				return redirect()->to('admin/add_glossary');
			}
			}

		}

		}
		echo view('admin/product/add_glossary',$data);

	}

	function delete_glossary(){

		$model = new GlossaryModel();
		if ($this->request->getVar()) {
			$id = $this->request->getVar('selected');
			
			if ($id) {
				foreach ($id as $key => $value) {
				$model->delete(array('id'=>$value));
				$this->AdminModel->deleteData('glossary',array('id'=>$value));
				// $this->AdminModel->deleteData('solution_fee',array('solution_id'=>$value));
				}     
				$this->session->setFlashdata('success','Record Delete successfully'); 
			}else{
			$this->session->setFlashdata('error','');
			}
			
		}
		
		return redirect()->to('admin/glossary');
	}


/////////////////////////////////// Code End by KD



function category(){
	
	$model = new ProductCategoryModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Category List';

	   $query = array();
	    $like = array();
	    if(!empty($_GET['type'])){
	        $query['type'] = $_GET['type'];
	    }

	   if(!empty($_GET['name'])){
	        $like['name'] = $_GET['name']; 
	    }

	    if (empty($query) && empty($like) ) {
	    	$query['parent'] = 0;
	    }

	
	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->where($query)->like($like)->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end
	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/product/category',$data);

}



	function add_category($id=false)
	 {
	 	 

		$model = new ProductCategoryModel();
		$data['categoryList'] = $model->asObject()->where('parent',0)->findAll();
		$data['layoutList']	=	array('only_sub_category'=>'Sub Category without industry Serve','with_subcategory'=>'Sub Category with industry Serve','only_product'=>'Only Product List');

		$IndustryModel = new IndustryModel();
        $data['industryList'] = $IndustryModel->asObject()->where('status',1)->orderBy('id','asc')->findAll();

 
	  if(!empty($id)) {
		
		$data['page_title'] = ' Edit Category';
		$data['form_action'] ='admin/add_category/'.$id;
		$row = $model->asObject()->where(array('id'=>$id))->first();
	
		$data['name'] =  $row->name; 
		$data['shortDescription'] =  $row->shortDescription;    
		$data['description'] =  $row->description;   
		$data['image'] = $row->image; 
		$data['sortOrder'] = $row->sortOrder; 
		$data['status'] = $row->status; 
		$data['slug'] = $row->slug; 

		$data['metaTitle'] = $row->metaTitle; 
		$data['metaKeyword'] = $row->metaKeyword; 
		$data['metaDescription'] = $row->metaDescription; 
		$data['parent'] = $row->parent;
		$data['layout'] = $row->layout;
		$data['bottomImage'] = $row->bottomImage;
		$data['industry'] = json_decode($row->industry);
		$data['standardList'] = $this->AdminModel->all_fetch('category_standard',array('category_id'=>$row->id));
		}else{
		
		$data['page_title'] = ' Add Category';
		$data['form_action'] ='admin/add_category';

		$data['name'] = '';  
		$data['shortDescription'] = '';    
		$data['description'] = '';     
		$data['image'] = ''; 
		$data['sortOrder'] = ''; 
		$data['status'] = ''; 
		$data['slug'] = ''; 

		$data['metaTitle'] =''; 
		$data['metaKeyword'] = ''; 
		$data['metaDescription'] = ''; 
		$data['parent'] = ''; 
		$data['layout'] = ''; 
		$data['bottomImage'] = '';
		$data['industry'] = array();
		 $data['standardList'] =array();
		}


		if($this->request->getMethod()=='post'){
		    
			$rules = [
				'name'=>'trim'
			];
		
		 if ($this->validate($rules)==false) {
				$data['validation'] = $this->validator;
		  } else{
			
		$save= array();
	    $save['info']['name'] = $this->request->getVar('name'); 
		$save['info']['shortDescription'] =  $this->request->getVar('shortDescription');    
		$save['info']['description'] =  $this->request->getVar('description');     
		$save['info']['sortOrder'] =  $this->request->getVar('sortOrder'); 
		$save['info']['status'] =  $this->request->getVar('status'); 
		$save['info']['layout'] =  trim($this->request->getVar('layout')); 

		$save['info']['industry'] = json_encode($this->request->getVar('industry'));

		if (!empty($this->request->getVar('slug'))) {
			$save['info']['slug'] =  sfu($this->request->getVar('slug'));
		}else{
			$save['info']['slug'] =  sfu($this->request->getVar('name'));
		}

	   	$save['info']['metaTitle'] =  $this->request->getVar('metaTitle'); 
	   	$save['info']['metaKeyword'] =  $this->request->getVar('metaKeyword');  
	   	$save['info']['metaDescription'] =  $this->request->getVar('metaDescription'); 
	   	$save['info']['parent'] =  $this->request->getVar('parent'); 


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


// feature
  //     $uploadImgData = array();
	 //  if ($this->request->getFileMultiple('featureImages')) {
		// foreach($this->request->getFileMultiple('featureImages') as $key => $file)
	 //   {  
		//    if($file->isValid() && !$file->hasMoved()){
		//    $file_name = $file->getRandomName();
		//    if($file->move('uploads/product/', $file_name)){
		// 	   $uploadImgData[$key] = 'uploads/product/'.$file_name;
		//    }	 
		//  }
	 //   }
  //    }
                 
        
	// $save['featureImages'] = $uploadImgData;
	// $save['feature_old_image'] = $this->request->getVar('feature_old_image');
	$save['featureTitle'] = $this->request->getVar('featureTitle'); 
	$save['featureDescription'] = $this->request->getVar('featureDescription'); 
	$save['featureSortOrder'] = $this->request->getVar('featureSortOrder'); 



		  if ($id) {
		  	  $save['id'] = $id;
			  // $save['modify_date'] = date('Y-m-d H:i:s');
			  $result=  $model->update(array('id'=>$id),$save['info']);
			  if ($result) {
			  	$model->save_standard($save);
			  $this->session->setFlashdata('success','Record Update successfully');
			  return redirect()->to('admin/add_category/'.$id);
			  }else{
			  $this->session->setFlashdata('error','Record not update');
			  return redirect()->to('admin/add_category/'.$id);
			  }
		  }else{
	
			 // $save['create_date'] = date('Y-m-d H:i:s');
			 // $save['modify_date'] = date('Y-m-d H:i:s');
			 $result=  $model->insert($save['info']);
			  if ($result) {
			  	$save['id'] = $result;
			 	$model->save_standard($save);
			  $this->session->setFlashdata('success','Record insert successfully');
			  return redirect()->to('admin/category');
			  }else{
			  $this->session->setFlashdata('error','Record not insert');
			  return redirect()->to('admin/add_category');
			  }
	
		  }
	
	   }
	 }
	return view('admin/product/add_category',$data);

	}
	

	function delete_category(){
	  if ($this->request->getVar()) {
	  	$model = new ProductCategoryModel();
		  $id = $this->request->getVar('selected');
		 if ($id) {
			foreach($id as $value){
				$model->delete(array('id'=>$value));
				$this->AdminModel->deleteData('category_standard',array('category_id'=>$value));

			   }
		   $this->session->setFlashdata('success','Record Delete successfully');
		 }else{
		  $this->session->setFlashdata('error','');
		 }
		}
	  return redirect()->to('admin/category');
	}

/////////////////




function products(){

	$model = new ProductModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Products List';

	   $query = array();
	    $like = array();
	    if(!empty($_GET['type'])){
	        $query['type'] = $_GET['type'];
	    }

	   if(!empty($_GET['name'])){
	        $like['name'] = $_GET['name']; 
	    }



	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->select('pd.*,sl.name as solution_name')->join('solutions sl','pd.solution=sl.id','left')->where($query)->like($like)->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->where($query)->like($like)->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/product/products',$data);

}
  

 
function add_product($id=false)
 {
 	$solutionModel = new SectorModel();
 	$data['sectorList'] = $solutionModel->asObject()->where('status',1)->findAll();

 	$categogryModel = new ProductCategoryModel();
	$data['categoryList'] = $categogryModel->asObject()->where('parent',0)->findAll();


 	$model = new ProductModel();


 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Product';
    $data['form_action'] ='admin/add_product/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
  
	$data['name'] =  $row->name;   
	$data['shortDescription'] = $row->shortDescription;
	$data['description'] = $row->description;
	$data['category_id'] = $row->category_id;
	$data['metaTitle'] = $row->metaTitle;
	$data['metaKeyword'] = $row->metaKeyword; 
	$data['metaDescription'] = $row->metaDescription;
	$data['status'] = $row->status; 
	$data['feature'] = $row->feature;
	$data['slug'] = $row->slug; 
	$data['image'] = $row->image;
	$data['thumbnail'] = $row->thumbnail; 
	$data['solution'] = $row->solution; 

	$data['featureList'] = $this->AdminModel->all_fetch('product_feature',array('product_id'=>$row->id)); 
	$data['capabilitiesList'] = $this->AdminModel->all_fetch('product_capabilities',array('product_id'=>$row->id)); 
	$data['imagesList'] = $this->AdminModel->all_fetch('product_images',array('product_id'=>$row->id)); 

         
    }else{
    
    $data['page_title'] = ' Add Product';
    $data['form_action'] ='admin/add_product';
    $data['name'] =  '';     
	$data['shortDescription'] =  ''; 
	$data['description'] =  ''; 
	$data['category_id'] =  ''; 
	$data['metaTitle'] =  ''; 
	$data['metaKeyword'] =  '';  
	$data['metaDescription'] =  ''; 
	$data['status'] =  ''; 
	$data['feature'] =  ''; 
	$data['slug'] =  '';  
	$data['image'] = '';
	$data['thumbnail'] = '';
	$data['solution'] = '';
	$data['featureList'] = array();
	$data['capabilitiesList'] = array();
	$data['imagesList'] = array();
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{
    
    $save= array();
    $save['info']['name'] = $this->request->getVar('name');
    $save['info']['shortDescription'] = $this->request->getVar('shortDescription');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['category_id'] = $this->request->getVar('category_id');
    $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
	$save['info']['metaKeyword'] = $this->request->getVar('metaKeyword');
	$save['info']['metaDescription'] = $this->request->getVar('metaDescription');
	$save['info']['status'] = $this->request->getVar('status');


	if (!empty($this->request->getVar('slug'))) {
	   $save['info']['slug'] = sfu($this->request->getVar('slug'));
	}else{
	   $save['info']['slug'] = sfu($this->request->getVar('name'));
	}

    
       
	 if(!empty($_FILES['thumbnail']['name'])){
			$file = $this->request->getFile('thumbnail');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$save['info']['thumbnail'] =  'uploads/product/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}

	   if(!empty($_FILES['image']['name'])){
			$file = $this->request->getFile('image');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$save['info']['image'] =  'uploads/product/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}

		// feature
			$uploadImgData = array();
			if ($this->request->getFileMultiple('featureImages')) {
				foreach($this->request->getFileMultiple('featureImages') as $key => $file)
			{  
				if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$uploadImgData[$key] = 'uploads/product/'.$file_name;
				}	 
				}
			}
			}
						
				
			$save['featureImages'] = $uploadImgData;
			$save['feature_old_image'] = $this->request->getVar('feature_old_image');
			$save['featureTitle'] = $this->request->getVar('featureTitle'); 
			$save['featureSortOrder'] = $this->request->getVar('featureSortOrder'); 

		// capabilities   

			$save['capabilitiesTitle'] = $this->request->getVar('capabilitiesTitle'); 
			$save['capabilitiesDescription'] = $this->request->getVar('capabilitiesDescription'); 
			$save['capabilitiesSortOrder'] = $this->request->getVar('capabilitiesSortOrder'); 

		// gallery

		$uploadimagesData = array();
			if ($this->request->getFileMultiple('images')) {
				foreach($this->request->getFileMultiple('images') as $key => $file)
			{  
				if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$uploadimagesData[$key] = 'uploads/product/'.$file_name;
				}	 
				}
			}
			}
						
				
			$save['images'] = $uploadimagesData;
			$save['old_image'] = $this->request->getVar('old_image');
			$save['imageSortOrder'] = $this->request->getVar('imageSortOrder'); 



			if ($id) {
			$save['id'] = $id;
			$result = $model->save_product($save);
			if ($result) {
				$this->session->setFlashdata('success','Record Update successfully');
				return redirect()->to('admin/add_product/'.$id);
			}else{
				$this->session->setFlashdata('error','Error in Update ');
				return redirect()->to('admin/add_product/'.$id);
			}
			}else{
			$save['id'] = '';
			$result = $model->save_product($save);
			if ($result) {
				$this->session->setFlashdata('success','Record Insert successfully');
				return redirect()->to('admin/products');
			}else{
				$this->session->setFlashdata('success','Record not inserted');
				return redirect()->to('admin/add_product');
			}
			}

		}

		}
		echo view('admin/product/add_product',$data);

}

function delete_products(){
	 $model = new ProductModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	$this->AdminModel->deleteData('product_feature',array('product_id'=>$value));
     	$this->AdminModel->deleteData('product_capabilities',array('product_id'=>$value));
     	$this->AdminModel->deleteData('product_images',array('product_id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/products');
}


///////////////////////////////////



// function solutions(){

// 	$model = new SolutionModel();
// 	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
// 	if(empty($permission)){
// 	   return  redirect()->to('admin/permission-denied');
// 	} 
    
// 	  $data['page_title'] = 'All Solution List';

// 	   $query = array();
// 	    $like = array();
// 	    if(!empty($_GET['type'])){
// 	        $query['type'] = $_GET['type'];
// 	    }

// 	   if(!empty($_GET['name'])){
// 	        $like['name'] = $_GET['name']; 
// 	    }


// 	  // pagination
// 		$data['perPage'] = 10;
// 		$data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('id','asc')->paginate($data['perPage']);
// 		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

// 		$data['total'] = $model->where($query)->like($like)->countAllResults();

// 		$data['data'] = $model->paginate($data['perPage']);
// 		$data['pager'] = $model->pager;

// 		$data['pages'] = round($data['total']/$data['perPage']);
// 		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
// 	// end


// 	  $data['config_logo'] = $this->config_logo;
// 	  echo view('admin/product/solutions',$data);

// }
  

 
// function add_solution($id=false)
//  {
 
//  	$model = new SolutionModel();
 
//   if(!empty($id)) {
    
//     $data['page_title'] = ' Edit Solution';
//     $data['form_action'] ='admin/add_solution/'.$id;
//     $row = $model->asObject()->where(array('id'=>$id))->first();
  
// 	$data['name'] =  $row->name;   
// 	$data['shortDescription'] = $row->shortDescription;
// 	$data['description'] = $row->description;
// 	$data['featureHeading'] = $row->featureHeading;
// 	$data['metaTitle'] = $row->metaTitle;
// 	$data['metaKeyword'] = $row->metaKeyword; 
// 	$data['metaDescription'] = $row->metaDescription;
// 	$data['status'] = $row->status; 
// 	$data['feature'] = $row->feature;
// 		$data['offering'] = $row->offering;
// 	$data['slug'] = $row->slug; 
// 	$data['image'] = $row->image;
// 	$data['thumbnail'] = $row->thumbnail; 
// 	$data['productTitle'] = $row->productTitle; 
// 	$data['productDescription'] = $row->productDescription; 
// 	$data['feeTitle'] = $row->feeTitle; 
// 	$data['feeDescription'] = $row->feeDescription; 
// 	$data['securityTitle'] = $row->securityTitle; 
// 	$data['securityDescription'] = $row->securityDescription; 
//     $data['processTitle'] =  $row->processTitle; 
//     $data['processDescription'] =  $row->processDescription; 
// 	$data['keyImage'] = $row->keyImage;
// 	$data['sortOrder'] = $row->sortOrder;
// 	$data['key_sort_order'] = $row->key_sort_order;



// 	$data['featureList'] = $this->AdminModel->all_fetch('solution_feature',array('solution_id'=>$row->id)); 
// 	$data['feeList'] = $this->AdminModel->all_fetch('solution_fee',array('solution_id'=>$row->id)); 

         
//     }else{
    
//     $data['page_title'] = ' Add Solution';
//     $data['form_action'] ='admin/add_solution';
//     $data['name'] =  '';     
// 	$data['shortDescription'] =  ''; 
// 	$data['description'] =  ''; 
// 	$data['featureHeading'] =  ''; 
// 	$data['metaTitle'] =  ''; 
// 	$data['metaKeyword'] =  '';  
// 	$data['metaDescription'] =  ''; 
// 	$data['status'] =  ''; 
// 	$data['feature'] =  ''; 
// 	$data['slug'] =  '';  
// 	$data['image'] = '';
// 	$data['thumbnail'] = '';
// 	$data['productTitle'] =  '';
// 	$data['productDescription'] = '';
// 	$data['feeTitle'] = '';
// 	$data['feeDescription'] = '';
// 	$data['securityTitle'] = '';
// 	$data['securityDescription'] =  '';
//     $data['processTitle'] =  '';
//     $data['processDescription'] =  '';
// 	$data['offering'] =  '';
// 	$data['keyImage'] = '';
// 	$data['sortOrder'] = '';
// 	$data['key_sort_order'] = '';


// 	$data['featureList'] = array();
// 	$data['feeList'] = array();
      

//     }


//     if ($this->request->getMethod()=='post') {

//     $rules = [
//     	'name' =>'required'
//     ]; 	   
        
//     if ($this->validate($rules)==false) {
//         $data['validation'] = $this->validator;
//      } else{
    
//     $save= array();
//     $save['info']['name'] = $this->request->getVar('name');
//     $save['info']['shortDescription'] = $this->request->getVar('shortDescription');
//     $save['info']['description'] = $this->request->getVar('description');
//     $save['info']['featureHeading'] = $this->request->getVar('featureHeading');
//     $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
// 	$save['info']['metaKeyword'] = $this->request->getVar('metaKeyword');
// 	$save['info']['metaDescription'] = $this->request->getVar('metaDescription');
// 	$save['info']['status'] = $this->request->getVar('status');
// 	$save['info']['feature'] = $this->request->getVar('feature');
// 	$save['info']['productTitle'] = $this->request->getVar('productTitle');
// 	$save['info']['productDescription'] = $this->request->getVar('productDescription');
// 	$save['info']['feeTitle'] = $this->request->getVar('feeTitle');
// 	$save['info']['feeDescription'] = $this->request->getVar('feeDescription');
// 	$save['info']['securityTitle'] = $this->request->getVar('securityTitle');
// 	$save['info']['securityDescription'] = $this->request->getVar('securityDescription');
//     $save['info']['processTitle'] = $this->request->getVar('processTitle');
//     $save['info']['processDescription'] = $this->request->getVar('processDescription');
//     $save['info']['offering'] = $this->request->getVar('offering');

//     $save['info']['sortOrder'] = $this->request->getVar('sortOrder');
//     $save['info']['key_sort_order'] = $this->request->getVar('key_sort_order');
    

// 	if (!empty($this->request->getVar('slug'))) {
// 	   $save['info']['slug'] = sfu($this->request->getVar('slug'));
// 	}else{
// 	   $save['info']['slug'] = sfu($this->request->getVar('name'));
// 	}

//     	 if(!empty($_FILES['keyImage']['name'])){
// 			$file = $this->request->getFile('keyImage');
// 			if($file->isValid() && !$file->hasMoved()){
// 				$file_name = $file->getRandomName();
// 				if($file->move('uploads/product/', $file_name)){
// 					$save['info']['keyImage'] =  'uploads/product/'.$file_name;
// 				}
// 			}else{
// 				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
// 				exit;
// 			}
// 		}

       
// 	 if(!empty($_FILES['thumbnail']['name'])){
// 			$file = $this->request->getFile('thumbnail');
// 			if($file->isValid() && !$file->hasMoved()){
// 				$file_name = $file->getRandomName();
// 				if($file->move('uploads/product/', $file_name)){
// 					$save['info']['thumbnail'] =  'uploads/product/'.$file_name;
// 				}
// 			}else{
// 				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
// 				exit;
// 			}
// 		}

// 	   if(!empty($_FILES['image']['name'])){
// 			$file = $this->request->getFile('image');
// 			if($file->isValid() && !$file->hasMoved()){
// 				$file_name = $file->getRandomName();
// 				if($file->move('uploads/product/', $file_name)){
// 					$save['info']['image'] =  'uploads/product/'.$file_name;
// 				}
// 			}else{
// 				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
// 				exit;
// 			}
// 		}


//       $uploadImgData = array();
// 	  if ($this->request->getFileMultiple('images')) {
// 		foreach($this->request->getFileMultiple('images') as $key => $file)
// 	   {  
// 		   if($file->isValid() && !$file->hasMoved()){
// 		   $file_name = $file->getRandomName();
// 		   if($file->move('uploads/product/', $file_name)){
// 			   $uploadImgData[$key] = 'uploads/product/'.$file_name;
// 		   }	 
// 		 }
// 	   }
//      }
                 
        
// 	$save['images'] = $uploadImgData;
// 	$save['old_image'] = $this->request->getVar('old_image');

// 	$save['title'] = $this->request->getVar('title'); 
// 	$save['featureDescription'] = $this->request->getVar('featureDescription'); 
// 	$save['feature_sort_order'] = $this->request->getVar('feature_sort_order'); 

// 	$save['feature_slug'] = $this->request->getVar('feature_slug');

// 	$save['area'] = $this->request->getVar('area'); 
// 	$save['price'] = $this->request->getVar('price'); 
//     $save['arrival'] = $this->request->getVar('arrival'); 



//     if ($id) {
//     $save['id'] = $id;
//     $result = $model->save_solution($save);
//       if ($result) {
//         $this->session->setFlashdata('success','Record Update successfully');
//         return redirect()->to('admin/add_solution/'.$id);
//       }else{
//         $this->session->setFlashdata('error','Error in Update ');
//         return redirect()->to('admin/add_solution/'.$id);
//       }
//     }else{
//      $save['id'] = '';
//       $result = $model->save_solution($save);
//       if ($result) {
//         $this->session->setFlashdata('success','Record Insert successfully');
//         return redirect()->to('admin/solutions');
//       }else{
//         $this->session->setFlashdata('success','Record not inserted');
//          return redirect()->to('admin/add_solution');
//       }
//     }

//   }

//   }
//  echo view('admin/product/add_solution',$data);

// }

// function delete_solutions(){
// 	 $model = new SolutionModel();
//   if ($this->request->getVar()) {
//       $id = $this->request->getVar('selected');
      
//      if ($id) {
//      	foreach ($id as $key => $value) {
//      	$model->delete(array('id'=>$value));
//      	$this->AdminModel->deleteData('solution_feature',array('solution_id'=>$value));
//      	$this->AdminModel->deleteData('solution_fee',array('solution_id'=>$value));
//      	}     
//      	$this->session->setFlashdata('success','Record Delete successfully'); 
//      }else{
//       $this->session->setFlashdata('error','');
//      }
     
//     }
     
//   return redirect()->to('admin/solutions');
// }



// Solution By KD

function solutions_test(){

    $model = new SolutionModel();
    $permission = $this->AdminModel->permission($this->uri->getSegment(2));
    if (empty($permission)) {
        return redirect()->to('admin/permission-denied');
    }

    $data['page_title'] = 'All Solution List';

    $query = [];
    $like = [];
    if (!empty($_GET['type'])) {
        $query['type'] = $_GET['type'];
    }

    if (!empty($_GET['name'])) {
        $like['name'] = $_GET['name'];
    }

    // Pagination
    $data['perPage'] = 10;
    $data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('id', 'asc')->paginate($data['perPage']);
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

    $data['total'] = $model->where($query)->like($like)->countAllResults();

    $data['data'] = $model->paginate($data['perPage']);
    $data['pager'] = $model->pager;

    $data['pages'] = round($data['total'] / $data['perPage']);
    $data['offset'] = $data['page'] <= 1 ? 0 : $data['page'] * $data['perPage'] - $data['perPage'];
    // End Pagination

    // // Fetch additional pointers and Q&A for each solution
    // foreach ($data['detail'] as $key => $solution) {
    //     $solution->pointers = $model->getPointersBySolutionId($solution->id);
    //     $solution->questions = $model->getQnABySolutionId($solution->id);
    // }
    
    $data['config_logo'] = $this->config_logo;
    echo view('admin/product/solutions_test', $data);

}
  

 
function add_solution_test($id = false)
{
    $model = new SolutionModel();
    
    
    $data['blogCategoryList'] = $this->AdminModel->all_fetch('blog_category',array('status'=>1),'sort_order','asc');
    $data['typeList'] = [
        'BLOG' => 'BLOG',
        'CASE_STUDY' => 'CASE STUDY',
        'EBOOK' => 'EBOOK',
        'WHITEPAPER' => 'WHITEPAPER',
        'DEMAND' => 'DEMAND',
        'EVENTS' => 'EVENTS',
        'TECH' => 'TECH',
        'FIREWALL' => 'FIREWALL'
    ];
    if (!empty($id)) {
        $data['page_title'] = 'Edit Solution';
        $data['form_action'] = 'admin/add_solution_test/' . $id;
        $row = $model->asObject()->where(['id' => $id])->first();

        $data['name'] = $row->name;
        $data['shortDescription'] = $row->shortDescription;
        $data['description'] = $row->description;
        $data['featureHeading'] = $row->featureHeading;
        $data['metaTitle'] = $row->metaTitle;
        $data['metaKeyword'] = $row->metaKeyword;
        $data['metaDescription'] = $row->metaDescription;
        $data['status'] = $row->status;
        $data['feature'] = $row->feature;
        $data['offering'] = $row->offering;
        $data['category'] = $row->blog_catId;
        $data['adv_blogId'] = $row->adv_blogId;
        $data['cs_blogId'] = $row->cs_blogId;
        $data['slug'] = $row->slug;
        $data['image'] = $row->image;
        $data['image_alt'] = $row->image_alt;
        $data['thumbnail'] = $row->thumbnail;
        $data['productTitle'] = $row->productTitle;
        $data['productDescription'] = $row->productDescription;
        $data['feeTitle'] = $row->feeTitle;
        $data['feeDescription'] = $row->feeDescription;
        $data['securityTitle'] = $row->securityTitle;
        $data['securityDescription'] = $row->securityDescription;
        $data['processTitle'] = $row->processTitle;
        $data['processDescription'] = $row->processDescription;
        $data['keyImage'] = $row->keyImage;
        $data['sortOrder'] = $row->sortOrder;
        $data['key_sort_order'] = $row->key_sort_order;

        // $data['featureList'] = $this->AdminModel->all_fetch('features_new', ['solution_id' => $row->id]);
        $data['featureList'] = $model->get_features_with_details($row->id);
        // echo "<pre>";print_r($data['featureList']);die;
        
        $data['feeList'] = $this->AdminModel->all_fetch('solution_fee', ['solution_id' => $row->id]);
    } else {
        $data['page_title'] = 'Add Solution';
        $data['form_action'] = 'admin/add_solution_test';
        $data['name'] = '';
        $data['shortDescription'] = '';
        $data['description'] = '';
        $data['featureHeading'] = '';
        $data['metaTitle'] = '';
        $data['metaKeyword'] = '';
        $data['metaDescription'] = '';
        $data['status'] = '';
        $data['feature'] = '';
        $data['slug'] = '';
        $data['image'] = '';
        $data['image_alt'] = '';
        $data['thumbnail'] = '';
        $data['productTitle'] = '';
        $data['productDescription'] = '';
        $data['feeTitle'] = '';
        $data['feeDescription'] = '';
        $data['securityTitle'] = '';
        $data['securityDescription'] = '';
        $data['processTitle'] = '';
        $data['processDescription'] = '';
        $data['offering'] = '';
        $data['category'] = '';
        $data['adv_blogId'] = '';
        $data['cs_blogId'] = '';
        $data['keyImage'] = '';
        $data['sortOrder'] = '';
        $data['key_sort_order'] = '';
        
        $data['featureList'] = array();
        $data['feeList'] = array();
    }

    if ($this->request->getMethod() == 'post') {
        
        $rules = [
            'name' => 'required'
        ];

        if ($this->validate($rules) == false) {
            $data['validation'] = $this->validator;
        } else {
            $save = [];
            $save['info']['name'] = $this->request->getVar('name');
            $save['info']['shortDescription'] = $this->request->getVar('shortDescription');
            $save['info']['description'] = $this->request->getVar('description');
            $save['info']['featureHeading'] = $this->request->getVar('featureHeading');
            $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
            $save['info']['image_alt'] = $this->request->getVar('image_alt');
            $save['info']['metaKeyword'] = $this->request->getVar('metaKeyword');
            $save['info']['metaDescription'] = $this->request->getVar('metaDescription');
            $save['info']['status'] = $this->request->getVar('status');
            $save['info']['feature'] = $this->request->getVar('feature');
            $save['info']['productTitle'] = $this->request->getVar('productTitle');
            $save['info']['productDescription'] = $this->request->getVar('productDescription');
            $save['info']['feeTitle'] = $this->request->getVar('feeTitle');
            $save['info']['feeDescription'] = $this->request->getVar('feeDescription');
            $save['info']['securityTitle'] = $this->request->getVar('securityTitle');
            $save['info']['securityDescription'] = $this->request->getVar('securityDescription');
            $save['info']['processTitle'] = $this->request->getVar('processTitle');
            $save['info']['processDescription'] = $this->request->getVar('processDescription');
            $save['info']['offering'] = $this->request->getVar('offering');
            $save['info']['blog_catId'] = $this->request->getVar('blog_catId');
            $save['info']['adv_blogId'] = $this->request->getVar('adv_blogId') ? $this->request->getVar('adv_blogId') :$row->adv_blogId;
            $save['info']['cs_blogId'] = $this->request->getVar('cs_blogId') ? $this->request->getVar('cs_blogId') :$row->cs_blogId;
            $save['info']['sortOrder'] = $this->request->getVar('sortOrder');
            $save['info']['key_sort_order'] = $this->request->getVar('key_sort_order');

            if (!empty($this->request->getVar('slug'))) {
                $save['info']['slug'] = sfu($this->request->getVar('slug'));
            } else {
                $save['info']['slug'] = sfu($this->request->getVar('name'));
            }

            // Handle file uploads
            if(!empty($_FILES['keyImage']['name'])){
                $save['info']['keyImage'] = $this->uploadFile('keyImage');
            }
            if(!empty($_FILES['thumbnail']['name'])){
                $save['info']['thumbnail'] = $this->uploadFile('thumbnail');
            }
            if(!empty($_FILES['image']['name'])){
                $save['info']['image'] = $this->uploadFile('image');
            }
            // $save['images'] = $this->uploadMultipleFiles('images');
            // echo "<pre>";print_r($save);
            // Save feature data
            $featureData = $this->prepareFeatureData($this->request->getVar());
            // print_r($featureData);die;
            if ($id) {
                $save['id'] = $id;
                $result = $model->save_solution($save, $featureData);
                if ($result) {
                    $this->session->setFlashdata('success', 'Record updated successfully');
                    return redirect()->to('admin/add_solution_test/' . $id);
                } else {
                    $this->session->setFlashdata('error', 'Error in update');
                    return redirect()->to('admin/add_solution_test/' . $id);
                }
            } else {
                $save['id'] = '';
                $result = $model->save_solution($save, $featureData);
                if ($result) {
                    $this->session->setFlashdata('success', 'Record inserted successfully');
                    return redirect()->to('admin/solutions_test');
                } else {
                    $this->session->setFlashdata('error', 'Record not inserted');
                    return redirect()->to('admin/add_solution_test');
                }
            }
        }
    }
    
    echo view('admin/product/add_solution_test', $data);
}

private function uploadFile($fieldName)
{

    $file = $this->request->getFile($fieldName);
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        if ($file->move('uploads/product/', $fileName)) {
            return 'uploads/product/' . $fileName;
        }
    }


    return null;
}

private function uploadMultipleFiles($fieldName)
{
    $uploadImgData = [];
    if ($this->request->getFileMultiple($fieldName)) {
        foreach ($this->request->getFileMultiple($fieldName) as $key => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                if ($file->move('uploads/product/', $fileName)) {
                    $uploadImgData[$key] = 'uploads/product/' . $fileName;
                }
            }
        }
    }
    return $uploadImgData;
}

private function prepareFeatureData($postData)
{
    $featureData = [];
    $thumbnail = $this->uploadMultipleFiles('featuredThumb');
    $banner = $this->uploadMultipleFiles('featuredBanner');
    $sids=0;
    if (!empty($postData['title'])) {
        foreach ($postData['title'] as $key => $title) {
            if(!empty($postData['keyid'])){
                $sids = $postData['keyid'][$key];
            }else{
                $sids = $key;
            }
            if (!empty($postData['feature_slug'][$key])) {
                $slugged = sfu($postData['feature_slug'][$key]);
            } else {
                $slugged = sfu($title);
            }
            
            $featureData[] = [
                'title' => $title,
                'thumbnail' => @$thumbnail[$key],
                'old_thumbnail' => @$postData['old_featuredThumb'][$key],
                'thumb_alt' => $postData['thumb_alt'][$key],
                'banner' => @$banner[$key],
                'old_banner' => @$postData['old_featuredBanner'][$key],
                'banner_alt' => $postData['banner_alt'][$key],
                'short_description' => $postData['short_description'][$key],
                'header_question' => $postData['headerQue'][$key],
                'header_answer' => $postData['headerAns'][$key],
                'feature_description' => $postData['featureDescription'][$key],
                'slug' => $slugged,
                'sort_order' => $postData['feature_sort_order'][$key],
                'metaTitle' => $postData['meta_title'][$key],
                'metaKeyword' => $postData['meta_keyword'][$key],
                'metaDescription' => $postData['meta_description'][$key],
                'status' => $postData['featureStatus'][$key],
                'pointers' => $this->preparePointers($postData, $sids),
                'questions' => $this->prepareQuestions($postData, $sids)
            ];
            
            // if(!empty($thumbnail[$key])){
            //     $featureData['thumbnail'] = $thumbnail[$key];
            // }
            // if(!empty($banner[$key])){
            //     $featureData['thumbnail'] = $thumbnail[$key];
            // }
        }
        // echo "<pre>";print_r($featureData);die;
        
    }
    return $featureData;
}


private function preparePointers($postData, $key){
    $pointers = [];
    if (!empty($postData['featurePointers'][$key])) {
        foreach ($postData['featurePointers'][$key] as $qKey => $points) {
            $pointers[] = [
                'pointers' => $points,
            ];
        }
    }
    
    return json_encode($pointers);
}


private function prepareQuestions($postData, $key)
{
    $questions = [];
    if (!empty($postData['feature_que'][$key])) {
        foreach ($postData['feature_que'][$key] as $qKey => $question) {
            $questions[] = [
                'question' => $question,
                'answer' => $postData['feature_ans'][$key][$qKey]
            ];
        }
    }
    // Convert the questions array to a string
    // $questionsString = implode('; ', array_map(function($q) {
    //     return $q['question'] . '|' . $q['answer'];
    // }, $questions));
    // print_r($questions);die;
    return json_encode($questions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}


function delete_solutions_test(){
	 $model = new SolutionModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
    //  	$model->delete(array('id'=>$value));
            $model->delete_solution($value);
     	
    //  	$this->AdminModel->deleteData('features_new',array('solution_id'=>$value));
    //  	$this->AdminModel->deleteData('solution_fee',array('solution_id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/solutions_test');
}



////////////////////////////////////

////////////////////////////////////

function what_is(){
        $model = new WhatisModel();
        $permission = $this->AdminModel->permission($this->uri->getSegment(2));
        
        if (empty($permission)) {
            return redirect()->to('admin/permission-denied');
        }

        $data['page_title'] = 'All What Is List';
        
        // Initialize query and like arrays for filtering
        $query = [];
        $like = [];

        // Check for filters in GET parameters
        if (!empty($_GET['name'])) {
            $like['name'] = $_GET['name'];
        }

        // Pagination setup
        $data['perPage'] = 10; // Number of records per page
        $data['detail'] = $model->asObject()->like($like)->orderBy('id', 'asc')->paginate($data['perPage']);
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

        // Total records for pagination
        $data['total'] = $model->like($like)->countAllResults();
        $data['pager'] = $model->pager;

        // Calculate total pages and offset
        $data['pages'] = round($data['total'] / $data['perPage']);
        $data['offset'] = $data['page'] <= 1 ? 0 : $data['page'] * $data['perPage'] - $data['perPage'];

        $data['config_logo'] = $this->config_logo;
        echo view('admin/product/whatis', $data);
}


function add_whatis($id = false)
{
    $model = new WhatisModel();
    
    
    $data['blogCategoryList'] = $this->AdminModel->all_fetch('whatis_cat',array('status'=>1),'sort_order','asc');
    $data['authorList'] = $this->AdminModel->all_fetch('author',null);
    if (!empty($id)) {
        $data['page_title'] = 'Edit Solution';
        $data['form_action'] = 'admin/add_whatis/' . $id;
        $row = $model->asObject()->where(['id' => $id])->first();

        $data['name'] = $row->name;
        $data['shortDescription'] = $row->short_description;
        $data['description'] = $row->description;
        $data['metaTitle'] = $row->metaTitle;
        $data['metaKeyword'] = $row->metaKeyword;
        $data['metaDescription'] = $row->metaDescription;
        $data['status'] = $row->status;
        $data['banner'] = $row->banner;
        $data['banner_alt_tag'] = $row->banner_alt_tag;
        $data['thumbnail'] = $row->thumbnail;
        $data['thumb_alt_tag'] = $row->thumb_alt_tag;
        $data['category'] = $row->category;
        $data['author'] = $row->author;
        $data['slug'] = $row->slug;
        $data['editor_picks'] = $row->editor_picks;
        $data['top_resources'] = $row->top_resources;
        $data['trending_insights'] = $row->trending_insights;
        $data['sortOrder'] = $row->sort_order;
        $data['publish'] = $row->publish_date;

        $data['faqList'] = $this->AdminModel->get_faq($row->id);
        // echo "<pre>";print_r($data['faqList']);die;
    } else {
        $data['page_title'] = 'Add What is';
        $data['form_action'] = 'admin/add_whatis';
        $data['name'] = '';
        $data['shortDescription'] = '';
        $data['description'] = '';
        $data['metaTitle'] = '';
        $data['metaKeyword'] = '';
        $data['metaDescription'] = '';
        $data['status'] = '';
        $data['banner'] = '';
        $data['banner_alt_tag'] = '';
        $data['thumbnail'] = '';
        $data['thumb_alt_tag'] = '';
        $data['category'] = '';
        $data['author'] = '';
        $data['slug'] = '';
        $data['editor_picks'] = '';
        $data['top_resources'] = '';
        $data['trending_insights'] = '';
        $data['sortOrder'] = '';
        $data['publish'] = '';
        
        $data['faqList'] = array();
    }

    if ($this->request->getMethod() == 'post') {
        
        $rules = [
            'name' => 'required'
        ];

        if ($this->validate($rules) == false) {
            $data['validation'] = $this->validator;
        } else {
            $save = [];
            $save['info']['name'] = $this->request->getVar('name');
            $save['info']['short_description'] = $this->request->getVar('shortDescription');
            $save['info']['description'] = $this->request->getVar('description');
            $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
            $save['info']['metaKeyword'] = $this->request->getVar('metaKeyword');
            $save['info']['metaDescription'] = $this->request->getVar('metaDescription');
            $save['info']['status'] = $this->request->getVar('status');
            
            $save['info']['banner_alt_tag'] = $this->request->getVar('banner_alt_tag');
            
            $save['info']['thumb_alt_tag'] = $this->request->getVar('thumb_alt_tag');
            $selectCat = $this->request->getVar('category');
    		if (is_array($selectCat)) {
                $selection = implode(',', $selectCat);
            }
    		
            $save['info']['category'] = $selection;
            $save['info']['author'] = $this->request->getVar('author');
            $save['info']['slug'] = $this->request->getVar('slug');
            $save['info']['editor_picks'] = $this->request->getVar('editor_picks');
            $save['info']['top_resources'] = $this->request->getVar('top_resources');
            $save['info']['trending_insights'] = $this->request->getVar('trending_insights');
            $save['info']['sort_order'] = $this->request->getVar('sortOrder');
            $save['info']['publish_date'] = $this->request->getVar('publish');

            if (!empty($this->request->getVar('slug'))) {
                $save['info']['slug'] = sfu($this->request->getVar('slug'));
            } else {
                $save['info']['slug'] = sfu($this->request->getVar('name'));
            }
            
            if (!$id) {
                $save['info']['thumbnail'] = $this->request->getVar('thumbnail'); // or leave empty
                $save['info']['banner'] = $this->request->getVar('banner'); // or leave empty
            }
            // Handle file uploads
            if(!empty($_FILES['thumbnail']['name'])){
                $save['info']['thumbnail'] = $this->uploadFile('thumbnail');
            }
            if(!empty($_FILES['banner']['name'])){
                $save['info']['banner'] = $this->uploadFile('banner');
            }
            // $save['images'] = $this->uploadMultipleFiles('images');
            // echo "<pre>";print_r($save);
            // Save feature data
            $faqData = json_encode($this->prepareFaqData($this->request->getVar()), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            // print_r($featureData);die;
            if ($id) {
                $save['id'] = $id;
                $result = $model->save_whatis($save, $faqData);
                if ($result) {
                    $this->session->setFlashdata('success', 'Record updated successfully');
                    return redirect()->to('admin/add_whatis/' . $id);
                } else {
                    $this->session->setFlashdata('error', 'Error in update');
                    return redirect()->to('admin/add_whatis/' . $id);
                }
            } else {
                $save['id'] = '';
                $result = $model->save_whatis($save, $faqData);
                if ($result) {
                    $this->session->setFlashdata('success', 'Record inserted successfully');
                    return redirect()->to('admin/whatis');
                } else {
                    $this->session->setFlashdata('error', 'Record not inserted');
                    return redirect()->to('admin/add_whatis');
                }
            }
        }
    }
    
    echo view('admin/product/add_whatis', $data);
}


private function prepareFaqData($postData)
{
    $questions = [];
    if (!empty($postData['faq_question'])) {
        foreach ($postData['faq_question'] as $key => $question) {
            if (trim($question) !== '') { // Optional: skip empty questions
                $questions[] = [
                    'question'   => $question,
                    'answer'     => $postData['faq_answer'][$key] ?? '',
                    'sort_order' => $postData['faq_sort_order'][$key] ?? 0
                ];
            }
        }
    }
    return $questions; // Return array, NOT json
}

// private function prepareFaqData($postData)
// {
//     // echo "<pre>";print_r($postData['feature_que']);die;
//     $questions = [];
//     if (!empty($postData['faq_question'])) {
//         foreach ($postData['faq_question'] as $key => $question) {
//             $questions[] = [
//                 'question' => $question,
//                 'answer' => $postData['faq_answer'][$key],
//                 'sort_order' => $postData['faq_sort_order'][$key]
//             ];
//         }
//     }
//     // Convert the questions array to a string
//     // $questionsString = implode('; ', array_map(function($q) {
//     //     return $q['question'] . '|' . $q['answer'];
//     // }, $questions));
//     // print_r($questions);die;
//     return json_encode($questions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
// }





function delete_whatis(){
	 $model = new WhatisModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
    //  	$model->delete(array('id'=>$value));
            $model->delete_whatis($value);
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/whatis');
}
///////////////////////////////////


  function sectors(){

	$model = new SectorModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Sectors List';
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
	  echo view('admin/product/sectors',$data);

}
  
 

function add_sector($id=false)
 {

 	$model = new SectorModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Sector';
    $data['form_action'] ='admin/add_sector/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
    $data['name'] =  $row->name;   
    $data['image'] = $row->image;
	$data['status'] = $row->status; 

         
    }else{
    
    $data['page_title'] = ' Add Sector';
    $data['form_action'] ='admin/add_sector';
    $data['name'] =  '';    
    $data['image'] =  ''; 
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
          return redirect()->to('admin/add_sector/'.$id);
          }else{
          $this->session->setFlashdata('error','Record not update');
          return redirect()->to('admin/add_sector/'.$id);
          }
      }else{

         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $model->insert($save);
          if ($result) {
         
          $this->session->setFlashdata('success','Record insert successfully');
          return redirect()->to('admin/sectors');
          }else{
          $this->session->setFlashdata('error','Record not insert');
          return redirect()->to('admin/add_sector');
          }

      }

  }

  }
 echo view('admin/product/add_sector',$data);

}

function delete_sectors(){
	 $model = new SectorModel();
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
     
  return redirect()->to('admin/sectors');
}

///////////////////////////////////



function services(){

	$model = new ServiceModel();
	$permission = $this->AdminModel->permission($this->uri->getSegment(2));
	if(empty($permission)){
	   return  redirect()->to('admin/permission-denied');
	} 
    
	  $data['page_title'] = 'All Service List';

	   $query = array();
	    $like = array();
	    if(!empty($_GET['type'])){
	        $query['type'] = $_GET['type'];
	    }

	   if(!empty($_GET['name'])){
	        $like['name'] = $_GET['name']; 
	    }


	  // pagination
		$data['perPage'] = 10;
		$data['detail'] = $model->asObject()->where($query)->like($like)->orderBy('id','asc')->paginate($data['perPage']);
		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 0;

		$data['total'] = $model->where($query)->like($like)->countAllResults();

		$data['data'] = $model->paginate($data['perPage']);
		$data['pager'] = $model->pager;

		$data['pages'] = round($data['total']/$data['perPage']);
		$data['offset'] = $data['page'] <=1?0:$data['page']*$data['perPage']-$data['perPage'];
	// end


	  $data['config_logo'] = $this->config_logo;
	  echo view('admin/product/services',$data);

}
  

 
function add_service($id=false)
 {
 
 	$model = new ServiceModel();
 
  if(!empty($id)) {
    
    $data['page_title'] = ' Edit Service';
    $data['form_action'] ='admin/add_service/'.$id;
    $row = $model->asObject()->where(array('id'=>$id))->first();
  
	$data['name'] =  $row->name;   
	$data['shortDescription'] = $row->shortDescription;
	$data['description'] = $row->description;
	$data['featureHeading'] = $row->featureHeading;
	$data['metaTitle'] = $row->metaTitle;
	$data['metaKeyword'] = $row->metaKeyword; 
	$data['metaDescription'] = $row->metaDescription;
	$data['status'] = $row->status; 
	$data['feature'] = $row->feature;
	$data['slug'] = $row->slug; 
	$data['image'] = $row->image;
	$data['thumbnail'] = $row->thumbnail; 
	$data['productTitle'] = $row->productTitle; 
	$data['productDescription'] = $row->productDescription; 
	$data['feeTitle'] = $row->feeTitle; 
	$data['feeDescription'] = $row->feeDescription; 
	$data['securityTitle'] = $row->securityTitle; 
	$data['securityDescription'] = $row->securityDescription; 
    $data['processTitle'] =  $row->processTitle; 
    $data['processDescription'] =  $row->processDescription; 
	$data['offering'] = $row->offering;



	$data['featureList'] = $this->AdminModel->all_fetch('service_feature',array('service_id'=>$row->id)); 
	$data['feeList'] = $this->AdminModel->all_fetch('solution_fee',array('solution_id'=>$row->id)); 

         
    }else{
    
    $data['page_title'] = ' Add Service';
    $data['form_action'] ='admin/add_service';
    $data['name'] =  '';     
	$data['shortDescription'] =  ''; 
	$data['description'] =  ''; 
	$data['featureHeading'] =  ''; 
	$data['metaTitle'] =  ''; 
	$data['metaKeyword'] =  '';  
	$data['metaDescription'] =  ''; 
	$data['status'] =  ''; 
	$data['feature'] =  ''; 
	$data['slug'] =  '';  
	$data['image'] = '';
	$data['thumbnail'] = '';
	$data['productTitle'] =  '';
	$data['productDescription'] = '';
	$data['feeTitle'] = '';
	$data['feeDescription'] = '';
	$data['securityTitle'] = '';
	$data['securityDescription'] =  '';
    $data['processTitle'] =  '';
    $data['processDescription'] =  '';
	$data['offering'] ='';



	$data['featureList'] = array();
	$data['feeList'] = array();
      

    }


    if ($this->request->getMethod()=='post') {

    $rules = [
    	'name' =>'required'
    ]; 	   
        
    if ($this->validate($rules)==false) {
        $data['validation'] = $this->validator;
     } else{
    
    $save= array();
    $save['info']['name'] = $this->request->getVar('name');
    $save['info']['shortDescription'] = $this->request->getVar('shortDescription');
    $save['info']['description'] = $this->request->getVar('description');
    $save['info']['featureHeading'] = $this->request->getVar('featureHeading');
    $save['info']['metaTitle'] = $this->request->getVar('metaTitle');
	$save['info']['metaKeyword'] = $this->request->getVar('metaKeyword');
	$save['info']['metaDescription'] = $this->request->getVar('metaDescription');
	$save['info']['status'] = $this->request->getVar('status');
	$save['info']['feature'] = $this->request->getVar('feature');
	$save['info']['productTitle'] = $this->request->getVar('productTitle');
	$save['info']['productDescription'] = $this->request->getVar('productDescription');
	$save['info']['feeTitle'] = $this->request->getVar('feeTitle');
	$save['info']['feeDescription'] = $this->request->getVar('feeDescription');
	$save['info']['securityTitle'] = $this->request->getVar('securityTitle');
	$save['info']['securityDescription'] = $this->request->getVar('securityDescription');
    $save['info']['processTitle'] = $this->request->getVar('processTitle');
    $save['info']['processDescription'] = $this->request->getVar('processDescription');
    $save['info']['offering'] = $this->request->getVar('offering');





	if (!empty($this->request->getVar('slug'))) {
	   $save['info']['slug'] = sfu($this->request->getVar('slug'));
	}else{
	   $save['info']['slug'] = sfu($this->request->getVar('name'));
	}

    
       
	 if(!empty($_FILES['thumbnail']['name'])){
			$file = $this->request->getFile('thumbnail');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$save['info']['thumbnail'] =  'uploads/product/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}

	   if(!empty($_FILES['image']['name'])){
			$file = $this->request->getFile('image');
			if($file->isValid() && !$file->hasMoved()){
				$file_name = $file->getRandomName();
				if($file->move('uploads/product/', $file_name)){
					$save['info']['image'] =  'uploads/product/'.$file_name;
				}
			}else{
				throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
				exit;
			}
		}


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

	$save['title'] = $this->request->getVar('title'); 
	$save['featureDescription'] = $this->request->getVar('featureDescription'); 
	$save['feature_sort_order'] = $this->request->getVar('feature_sort_order'); 
$save['feature_slug'] = $this->request->getVar('feature_slug');




	$save['area'] = $this->request->getVar('area'); 
	$save['price'] = $this->request->getVar('price'); 
    $save['arrival'] = $this->request->getVar('arrival'); 



    if ($id) {
    $save['id'] = $id;
    $result = $model->save_service($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Update successfully');
        return redirect()->to('admin/add_service/'.$id);
      }else{
        $this->session->setFlashdata('error','Error in Update ');
        return redirect()->to('admin/add_service/'.$id);
      }
    }else{
     $save['id'] = '';
      $result = $model->save_service($save);
      if ($result) {
        $this->session->setFlashdata('success','Record Insert successfully');
        return redirect()->to('admin/services');
      }else{
        $this->session->setFlashdata('success','Record not inserted');
         return redirect()->to('admin/add_service');
      }
    }

  }

  }
 echo view('admin/product/add_service',$data);

}

function delete_services(){

	 $model = new ServiceModel();
  if ($this->request->getVar()) {
      $id = $this->request->getVar('selected');
      
     if ($id) {
     	foreach ($id as $key => $value) {
     	$model->delete(array('id'=>$value));
     	$this->AdminModel->deleteData('service_feature',array('service_id'=>$value));
     	// $this->AdminModel->deleteData('solution_fee',array('solution_id'=>$value));
     	}     
     	$this->session->setFlashdata('success','Record Delete successfully'); 
     }else{
      $this->session->setFlashdata('error','');
     }
     
    }
     
  return redirect()->to('admin/services');
}





}
