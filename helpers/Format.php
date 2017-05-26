<?php 
   class Format{
      public function formatDate($date){
	    return date('g:i a', strtotime($date));
	  }
	  public function fullFormatDate($date){
	    return date('F j, Y, g:i a', strtotime($date));
	  }
	  
	  public function textShorten($text, $limit = 350){
	      $text = $text. " ";
		  $text = substr($text, 0, $limit);
		  $text = substr($text, 0, strrpos($text, ' '));
		  $text = $text."...";
		  return $text;
	  }
	  public function validation($data){
	     $data = trim($data);
		 $data = stripcslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
	  }
	  public function stringtoupper($data){
	     $data = strtoupper($data);
		 return $data;
	  }
   }
?>