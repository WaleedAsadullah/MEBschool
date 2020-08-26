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
    </head>
    <body class="fixed-left">
        <div id="wrapper" class="enlarged">


                    <!--- header -->
                    <?php 
                            include_once("header.php");
                            include_once("db_functions.php")
                    ?>

                    <!-- header -->
        
 

                    <!--- Sidemenu -->
                    <?php 
                            include_once("Admin-mod-sidemenu.php")
                    ?>

                    <!-- Sidebar -->

            <!-- content -->
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                     <div style="text-align: center" >
                                         <a  href="admin-mod-student-addmission-form.php" > <button type="button" class="btn btn-primary btn w-md waves-effect waves-light m-b-5"  >+ Add</button></a>
                                        <a> <button type="button" class="btn btn-info btn w-md waves-effect waves-light m-b-5" > Export </button></a>
                                    </div>
                                </div>
                            </div>
                            <!-- form -->
                                <div class="col-lg-12">
                                    <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px; font-weight: 300"> UserS </h4>

                                    <div class="table-responsive">
                                        <table id="datatable" class="tablesaw table m-b-0 tablesaw-columntoggle table-bordered ">
                                            <?php

                                    if (isset($_POST['submit'])){
                                        $user = mysqli_real_escape_string(connect_db(), $_POST['name']);
                                        $e_mail = mysqli_real_escape_string(connect_db(), $_POST['e_mail']);
                                        $class = mysqli_real_escape_string(connect_db(), $_POST['class']);
                                        $account = mysqli_real_escape_string(connect_db(), $_POST['account']);
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
                                            $sql = 'INSERT INTO `ad_add_user`(`add_user_id`, `user_id`, `user_date`, `name`, `e_mail`, `class`, `gr_no`, `account`, `pass`, `cpass`) VALUES (NULL,\'';
                                            $sql .= get_curr_user();
                                            $sql .= '\', CURRENT_TIMESTAMP, \''.$_REQUEST['name'].'\', \''.$_REQUEST['e_mail'].'\', \''.$_REQUEST['class'].'\', \''.$_REQUEST['gr_no'].'\', \''.$_REQUEST['account'].'\', \''.$pas.'\', \''.$cpas.'\')';
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
                                    }


                                    ///edit code
                                    check_edit("ad_add_user","add_user_id");
                                    edit_display("ad_add_user","add_user_id");
                                    //end of edit code -shift view below delete

                                    // --------------

                                    if(isset($_REQUEST['deleteid']) && is_numeric($_REQUEST['deleteid'])){ $sql = 'DELETE FROM `ad_add_user` WHERE `ad_add_user`.`add_user_id` = '.$_REQUEST['deleteid'];

                                    insert_query($sql);
                                    // echo "done deleting";
                                        }
                                    // $sql = "SELECT * FROM `ac_annual_appraisal`";

                                    $sql = 'SELECT `add_user_id`"ID", `user_id`, `user_date`"Date", `name`"Name", `e_mail`"E-mail", `class`"Class", `gr_no`"Gr No.", `account`"Type", `pass`"Password" FROM `ad_add_user`';
                                    display_query($sql);


                                    ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- form end -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- table -->
             <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px; font-weight: 300"> Add user</h4>


                                    <form action="Admin-mod-add-user.php" method="post" >

                                        <div class="form-group">
                                            <label for="lcName">User Name</label>
                                            <input type="text" name="name"required
                                                   placeholder="Enter user name" class="form-control" id="lcnName"value="<?php if(isset($_REQUEST['name'])) echo$_REQUEST['name'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="father'sname">E-mail</label>
                                            <input type="email" required name="e_mail" 
                                                   placeholder="Enter e-mail" class="form-control" id="adfathersname" value="<?php if(isset($_REQUEST['e_mail'])) echo$_REQUEST['e_mail'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="class">Class</label>
                                            <select type="text" name="class" required=""class="form-control" >
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "montessori" ) echo "selected";  ?> value="montessori">Montessori</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "KG 1" ) echo "selected";  ?> value="KG 1">KG 1</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "KG 2" ) echo "selected";  ?> value="KG 2">KG 2</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "1" ) echo "selected";  ?> value="1">1</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "2" ) echo "selected";  ?> value="2">2</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "3" ) echo "selected";  ?> value="3">3</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "4" ) echo "selected";  ?> value="4">4</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "5" ) echo "selected";  ?> value="5">5</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "6" ) echo "selected";  ?> value="6">6</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "7" ) echo "selected";  ?> value="7">7</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "8" ) echo "selected";  ?> value="8">8</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "9" ) echo "selected";  ?> value="9">9</option>
                                                    <option <?php if (isset($_REQUEST['class']) && $_REQUEST['class']== "10" ) echo "selected";  ?> value="10">Matric</option>
                                                </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="lcDateOfBirthF">Gr No.</label>
                                            <input type="text" required name="gr_no" 
                                                   placeholder="Enter GR number" class="form-control" id="lcDateOfBirthF" value="<?php if(isset($_REQUEST['gr_no'])) echo$_REQUEST['gr_no'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Account</label>
                                            <select name="account" class="form-control">
                                                <option  <?php if (isset($_REQUEST['account']) && $_REQUEST['account']== "Students" ) echo "selected";  ?> value="Students">Student</option>
                                                <option <?php if (isset($_REQUEST['account']) && $_REQUEST['account']== "Parents" ) echo "selected";  ?> value="Parents">Parent</option>
                                                <option <?php if (isset($_REQUEST['account']) && $_REQUEST['account']== "Teacher" ) echo "selected";  ?> value="Teacher">Teacher</option>
                                                <option <?php if (isset($_REQUEST['account']) && $_REQUEST['account']== "Accounts" ) echo "selected";  ?> value="Accounts">Account</option>
                                                <option <?php if (isset($_REQUEST['account']) && $_REQUEST['account']== "Admin" ) echo "selected";  ?> value="Admin">Admin</option>
                                            </select>
                                            
                                        </div>
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
                            <div class="col-lg-3"></div>
                        </div>

                    </div>
                </div>
            <!-- table end -->

            <!-- content end -->

        </div>
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
        <?php include_once('script.php') ?>

        
    </body>
</html>
