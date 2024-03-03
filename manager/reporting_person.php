<html>
<head>
    
    <meta charset="utf-8">
    <title>CPSTL Leave System</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/CPSTLapple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/CPSTLfavicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/CPSTLfavicon-16x16.png">

   
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  


    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="../assets/css/jquery.signature.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
</head>

<?php include('../includes/config.php'); ?>
<?php include('../includes/session.php');?>

<?php
if(isset($_POST["submit"])){
    if(isset($_POST["emp"]) && isset($_POST["r_person"])) {
        $emp = $_POST["emp"];
        $r_person = $_POST["r_person"];

        // Check if the selected employee exists in the tblemployees table
        $check_query = "SELECT * FROM tblemployees WHERE emp_id = $emp";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // If the employee exists, update the corresponding row with reporting person's ID
            $update_query = "UPDATE tblemployees SET reporting_person_id = $r_person WHERE emp_id = $emp";
            mysqli_query($conn, $update_query);
            echo "Reporting person added successfully.";
        } else {
            echo "Selected employee does not exist.";
        }
    } else {
        echo "Please select both an employee and a reporting person.";
    }
}
?>


<body>

    
    <?php include('includes/navbar.php')?>

    <?php include('includes/left_sidebar.php')?>

  
    <div class="mobile-menu-overlay"></div>

    <div class="main-container"style="background-color:#FEF7F0;">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Add Reporting Person</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Reporting Person</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 </div>
                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Add</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">
                            <section>

                                <?php if ($role_id = 'Staff'): ?>
                                <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error($conn));
                                    $row = mysqli_fetch_array($query);
                                ?>                             
                                <?php endif ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Employee :</label>
                                            <select name="emp" id="emp" class="custom-select form-control" required="true" autocomplete="off">
                                                <option value="">Select Employee Id...</option>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT emp_id FROM tblemployees");
                                                while ($c = mysqli_fetch_array($sql)) {
                                                    echo "<option value='" . $c['emp_id'] . "'>" . $c['emp_id'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Reporting Person :</label>
                                            <select name="r_person" id="r_person" class="custom-select form-control" required="true" autocomplete="off">
                                                <option value="" > Select Reporting Person...</option>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT DISTINCT reporting_person_id FROM tblemployees WHERE reporting_person_id != 0 ORDER BY reporting_person_id ASC");
                                                while ($c = mysqli_fetch_array($sql)) {
                                                    echo "<option value='" . $c['reporting_person_id'] . "'>" . $c['reporting_person_id'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button type="submit" class="btn btn-primary" name="submit" id="submit" data-toggle="modal" style="margin-left: 560%;">Add</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
  
</body>
</html>