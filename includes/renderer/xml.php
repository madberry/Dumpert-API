<?php	
function xml_encode($data) {
		header('Content-type: text/xml');
	    echo '<posts>';
		foreach($data as $index => $post) {
		  if(is_array($post)) {
			foreach($post as $key => $value) {
			  //echo '<',$key,'>';
			  echo '<post>';
			  if(is_array($value)) {
				foreach($value as $tag => $val) {
				  echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
				}
			  }
			  //echo '</',$key,'>';
			  echo '</post>';
			}
		  }
		}
		echo '</posts>';	
	}
	
class XML{

	var $response = '';

	function XML($model,$function,$params=NULL){
		$REQUEST = new $model;
		$data = $REQUEST->$function($params);
		$this->response = xml_encode($data);
	}
	
}
?>