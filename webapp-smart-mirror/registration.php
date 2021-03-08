<?php
session_start();

include "config.php";
  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SM Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Smart Mirror</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="change_password.php">Change password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="confirm('Are you sure you want to Logout');" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a
                            >
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Upload
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="upload_image.php">Upload Image</a>

                                    <a class="nav-link" href="upload_text.php">Upload Text</a></nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts"
                                >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                View
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="view_image.php">view Image</a>

                                    <a class="nav-link" href="view_text.php">view Text</a></nav>
                            </div>


                            <div class="sb-sidenav-menu-heading">Addtional functions</div>
                            <a class="nav-link" href="registration.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Register</a
                            >
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php 
                            
                                echo $_SESSION['name'];

                            ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Register </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ol>
<!-- login -->
            <div class="bg-primary">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="username">User Name</label>

                                                        <input class="form-control py-4" id="username" name="username" type="text" placeholder="Enter User name" /></div>
                                                </div>
                                            <div class="form-group"><label class="small mb-1" for="email">Email</label>
                                                
                                                <input class="form-control py-4" name="email" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /></div>
                                            

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="password_1">Password</label>

                                                        <input class="form-control py-4" name="password_1" id="password_1" type="password" placeholder="Enter password" /></div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="password_2">Confirm Password</label><input class="form-control py-4" name="password_2" id="password_2" type="password" placeholder="Confirm password" /></div>
                                                </div>

                                                <div class="form-group">
                                              <label for="type">Select type:</label>
                                                <select class="form-control" id="type" name="type">
                                                    <option value="super">super</option>
                                                    <option value="admin">admin</option>
                                                    </select>
                                                    </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" value="submit" id="submit" name="submit">Create Account</button></div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br>
                        </div>
                    </div>
                </main>
            </div>

            <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Existing users</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>User name</th>
                                                <th>Email Id</th>
                                                <th>Type</th>
                                                <th>Delete</th>
                                                <th>change</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sno</th>
                                                <th>User name</th>
                                                <th>Email Id</th>
                                                <th>Type</th>
                                                <th>Delete</th>
                                                <th>change</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>


<?php 


$sql="SELECT * From users ORDER BY id DESC";
$result = mysqli_query($con, $sql);
 
$i=1;
while ($row=mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$i."</td>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['type']."</td>";

        
    ?>
    <td height="50px" ><form method="post" ><button onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-primary" id="delete" name="delete" value="<?php echo $row['id']; ?>">Delete</button></form></td>

    <td>
        <form method="post" action="#">
<div>
<select class="form-control" id="priority" name="priority">
                                                     <option value="super">super</option>
                                                    <option value="admin">admin</option>
                                                    </select>
      </div> 
      <br>                                             
    <button onclick="return confirm('Are you sure you want to change priority this item?');" id="change" name="change" class="btn btn-primary" value="<?php echo $row['id']; ?>">Change</button>

    </form>


    </td>


    </tr>



    <?php
$i++;
}

 ?>

 </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; AEC IT 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>






<?php 
if($_SESSION['type']=='super'){
    if(isset($_POST['submit'])){
        $uname=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password_1'];
        $type=$_POST['type'];
        $result = mysqli_query($con,"select * from users where email ='$email'");
    $row= mysqli_fetch_array($result);
    if(!$row){
        
        if($_POST['password_1']==$_POST['password_2']){

                $insert="INSERT INTO `users` (`username`,`email`,`password`,`type`) VALUES ('$uname','$email','$password','$type')";
                $res = mysqli_query($con, $insert);

                if($res){
                    echo "<script>alert('New user created successfully')</script>";
                   
                }
                else{
                    echo "<script>alert('Not success')</script>";
                    
                }




            }else{

            echo "<script>alert('password does not match') </script>";
            }


    }else{
        echo "<script>alert('Email already exists') </script>";
        }
    }


}else{

    echo "<script>alert('permission Denied') </script>";
    echo "<script>location.href='dashboard.php'</script>";
}






if (isset($_POST['delete'])) {
    
    
    $sql="DELETE From users Where id='".$_POST['delete']."' ";
    $result = mysqli_query($con, $sql);
        if ($result) {
        echo "<script>alert('Deleted successfully');location.href=''</script>";
}else{
    echo "<script>alert('Something Went Wrong') </script>";

}

}


if(isset($_POST['change'])){



$sql = "UPDATE `users` SET `type` = '".$_POST['priority']."' WHERE `users`.`id` = ".$_POST['change']."";
$result = mysqli_query($con, $sql);
        if ($result) {
        echo "<script>alert('Changed successfully');location.href=''</script>";
}else{
    echo "<script>alert('Something Went Wrong') </script>";

}

}

?>