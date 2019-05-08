<?php

require_once('../private/initialize.php');

//if(is_post_request()) {
    
  // Create record using post parameters
  $args = [];
  $args['name'] = $_POST['name'] ?? NULL;
  $args['age'] = $_POST['age'] ?? NULL;

  
  

  $user = new User($args);
  $result = $user->create();

  
  if($result === true) {
    //$new_id = $user->id;
    $_SESSION['message'] = 'The user was created successfully.';
   redirect_to(url_for('index.php'));
  } 
?>