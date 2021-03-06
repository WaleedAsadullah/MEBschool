<?php
include_once('session_end.php');
?>
<!DOCTYPE html>
<html>
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

<body class="smallscreen fixed-left-void">
    <div id="wrapper" class="enlarged">


                    <!--- header -->
                    <?php 
                            include_once("header.php");
                            include_once("db_functions.php");
                    ?>

                    <!-- header -->
        
 

                    <!--- Sidemenu -->
                    <?php 
                            include_once("Accounts-mod-sidemenu.php")
                    ?>

                    <!-- Sidebar -->





            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                     <div class="m-t-5 m-b-5" style="text-align: center" >
                                         <a  href="#formadd" > <button type="button" class="btn btn-primary btn w-md waves-effect waves-light"  >+ Add</button></a>
                                        <a> <button type="button" class="btn btn-info btn w-md waves-effect waves-light" > Export </button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px;"> Payroll Calculation </h4>
                                    <br>

                                    <div class="table-responsive">
                                        <table id="datatable" class="tablesaw table m-b-0 tablesaw-columntoggle table-bordered ">
                                            <?php
                                            // ---------------
                                            if (isset($_REQUEST['submit'])) {
                                            $sql = 'INSERT INTO `ac_payroll_calculation`(`payroll_id`, `user_id`, `user_date`, `gr_number`, `name`, `designation`, `attendance`, `basic_salary`, `house_ra`, `utility`, `convey_allow`, `gross_salary`, `loan`, `i_t`, `s_w_f`, `advance`, `leave_pay`, `net_pay`,`type`) VALUES (NULL,\'';
                                            $sql .= get_curr_user();
                                            $sql .= '\', CURRENT_TIMESTAMP, \''.$_REQUEST['gr_number'].'\', \''.$_REQUEST['name'].'\', \''.$_REQUEST['designation'].'\', \''.$_REQUEST['attendance'].'\', \''.$_REQUEST['basic_salary'].'\', \''.$_REQUEST['house_ra'].'\', \''.$_REQUEST['utility'].'\', \''.$_REQUEST['convey_allow'].'\', \''.$_REQUEST['gross_salary'].'\', \''.$_REQUEST['loan'].'\', \''.$_REQUEST['i_t'].'\', \''.$_REQUEST['s_w_f'].'\', \''.$_REQUEST['advance'].'\', \''.$_REQUEST['leave_pay'].'\', \''.$_REQUEST['net_pay'].'\', \''.$_REQUEST['type'].'\')';
                                            insert_query($sql);
                                                }

                                            // -------------------
                                    
                                            ///edit code
                                            check_edit("ac_payroll_calculation","payroll_id");
                                            edit_display("ac_payroll_calculation","payroll_id");
                                            //end of edit code -shift view below delete

                                            // ---------------------
                                                
                                            if(isset($_REQUEST['deleteid']) && is_numeric($_REQUEST['deleteid'])){ $sql = 'DELETE FROM `ac_payroll_calculation` WHERE `ac_payroll_calculation`.`payroll_id` = '.$_REQUEST['deleteid'];

                                            insert_query($sql);
                                                    // echo "done deleting";
                                                    }
                                               // $sql = "SELECT * FROM `ac_annual_appraisal`";
                                            $sql = 'SELECT `payroll_id`"ID",`type`"Type", `gr_number`"Gr No.", `name`"Employee Name", `designation`"Designation", `attendance`"Attendance", `basic_salary`"Basic salary", `house_ra`"House R/A", `utility`"Utility", `convey_allow` "Convey Allow", `gross_salary`"Gross Salary", `loan` "Loan", `i_t`"IT", `s_w_f`"S.W.F", `advance`"Advance", `leave_pay`"Leave Pay" ,`net_pay`"Net pay" FROM `ac_payroll_calculation`';
                                            display_query($sql);

                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="content-page" id="formadd">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-5" style="text-align: center; font-size: 22px; padding: 10px"> Payroll calculation form </h4>
                                    <br>
                                    <form action="Accounts-mod-payoll-calculation.php#formadd" method="post" id="submitted2">
                                        <div class="form-group">
                                            <label for="">Type</label>
                                            <select id="settype" name="settype" required="" class="form-control" >
                                                <option <?php if (isset($_REQUEST['settype']) && $_REQUEST['settype']== "" ) echo "selected";  ?>  value="">-Select</option>
                                                <option <?php if (isset($_REQUEST['settype']) && $_REQUEST['settype']== "Staff" ) echo "selected";  ?>  value="Staff">Staff</option>
                                                <option <?php if (isset($_REQUEST['settype']) && $_REQUEST['settype']== "Teacher" ) echo "selected";  ?> value="Teacher">Teacher</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                                
                                            <button type="submit" class="btn btn-default waves-effect waves-light m-l-5">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

<?php if(isset($_REQUEST['settype'])){
    if( $_REQUEST['settype']=="Teacher"){

    $settype = $_REQUEST['settype'];
    echo '
                                    <form action="Accounts-mod-payoll-calculation.php#formadd" method="post" id="submitted">';
                                    if (isset($_REQUEST['settype']) ) echo '<input type="hidden" value="'.$_REQUEST['settype'].'" name="settype">';
                                        dropDownConditional2("Teacher ID","gr_number2","Teacher_records_id","name","ad_teacher_records",NULL);
                                        
                                   echo'<div class="form-group text-right m-b-0">
                                                
                                            <button type="submit" class="btn btn-default waves-effect waves-light m-l-5">
                                                Submit
                                            </button>
                                        </div>
                                   </form>';
                               }} ?>
<?php
if(isset($_REQUEST['gr_number2'])){
    if($_REQUEST['settype'] == "Teacher"){
    $conn = connect_db();
    $sql_s = 'SELECT `Teacher_records_id`, `user_id`, `user_date`, `name`, `cnic`, `position`, `office`, `age`, `start`, `salary`, `phone_number`, `address`, `comment` FROM `ad_teacher_records` WHERE  `Teacher_records_id` = '.$_REQUEST['gr_number2'].' ';
    $result = mysqli_query($conn,$sql_s);
    $row = mysqli_fetch_assoc($result);

    $value_id = $row['Teacher_records_id'];
    $value_name =  $row['name'];
    $value_salary =  $row['salary'];
    $value_position =  $row['position'];
}}
?>

<?php if(isset($_REQUEST['settype'])){
    if( $_REQUEST['settype']=="Staff"){

    $settype = $_REQUEST['settype'];
    echo '
                                    <form action="Accounts-mod-payoll-calculation.php#formadd" method="post" id="submitted">';
                                    if (isset($_REQUEST['settype']) ) echo '<input type="hidden" value="'.$_REQUEST['settype'].'" name="settype">';
                                        dropDownConditional2("Employee ID","gr_number2","employee_record_id","name","ad_employee_record",NULL);
                                        
                                   echo'<div class="form-group text-right m-b-0">
                                                
                                            <button type="submit" class="btn btn-default waves-effect waves-light m-l-5">
                                                Submit
                                            </button>
                                        </div>
                                   </form>';
                               }}?>
<?php
if(isset($_REQUEST['gr_number2'])){
    if( $settype == "Staff"){
    $conn = connect_db();
    $sql_s = 'SELECT `employee_record_id`, `user_id`, `user_date`, `name`, `gr_no`, `cnic`, `position`, `assigned_section`, `age`, `start`, `salary`, `phone_number`, `address`, `comment` FROM `ad_employee_record` WHERE  `employee_record_id` = '.$_REQUEST['gr_number2'].' ';
    $result = mysqli_query($conn,$sql_s);
    $row = mysqli_fetch_assoc($result);

    $value_id = $row['employee_record_id'];
    $value_name =  $row['name'];
    $value_salary =  $row['salary'];
    $value_position =  $row['position'];
}}
?>



                                        <form action="Accounts-mod-payoll-calculation.php" method="post">
                                            <input type="hidden" <?php if(isset($_REQUEST['settype']))echo 'value="'.$_REQUEST['settype'].'" readonly' ; else { if(isset($_REQUEST['type'])) echo "readonly value = ".$_REQUEST['type'];} ?> name="type">


                                            <div class="form-group">
                                                <label for="prID">Employee code  </label>
                                                <input type="text" name="gr_number" required="" placeholder="Enter employee code" class="form-control" id="prID" <?php if(isset($_REQUEST['gr_number2']))echo 'value="'.$value_id.'" readonly' ; else { if(isset($_REQUEST['gr_number'])) echo "readonly value = ".$_REQUEST['gr_number'];} ?>>
                                            </div>
                                        
                                   
                                            <div class="form-group">
                                                <label for="">Employee Name </label>
                                                <input type="text" name="name" required="" placeholder="Enter employee name" class="form-control" <?php if(isset($_REQUEST['gr_number2']))echo 'value="'.$value_name.'" readonly' ; else { if(isset($_REQUEST['name'])) echo "readonly value = ".$_REQUEST['name'];} ?>>
                                            </div>

                                            <div class="form-group">
                                                <label for="prRegular">Designation</label>
                                                <input type="text" name="designation" required="" placeholder="Enter designation" class="form-control" id="prRegular" <?php if(isset($_REQUEST['gr_number2']))echo 'value="'.$value_position.'" readonly' ; else { if(isset($_REQUEST['designation'])) echo "readonly value = ".$_REQUEST['designation'];} ?>>
                                            </div>

                                            <div class="form-group">
                                                <label for="prVacation">Attendance</label>
                                                <input type="number" name="attendance" parsley-trigger="change" required="" placeholder="Enter attendance" class="form-control" id="prVacation" data-parsley-id="6" value="<?php if(isset($_REQUEST['attendance'])) echo $_REQUEST['attendance'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prSick">Basic salary</label>
                                                <input type="number" name="basic_salary" required="" placeholder="Enter basic salary" class="form-control" id="prSick" <?php if(isset($_REQUEST['gr_number2']))echo 'value="'.$value_salary.'" readonly' ; else { if(isset($_REQUEST['basic_salary'])) echo "readonly value = ".$_REQUEST['basic_salary'];} ?> >
                                            </div>

                                            <div class="form-group">
                                                <label for="zaClass">House R/A </label>
                                                <input type="number" name="house_ra" required="" placeholder="Enter house R/A" class="form-control" id="prOvertime"  value="<?php if(isset($_REQUEST['house_ra'])) echo $_REQUEST['house_ra'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prGross">Utility</label>
                                                <input type="number" name="utility" required="" placeholder="Enter utility" class="form-control" id="prGross" value="<?php if(isset($_REQUEST['utility'])) echo $_REQUEST['utility'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prTaxes">Convey Allow </label>
                                                <input type="number" name="convey_allow" required="" placeholder="Enter convey allow" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['convey_allow'])) echo $_REQUEST['convey_allow'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prTaxes">Gross Salary</label>
                                                <input type="number" name="gross_salary" required="" placeholder="Enter gross salay" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['gross_salary'])) echo $_REQUEST['gross_salary'] ?>">
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-5"></div>
                                                <div class="col-lg-2">
                                                    <label>Deductions</label>
                                                </div>
                                                <div class="col-lg-5"></div>   
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="prTaxes">Loan</label>
                                                        <input type="number" name="loan" required="" placeholder="Enter loan" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['loan'])) echo $_REQUEST['loan'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="prTaxes">I.T</label>
                                                        <input type="number" name="i_t" required="" placeholder="Enter I.T" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['i_t'])) echo $_REQUEST['i_t'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="prTaxes">S.W.F</label>
                                                        <input type="number" name="s_w_f" required="" placeholder="Enter S.W.F" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['s_w_f'])) echo $_REQUEST['s_w_f'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="prTaxes">Advance</label>
                                                        <input type="number" name="advance"  required="" placeholder="Enter advance" class="form-control" id="prTaxes"  value="<?php if(isset($_REQUEST['advance'])) echo $_REQUEST['advance'] ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="prTaxes">Leave W/O pay</label>
                                                <input type="number" name="leave_pay" required="" placeholder="Enter leave W/O pay" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['leave_pay'])) echo $_REQUEST['leave_pay'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prTaxes">Net pay</label>
                                                <input type="number" name="net_pay" required="" placeholder="Enter net pay" class="form-control" id="prTaxes" value="<?php if(isset($_REQUEST['net_pay'])) echo $_REQUEST['net_pay'] ?>">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form end -->

                <!-- footer -->
                <?php 
                    include_once("footer.php")
                ?>
                   



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