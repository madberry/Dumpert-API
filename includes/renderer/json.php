<?php	
class JSON{
    var $response = '';
    function JSON($model,$function,$params=NULL){
        $REQUEST = new $model;
        $data = $REQUEST->$function($params);
        header('Content-type: application/json');
        $this->response = json_encode($data);
    }
}
?>