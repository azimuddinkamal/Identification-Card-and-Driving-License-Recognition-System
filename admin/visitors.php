<?php
require_once "../config/config.php";

//Initialize the session
session_start();


//Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration System</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Visitors -->
            <li class="nav-item active">
                <a class="nav-link" href="visitors.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Visitors</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="../menu.php">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Scan In/ Scan Out</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                                <img class="img-profile rounded-circle" src="https://www.pinclipart.com/picdir/big/193-1937872_contacts-icon-admin-icon-png-white-clipart.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Visitors</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="export"><i class="fas fa-download fa-sm text-white-50"></i> Export Table</a>  
                    </div>
                    <p class="mb-4">This is the list of visitors of this system.</p>
                  
                    
                    <!--TABLE IS HEREE -->
                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Visitors</h6>
                        </div>
                        <div class="card-body">

                        
                                <div style="margin-bottom: 1.75%;"> 
                                    <div style="float: right;">
                                        <button type="button" name="add" id="addvisitorrecord" class="btn btn-outline-primary btn-sm">Add Visitor</button>
                                    </div>
                                </div>
                    
                        
                            <div class="table-responsive">
                                <table class="table table-bordered" id="visitorTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>IC Number</th>
                                            <th>Person in Charge</th>
                                            <th>Purpose</th>
                                            <th>Check In Time</th>
                                            <th>Check In Date</th>
											<th>Check Out Time</th>
                                            <th>Check Out Date</th>
											<th>Edit / Delete</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                
					<!-- Edit Modal -->
					<div id="recordModal" class="modal fade">
						<div class="modal-dialog">
							<form method="post" id="recordForm">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Add Record</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="name" class="control-label">Name</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>			
										</div>
										<div class="form-group">
											<label for="ic_no" class="control-label">IC Number</label>							
											<input type="number" class="form-control" id="ic_no" name="ic_no" placeholder="IC Number" required>							
										</div>	   	
										<div class="form-group">

                                            <label for="lastname" class="control-label">Person in Charge</label>							
                                                <!--input type="text" class="form-control" id="pic" name="pic" placeholder="Person in Charge" required-->
                                            <select id="pic" class="form-control" name="pic">
                                            
                                                <?php
                                                    $sql = "select username from users";

                                                    $result = mysqli_query($link, $sql) or die (mysqli_error());
                                            
                                                    if ($result){
                                            
                                                        
                                                        echo '<option value="" selected="selected">Select Person in Charge</option>';
                                                        while ($row = mysqli_fetch_array ($result)){
                                                            echo '<option value="'.$row['username'].'">'. $row['username'].'</option>';
                                                             
                                            
                                                        }
                                                    }else{
                                                        echo '<option value="" selected="selected">Select Person in Charge</option>';
                                                    }
                                                ?>
                                            </select>

										</div>	 
										<div class="form-group">
											<label for="purpose" class="control-label">Purpose</label>
											<input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose">							
										</div>
										<div class="form-group">
											<label for="lastname" class="control-label">Check In Time</label>							
											<input type="time" class="form-control" id="checkintime" name="checkintime" placeholder="Check In Date and Time" required>			
										</div>
										<div class="form-group">
											<label for="lastname" class="control-label">Check In Date</label>							
											<input type="date" class="form-control" id="checkindate" name="checkindate" placeholder="Check In Date and Time" required>			
										</div>
										<div class="form-group">
											<label for="lastname" class="control-label">Check Out Time</label>							
											<input type="time" class="form-control" id="checkouttime" name="checkouttime" placeholder="Check Out Date and Time" required>			
										</div>
										<div class="form-group">
											<label for="lastname" class="control-label">Check Out Date</label>							
											<input type="date" class="form-control" id="checkoutdate" name="checkoutdate" placeholder="Check Out Date and Time" required>			
										</div>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="id" id="id"/>
										<input type="hidden" name="ajaxcall" id="action" value=""/>
										<input type="submit" name="save" id="save" class="btn btn-info" value="Save"/>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Registration System 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/visitor.js"></script>

</body>

</html>
