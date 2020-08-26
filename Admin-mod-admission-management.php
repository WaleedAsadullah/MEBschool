<?php
include_once('session_end.php');
?>
<!DOCTYPE html>
<htm>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

          <?php include_once("title.php") ?>

        <!-- form Uploads -->
        <link href="assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">
                <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

        <style>
            .img1 {
                position: absolute;
                left: 0px;
                top: 0px;
                z-index: 2;
                margin-top: 12%;
                margin-left: 28%;

                }
        </style>

</head>
<body class="fixed-left">
    <div id="wrapper" class="enlarged">


                    <!--- header -->
                    <?php 
                            include_once("header.php");
                            include_once("db_functions.php");
                    ?>

                    <!-- header -->
        
 

                    <!--- Sidemenu -->
                    <?php 
                            include_once("Admin-mod-sidemenu.php")
                    ?>

                    <!-- Sidebar -->
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                     <div style="text-align: center" >
                                         <a  href="#formadd" > <button type="button" class="btn btn-primary btn w-md waves-effect waves-light m-b-5"  >+ Addmission</button></a>
                                        <a> <button type="button" class="btn btn-info btn w-md waves-effect waves-light m-b-5" > Export </button></a>
                                    </div>
                                </div>
                            </div>

                            <!-- input form -->


                            <!-- input form -->
                                <div class="col-lg-12">
                                    <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px;"> Addmission Sheet </h4>
                                    <br>

                                    <div class="table-responsive">
                                         <table id="datatable" class="tablesaw table m-b-0 tablesaw-columntoggle table-bordered " id="adadmissiontable">
                                            <?php
                                            // -------------------------
                                            // echo "test";
  if(isset($_FILES['profile_picture'])){

print_r($_FILES);

///file upload code
$target_dir = "uploads/".rand(10,1000000)."_";
$target_file = $target_dir. basename($_FILES["profile_picture"]["name"]);

// $target_file = trim(basename(stripslashes($target_file)), ".\x00..\x20");

$target_file = str_replace(" ","",$target_file);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["profile_picture"]["size"] > 2000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["profile_picture"]["name"]). " has been uploaded.";
    $uploadedok = true;
  } else {
     $uploadedok = false;
    echo "Sorry, there was an error uploading your file.";
  }
}
$_REQUEST['profile_picture'] = $target_file ;
}



                                            if(isset($_REQUEST['submit'])){

if( $uploadedok) {
//////
    
                                            // print_r($_REQUEST);

                                            $sql = 'INSERT INTO `ad_admission` (`addmission_id`, `user_id`, `user_time`, `class`, `GR_No`, `name_of_student`, `father_name`, `surname`, `guardian_name`, `relationship`, `religion`, `address`, `phone`, `cell_no`, `e_mail`, `ice_no`, `occupation_of_father`, `monthly_income`, `cnic_guradian`, `date_of_birth`, `place_of_birth`, `date_of_birth_words`, `admission_saught`, `admission_granted`, `last_school_class`,`profile_picture`) VALUES (NULL,\'';
                                            $sql .= get_current_user();
                                            $sql .= '\', CURRENT_TIMESTAMP, \''.$_REQUEST['class']. '\',\''.$_REQUEST['GR_No'].'\', \''.$_REQUEST['name_of_student']. '\', \''.$_REQUEST['father_name']. '\', \''.$_REQUEST['surname']. '\', \''.$_REQUEST['guardian_name']. '\', \''.$_REQUEST['relationship']. '\', \''.$_REQUEST['religion']. '\', \''.$_REQUEST['address']. '\', \''.$_REQUEST['phone']. '\', \''.$_REQUEST['cell_no']. '\', \''.$_REQUEST['e_mail']. '\', \''.$_REQUEST['ice_no']. '\', \''.$_REQUEST['occupation_of_father']. '\', \''.$_REQUEST['monthly_income']. '\', \''.$_REQUEST['cnic_guradian']. '\', \''.$_REQUEST['date_of_birth']. '\', \''.$_REQUEST['place_of_birth']. '\', \''.$_REQUEST['date_of_birth_words']. '\', \''.$_REQUEST['admission_saught']. '\', \''.$_REQUEST['admission_granted']. '\', \''.$_REQUEST['last_school_class']. '\', \''.$_REQUEST['profile_picture']. '\')';
                                            // echo $sql;
                                            insert_query($sql);

                                        }

                                    }
                                    else echo "";
                                            // -------------------------
                                            ///edit code
                                            check_edit("ad_admission","addmission_id");
                                            edit_display("ad_admission","addmission_id");
                                            //end of edit code -shift view below delete

                                            // --------------------------
                                            if(isset($_REQUEST['deleteid']) && is_numeric($_REQUEST['deleteid'])){ $sql = 'DELETE FROM `ad_admission` WHERE `ad_admission`.`addmission_id` = '.$_REQUEST['deleteid'];

                                            insert_query($sql);
                                            // echo "done deleting";
                                                }

                                            $sql = 'SELECT `addmission_id`"ID", `class` "Class", `GR_No` "Gr No.", `name_of_student`"Name Of Student", `father_name`"Father\'s Name", `surname`"Surname", `guardian_name`"Guardian Name", `relationship` "Relationship", `religion` "Religion", `address`"Address", `phone`"Phone", `cell_no`"Cell No.", `e_mail` "E-mail", `ice_no`"In case of Emergency", `occupation_of_father` "Occupation of Father", `monthly_income` "Monthly Income", `cnic_guradian`"CNIC Guardian", `date_of_birth`"Date of Birth", `place_of_birth`"Place of Birth", `date_of_birth_words` "Date of Birth (in words)", `admission_saught` "Admission saught for class", `admission_granted` "Admission granted for class", `last_school_class` "Last School and Class Attended " FROM `ad_admission`';
                                            display_query($sql);

                                            

                                            // ------------------------------
                                            ?>
                                    <?php

                                    if (isset($_POST['submit'])){
                                        if( $uploadedok) {
                                        $user = mysqli_real_escape_string(connect_db(), $_POST['name_of_student']);
                                        $e_mail = mysqli_real_escape_string(connect_db(), $_POST['e_mail']);
                                        $class = mysqli_real_escape_string(connect_db(), $_POST['class']);
                                        // $account = mysqli_real_escape_string(connect_db(), $_POST['account']);
                                        $pass = mysqli_real_escape_string(connect_db(), $_POST['pass']);
                                         $cpass = mysqli_real_escape_string(connect_db(), $_POST['cpass']);

                                        $pas = password_hash($pass, PASSWORD_BCRYPT);
                                        $cpas = password_hash($cpass, PASSWORD_BCRYPT);

                                        $e_mailquary = " select * from ad_add_user where e_mail='$e_mail'";
                                        $query = mysqli_query(connect_db(),$e_mailquary);
                                        $e_mailcount = mysqli_num_rows($query);
                                        if($e_mailcount>0){
                                            echo    '<script>
                                                        alert("E-mail is already Exists");
                                                    </script>';
                                        }else{
                                            if( $pass ==  $cpass){
                                                $_account = "'Students'";
                                            $sql = 'INSERT INTO `ad_add_user`(`add_user_id`, `user_id`, `user_date`, `name`, `e_mail`, `class`, `gr_no`, `account`, `pass`, `cpass`) VALUES (NULL,\'';
                                            $sql .= get_curr_user();
                                            $sql .= '\', CURRENT_TIMESTAMP, \''.$_REQUEST['name_of_student'].'\', \''.$_REQUEST['e_mail'].'\', \''.$_REQUEST['class'].'\', \''.$_REQUEST['GR_No'].'\', '.$_account.', \''.$pas.'\', \''.$cpas.'\')';
                                                $iquery = insert_query($sql);
                                                    echo '<script>
                                                    alert("Account created")
                                                    </script>';
                                                
                                            }else{
                                                   echo ' <script>
                                                    alert("Password are not same");
                                                    </script>';
                                                }
                                        }
                                    }}


                                    // ///edit code
                                    // check_edit("ad_add_user","add_user_id");
                                    // edit_display("ad_add_user","add_user_id");
                                    // //end of edit code -shift view below delete

                                    // // --------------

                                    // if(isset($_REQUEST['deleteid']) && is_numeric($_REQUEST['deleteid'])){ $sql = 'DELETE FROM `ad_add_user` WHERE `ad_add_user`.`add_user_id` = '.$_REQUEST['deleteid'];

                                    // insert_query($sql);
                                    // // echo "done deleting";
                                    //     }
                                    // // $sql = "SELECT * FROM `ac_annual_appraisal`";

                                    // $sql = 'SELECT `add_user_id`"ID", `user_id`, `user_date`"Date", `name`"Name", `e_mail`"E-mail", `class`"Class", `gr_no`"Gr No.", `account`"Type", `pass`"Password" FROM `ad_add_user`';
                                    // display_query($sql);


                                    ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    </div>
                </div>
        <br>
        <br>

                    <!-- attendance form -->

            <div class="content-page" id="formadd">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">

                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px"> Admission Form</h4>
                                    
                                    <?php
                                    $conn = connect_db();
                                            $sql_gr = 'SELECT `addmission_id` FROM `ad_admission`';
                                            $result_gr = mysqli_query($conn, $sql_gr); 

                                            while($row_gr = mysqli_fetch_assoc($result_gr)){
                                                
                                                $gr_no[] = $row_gr['addmission_id'];}
                                                $gr_no_create = max($gr_no) + 1;
                                                echo $gr_no_create ;
                                            
                                                
                                        
                                    ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >

                                        <div class="row ">
                                            <div class="col-md-8" style="padding-top: 6%;">
                                                <div class="row" >
                                                    <div class="col-md-12" >
                                                        <div>
                                                            <div class="form-group">
                                                                <?php
                                                                dropDownSimple("Class","class","class_name","ad_class",NULL);
                                                                ?>
                                                            
                                                        </div>
                                                        </div>
                                                        <div>
                                                            <div class="form-group">
                                                                <label for="G.RNo">G.R No.</label>
                                                                <input type="text" name="GR_No" required
                                                                       placeholder="Enter G.R No." class="form-control" id="adG.RNo"
                                                                       <?php if(isset($_REQUEST['GR_No']))echo'value="'.$_REQUEST['GR_No'].'" readonly';else echo'value="'.$gr_no_create.'" readonly'; ?>>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="align-content: center;">
                                                    <h4 class="header-title m-t-0 m-b-30">Max File size</h4>
                                                    <?php if (isset($_REQUEST['profile_picture'])) echo "<img class = 'img1' style = 'height:190px ;' src=".$_REQUEST['profile_picture'].">";  ?>
                                                    <input id="profile_picture" name="profile_picture" type="file" class="dropify" data-max-file-size="10M" required="" />
                                                </div>
                                            </div>
                                        </div>

<!--                                         <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="class">Class</label>
                                                    <input type="text" name="nick" parsley-trigger="change" required
                                                           placeholder="Enter class" class="form-control" id="class">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="G.RNo">G.R No.</label>
                                                    <input type="email" name="number" parsley-trigger="change" required
                                                           placeholder="Enter G.R No." class="form-control" id="G.RNo">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="nameofthestudent">Name of the Student</label>
                                            <input type="text" name="name_of_student" required
                                                   placeholder="Enter name" class="form-control" id="adnameofthestudent"
                                                   value="<?php if (isset($_REQUEST['name_of_student'])) echo $_REQUEST['name_of_student'];  ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="father_name">Father's Name</label>
                                                    <input type="text" name="father_name" required
                                                           placeholder="Enter father's name" class="form-control" id="adfathersname"
                                                           value="<?php if (isset($_REQUEST['father_name'])) echo $_REQUEST['father_name'];  ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="surname">Surname</label>
                                                    <input type="text" name="surname" placeholder="Enter surname" class="form-control"
                                                    value="<?php if (isset($_REQUEST['surname'])) echo $_REQUEST['surname'];  ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="guardian'sname">Guardian's Name</label>
                                                    <input type="text" name="guardian_name" required placeholder="Enter guardian's name" class="form-control"
                                                    value="<?php if (isset($_REQUEST['guardian_name'])) echo $_REQUEST['guardian_name'];  ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="guardian'sname">Relationship</label>
                                                    <input type="text" name="relationship" required placeholder="Enter relationship" class="form-control"
                                                    value="<?php if (isset($_REQUEST['relationship'])) echo $_REQUEST['relationship'];  ?>" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="religion">Religion</label>
                                            <input type="text" name="religion" required placeholder="Enter religion" class="form-control" id="adreligion" value="<?php if (isset($_REQUEST['religion'])) echo $_REQUEST['religion'];  ?>" >
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input  type="text" name="address" required placeholder="Enter address" class="form-control" id="adaddress"
                                            value="<?php if (isset($_REQUEST['address'])) echo $_REQUEST['address'];  ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone(Res.)</label>
                                                    <input type="tel" name="phone" required placeholder="Enter phone" class="form-control" id="adphone"
                                                    value="<?php if(isset($_REQUEST['phone'])) echo $_REQUEST['phone'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="cellno">Cell No.</label>
                                                    <input type="tel" name="cell_no" required placeholder="Enter cell no." class="form-control" id="adcellno" value="<?php if(isset($_REQUEST['cell_no'])) echo $_REQUEST['cell_no'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="e-mail">E-mail</label>
                                                    <input type="email" name="e_mail" placeholder="Enter e-mail" class="form-control"
                                                     value="<?php if(isset($_REQUEST['e_mail'])) echo $_REQUEST['e_mail'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ice">ICE (In case Emergency) No.</label>
                                                    <input type="tel" name="ice_no" required placeholder="Enter ICE." class="form-control" id="adice"
                                                     value="<?php if(isset($_REQUEST['ice_no'])) echo $_REQUEST['ice_no'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="Occupation">Occupation of Father/Guardian</label>
                                                    <input type="text" name="occupation_of_father" placeholder="Enter occupation" class="form-control" id="adoccupation"  value="<?php if(isset($_REQUEST['occupation_of_father'])) echo $_REQUEST['occupation_of_father'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="income">Monthly Income Rs.</label>
                                                    <input type="number" name="monthly_income" placeholder="Enter income." class="form-control" id="adincome" value="<?php if(isset($_REQUEST['monthly_income'])) echo $_REQUEST['monthly_income'] ?>" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                    <label for="cnic">CNIC No. of Father / Guradian</label>
                                                    <input type="number" name="cnic_guradian" required placeholder="Enter CNIC" class="form-control" id="adcnic"
                                                     value="<?php if(isset($_REQUEST['cnic_guradian'])) echo $_REQUEST['cnic_guradian'] ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="dateofbirth">Date of Birth (In figures)</label>
                                                    <input type="date" name="date_of_birth" required placeholder="Enter date of birth" class="form-control" id="addateofbirth"
                                                    value="<?php if(isset($_REQUEST['date_of_birth'])) echo $_REQUEST['date_of_birth'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="placofbirth">Place of Birth</label>
                                                    <input type="text" name="place_of_birth" placeholder="Enter place of birth" class="form-control" id="adplaceofbirth"
                                                    value="<?php if(isset($_REQUEST['place_of_birth'])) echo $_REQUEST['place_of_birth'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="dateofbirthwords">Date of Birth (In words)</label>
                                            <input type="text" name="date_of_birth_words" required placeholder="Enter occupation" class="form-control" id="addateofbirthwords"
                                            value="<?php if(isset($_REQUEST['date_of_birth_words'])) echo $_REQUEST['date_of_birth_words']?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="addmissionsaught">Addmission saught for class</label>
                                            <input type="text" name="admission_saught" required placeholder="Enter saught for class" class="form-control" id="adaddmissionsaught"
                                            value="<?php if(isset($_REQUEST['admission_saught'])) echo $_REQUEST['admission_saught']?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="addmissiongranted">Addmission granted for class</label>
                                            <input type="text" name="admission_granted" required placeholder="Enter admission granted for class" class="form-control" id="adaddmissiongranted"
                                            value="<?php if(isset($_REQUEST['admission_granted'])) echo $_REQUEST['admission_granted']?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="lastclass">Last School & Class Attended</label>
                                            <input type="text" name="last_school_class" required placeholder="Enter occupation" class="form-control" id="adlastclass"
                                            value="<?php if(isset($_REQUEST['last_school_class'])) echo $_REQUEST['last_school_class']?>">
                                        </div>
                                        <hr>
                                        <h4 class="header-title m-t-0 m-b-5"> For Portal </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lcDateOfBirthW">Password</label>
                                                    <input type="password" required name="pass" minlength="8" 
                                                           placeholder="Enter password" class="form-control" id="lcDateOfBirthW" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lcLastSchool">Confirm password</label>
                                                    <input  type="password" required name="cpass" minlength="8"
                                                                   placeholder="Confirm password " class="form-control" id="lcLastSchool" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <?php 
                                            code_submit();
                                            ?>
                                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                                Cancel
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div>
                </div>
            </div>
                <!-- for office use only -->
            <!-- <div class="">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px"> For Office Use Only </h4>

                                    <form action="#" >

                                        <div class="form-group">
                                            <label for="adAdmittedClass">Admitted Class</label>
                                            <input type="text" name="name" parsley-trigger="change" required
                                                   placeholder="Enter admitted class" class="form-control" id="adAdmittedClass">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="adAdmissionFeeRs">Admission Fee Rs</label>
                                                    <input type="number" name="father'sname" parsley-trigger="change" required
                                                           placeholder="Enter admission fee" class="form-control" id="adAdmissionFeeRs">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="adRNo">R No.</label>
                                                    <input id="adRNo" type="text" placeholder="Enter r no." required
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="adExamFee">Activities & Examination Fee Rs.</label>
                                            <input  type="text" required
                                                           placeholder="Enter activities & xamination fee" class="form-control" id="adExamFee">
                                        </div>
                                        <div class="form-group">
                                            <label for="adTutionFee">Tution Fee Rs.</label>
                                            <input  type="number" required
                                                           placeholder="Enter activities & xamination fee" class="form-control" id="adTutionFee">
                                        </div>
                                        <div class="form-group">
                                            <label for="adTotalFee">Total Rs.</label>
                                            <input  type="text" required
                                                           placeholder="Enter activities & xamination fee" class="form-control" id="adTotalFee">
                                        </div>
                                        <br>
                                        <label><strong>Document Submitted</strong></label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="checkbox checkbox-info">
                                                    <input id="adBirthCertificate" type="checkbox">
                                                    <label for="adBirthCertificate">1. Birth Certificate</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkbox checkbox-info">
                                                    <input id="adPhotographs" type="checkbox">
                                                    <label for="adPhotographs">2. Six Passport Size Photographs of Student (in school uniform)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="checkbox checkbox-info">
                                                    <input id="adTC" type="checkbox">
                                                    <label for="adTC">3. School Leaving Certificate</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkbox checkbox-info">
                                                    <input id="adCnicCopy" type="checkbox">
                                                    <label for="adCnicCopy">4. CNIC Photo Copy of Parents</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="adNadra" type="checkbox">
                                            <label for="adNadra">5. NADRA Regisration Certificate</label>
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light"  id="adsubmit" onclick ="addmissionFormAdd()">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                                Cancel
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </divend col -->
                       <!--  </div>

                    </div>
                </div>
                 for office use only
            </div> --> --> -->



      <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
                <!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


    <!-- for checking form -->
            <!-- file uploads js -->
        <script src="assets/plugins/fileuploads/js/dropify.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>
        <?php include_once('script.php') ?>




</body>
</html>