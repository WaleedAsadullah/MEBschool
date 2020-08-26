<?php
session_start();

$_SESSION['teacher_id'] = 2;
$_SESSION['student_id'] = 59;
// if (!isset($_SESSION['name'])){
//     header('location:index.php');
// }

// include_once("db_functions.php");


// function hasaccess($id)
// {


// print_r($_SESSION);
//   echo "testing access";
// $id = $_SESSION['user_id'];
// if(isset($id))
// {
// $sql = 'SELECT * FROM `ad_add_user` WHERE `add_user_id` = '.$id;

// $data = query_to_array($sql);

// if(isset($data[0]))
// $form_arr = explode("-",str_replace("school/","",get_current_form()));

// if($form_arr[0] == "/".lcfirst($data[0]['account']))
// 	// || "Admin" == $data[0]['account'] )
// 	 {echo "Has access to ".$form_arr[0]." as ".$data[0]['account'];
// echo '<br>';}
// else {
// 	// echo "does not have access to ".$form_arr[0]." as ".$data[0]['account'];
// echo '<script>
//        location.replace(\'index.php\');
//       </script>';}
// }

?>
