<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
    
	public function user_login_check($username, $password)
	{
		$query = $this->db->where( ['username'=>$username, 'password'=>$password] )->get('user');
		if( $query->num_rows() == 1 )
		{
		    return $query->row();
		}else{
			return false;
		}
	}

	public function getProData()
	{
		$query = $this->db->get('product')->result_array();
		if( $query > 0 )
		{
		    return $query;
		}else{
			return false;
		}
	}

	public function getCatData(){   
		$query = $this->db->get('category')->result_array();
		if( $query > 0 )
		{
		    return $query;
		}else{
			return false;
		}
	}

	public function getSubCatData($cat){   
		$query = $this->db->where( ['category_id'=>$cat] )->get('subcategory')->result_array();
		if( $query > 0 )
		{
		    return $query;
		}else{
			return false;
		}
	}

	public function insertProduct($data){
		$this->db->insert('product', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function updateProduct($id, $data, $action){ /*exit(print_r($data));*/
      if($action == 'img'){
          $delquery = $this->db->select('image')
                            ->from('product')
                            ->where(['product_id'=>$id])
                            ->get(); 
          $delimage = $delquery->row('image'); 

          unlink("uploads/".$delimage);
      }
      $query = $this->db->where('product_id', $id)
                        ->update('product', $data);
      if( $query )
      {
          return true;
      }else{
         return false;
      }
  	}

  	public function delProduct($id){
  		$delquery = $this->db->select('image')
                            ->from('product')
                            ->where(['product_id'=>$id])
                            ->get(); 
        $delimage = $delquery->row('image'); 

        unlink("uploads/".$delimage);

        $query = $this->db->delete('product', array('product_id' => $id));
        if( $query )
	    {
	          return true;
	    }else{
	         return false;
	    }
  	}

	public function getRowById($id, $table){
		$query = $this->db->where( [$table.'_id'=>$id] )->get($table)->result_array();
		if( $query > 0 )
		{
		    return $query;
		}else{
			return false;
		}
	}

	public function getAllDataByMatch($value, $table, $name){
		$query = $this->db->where( [$name=>$value] )->get($table)->result_array();
		if( $query > 0 )
		{
		    return $query;
		}else{
			return false;
		}
	}

}