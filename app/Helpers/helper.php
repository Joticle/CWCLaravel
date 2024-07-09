<?php
function debug($array,$exit=0){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if($exit){
        exit;
    }
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
function replace_null_with_empty_string($array){
    $integer_fields = ['to','from','last_page','per_page'];
    foreach ($array as $key => $value)
    {
        if(is_array($value)){
            $array[$key] = replace_null_with_empty_string($value);
        }else{
            if (is_null($value)){
                if(in_array($key,$integer_fields)){
                    $array[$key] = 0;
                }else{
                    $array[$key] = "";
                }
            }
        }
    }
    return $array;
}
function buildResponse($type=null,$message='',$data=[]){
    $type = ($type == 'success') ? '200' : '400';
    $data['message'] = $message;
    $data['status'] = $type;
    $data = replace_null_with_empty_string($data);
    return response()->json(array_reverse($data));
}
function buildResponsePlain($type=null,$message='',$data=[]){
    $type = ($type == 'success') ? '200' : '400';
    return response()->json(['status'=>$type,'message'=>$message,'data'=>replace_null_with_empty_string($data)]);
}
function buildValidationErrors($errorsBag){
    $errorsBag = $errorsBag->toarray();
    $responseErrors = [];
    foreach ($errorsBag as $errors){
        foreach ($errors as $error){
            $responseErrors[] = $error;
        }
    }
    return $responseErrors;
}
function makeFieldJsonToArray($array, $field){
    if(isset($array[$field])){
        $array[$field] = json_decode($array[$field],1);
    }
    return $array;
}
function beautify($text){
    $text = ucwords(str_replace('_',' ',$text));
    return $text;
}
function markAsObjects($data,$indexes){
    foreach ($data as $key=>$value){
        if(in_array($key,$indexes)){
            if(empty($value)){
                $data[$key] = (object)[];
            }
        }
    }
    return $data;
}
function maskCaseId($id){
    return sprintf("%04d", $id);
}
function _date($date){
    return date('d F Y',strtotime($date));
}
function getContentList(){
    $list = [];
    foreach (App\Models\ContentType::CONTENTLIST as $key=>$content){
        $list[$key] = $content['name'];
    }
    return $list;
}
function printPrice($number){
    if($number > 0){
        return '$'.number_format($number, 2, '.', '');
    }
    return 'Free';
}
function isActiveClass($route){
    if(\Str::startsWith(\Route::currentRouteName(), $route)){
        return 'mm-active';
    }
    return '';
}
?>
