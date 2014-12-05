<?php
if(isset($_GET["user"])){
  $user = $_GET["user"];
  http_response_code($code);
  $semRes = sem_get(SEM_KEY, 1, 0666, 0); 
  if(sem_acquire($semRes)) {
  	$file = file_get_contents($user.'.json');
  	 sem_release($semRes); // release the semaphore so other process can use it
    }
  $data = json_decode($file);
  unset($file);
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-type: application/json');
  echo $data;
}
?>
