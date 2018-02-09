<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Users extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_header('HTTP/1.1 200 OK');
		$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
		$this->load->model('Login_m');
	}

	public function index($para1=''){
		if($this->session->userdata('login') == true){
				$this->product();
		}else{
			if ($para1 == 'login') {
				$username = $this->input->post('username');
            	$password = md5($this->input->post('password'));
            	$data = $this->Login_m->user_login_check($username, $password);
            	if ($data) {
            		$id         = $data->id;
                    $username   = $data->username;
                    $this->session->set_userdata(['user_id'=>$id, 'login'=>true, 'username'=>$username]);
                    redirect(base_url('users/product'));
            	}     	
        
            }else{
            	$this->load->view('login/index');
            }
		}		
	}



	public function product($para1='', $para2=''){
		if($this->session->userdata('login') != true){
				redirect(base_url('users'));
		}else{
			if ($para1 == 'list') {
				$prodata['product'] = $this->Login_m->getProData();
				$this->load->view('product/product_list', $prodata);
			}elseif($para1 == 'add'){
				if($this->input->post()){
					$data['name'] = $this->input->post('name');
					$data['category'] = $this->input->post('category');
					$data['sub_category'] = $this->input->post('sub_category');
					$data['price'] = $this->input->post('price');
					$data['shipping'] = $this->input->post('shipping');
					$data['tax'] = $this->input->post('tax');
					$data['timestamp'] = time();

					$config = array();
	                $config['upload_path'] = 'uploads';
	                $config['allowed_types'] = 'gif|jpg|png|jpeg';
	                $config['max_size'] = '100000';
	                $config['encrypt_name'] = true;
	                $this->load->library('upload', $config);
	            
	                if( $this->upload->do_upload('image')){   
	                    $path  = $this->upload->data();
	                    $image = $path['raw_name'].$path['file_ext'];
	                    $data['image'] = $image;
	                         if($path['file_name'] == true){
	                            $pro = $this->Login_m->insertProduct($data);
	                            if($pro){
									echo "Product inserted successfully !!";
								}else{
									echo "string";
								}
	                         }
	                }
		        }else{
		        	$cat['category'] = $this->Login_m->getCatData();
					$this->load->view('product/product_add',$cat);
		        }
				
			}elseif($para1 == 'edit'){
				if($this->input->post()){
					$data['name'] = $this->input->post('name');
					$data['category'] = $this->input->post('category');
					$data['sub_category'] = $this->input->post('sub_category');
					$data['price'] = $this->input->post('price');
					$data['shipping'] = $this->input->post('shipping');
					$data['tax'] = $this->input->post('tax');
					if ($_FILES['image']['name'] != ""){	
	            		$config = [
							'upload_path'   =>'uploads',
							'allowed_types' =>'gif|jpg|jpeg|png',
							'encrypt_name'  => true
					    ];
			            $this->load->library('upload', $config);
						if($this->upload->do_upload('image'))
						{
							$path  = $this->upload->data();
							$image = $path['raw_name'].$path['file_ext'];
							$data['image'] = $image;
							if($path['file_name'] == true)
							{
								$updatePro = $this->Login_m->updateProduct($this->input->post('product_id'), $data, 'img');
			                    if($updatePro){
									echo "Product updated successfully !!";
								}else{
									echo "string";
								}
							}
						 }
					} elseif($_FILES['image']['name'] == "" ){ 
						 $updatePro = $this->Login_m->updateProduct($this->input->post('product_id'), $data, 'nofile');
		                 if($updatePro){
								echo "Product updated successfully !!";
							}else{
								echo "string";
							}	
	       			}
				}else{
					$cat = $this->Login_m->getCatData();
					$pro = $this->Login_m->getRowById($para2,'product');
					$scat = $this->Login_m->getSubCatData($pro[0]['category']);
					$this->load->view('product/product_edit',['category'=>$cat,'subcategory'=>$scat,'product'=>$pro]);
				}
			}elseif($para1 == 'del'){
				$delPro = $this->Login_m->delProduct($para2);
				if($delPro){
					echo "Product Deleted successfully !!";
				}else{
					echo "string";
				}	
			}else{
				$this->load->view('product/product');
			}
		}

	}

	public function getListByMatch(){
        $value  = $this->input->post('id');
		$table  = $this->input->post('table');
		$name   = $this->input->post('name');

        $getList = $this->Login_m->getAllDataByMatch($value, $table, $name);
        foreach($getList as $result){
                echo "<option value=".$result['subcategory_id'].">".$result['subcategory_name']."</option>";
        }

    }

	public function logout()
	{
	    $this->session->unset_userdata('login');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');

		redirect(base_url() . 'users');   
	}
}