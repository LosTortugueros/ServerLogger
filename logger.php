<?php
const USERS = {"david","jeremie","hugo","sebastien","paul","melina","mickael","alfred","alexis","tristan","alexandre","jules"};

/*
* POST /logger.php?user={user}
* Data en JSON
*/
if(isset($_GET["user"]) && !empty($HTTP_RAW_POST_DATA)){
  $user = $_GET["user"];
  if(in_array($user,USERS)){
    $newData = json_decode($HTTP_RAW_POST_DATA);
    if(!empty($newData)){
      $file = file_get_contents($user.'.json');
      $data = json_decode($file);
      unset($file);
      $data[] = $newData;
      file_put_contents($user.'.json',json_encode($data));
      unset($data);
      unset($newData);
      http_response_code(201);
    }
    else{
      http_response_code(400);
      $erreur["code"] = 400;
      $erreur["message"] = "Empty post data";
    }
  }
  else{
    http_response_code(404);
    $erreur["code"] = 404;
    $erreur["message"] = "User not found";
  }
}
else {
  http_response_code(400);
  $erreur["code"] = 400;
  $erreur["message"] = "Empty post data or empty user";
}
