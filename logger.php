<?php
$users = array("david","jeremie","hugo","sebastien","paul","melina","mickael","alfred","alexis","tristan","alexandre","jules");

function print_error($code, $msg){
  http_response_code($code);
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-type: application/json');
  $erreur["code"] = 404;
  $erreur["message"] = $msg;
  echo json_encode($erreur);
  exit(1);

}

/*
* POST /logger.php?user={user}
* Data en JSON
*/
if(isset($_GET["user"]) && !empty($HTTP_RAW_POST_DATA)){
  $user = $_GET["user"];
  if(in_array($user,$users)){
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
      print_error(400,"Empty post data");
    }
  }
  else{
    print_error(404,"User not found");
  }
}
else {
  print_error(400,"Empty post data or empty user");
}
