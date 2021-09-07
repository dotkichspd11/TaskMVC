<?php
// Include config file
require_once './MVC/Models/config.php';
// Define variables and initialize with empty values
$checkSuccess = false;
$email = $password = $confirm_password = $fullname = "";
$email_err = $password_err = $confirm_password_err = $fullname_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // $validate_pass = preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password);

    
   
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Vui lòng nhập tên tài khoản.";
    } else{
        // Prepare a select statement
        $conn = new DB();
        $con = $conn->connect();
        $sql = "SELECT id FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Email đã tồn tại.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Có gì đó không đúng. Vui lòng thử lại.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate firstname
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Vui lòng nhập tên của bạn.";     
    } else{
        $fullname = trim($_POST["fullname"]);
    }

    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $password_err = "Vui lòng nhập mật khẩu.";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $password_err = "Mật khẩu phải có ít nhất 6 kí tự.";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Vui lòng nhập lại mật khẩu.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Mật khẩu nhập lại không đúng.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (fullname, email, pass) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_password,$param_fullname);
            
            // Set parameters
           
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fullname = $fullname;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo true;
            } else{
                echo false;
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($con);
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

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src='https://www.google.com/recaptcha/api.js'></script>


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản mới!</h1>
                            </div>
                            <form class="user" name="form" onsubmit="return submitRegister(event)"
                                action="" method="post">
                                
                                <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" class="form-control form-control-user" id="exampleInputFullname"
                                        placeholder="Fullname" name="fullname" value="<?php echo $fullname; ?>">
                                    <span class="help-block"><?php echo $fullname_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email" name="email" value="<?php echo $email; ?>">
                                    <span class="help-block"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group row <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Mật khẩu" name="pass"
                                            value="<?php echo $password; ?>">
                                        <span class="help-block"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu"
                                            name="confirm_password" value="<?php echo $confirm_password; ?>">
                                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                    </div>
                                    
                                </div>
                                <!-- <p id="error"></p>
                                <p id="success"></p> -->

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng ký">

                                </div>
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Đăng ký với Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Đăng ký với Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Đã có tài khoản? Đăng nhập ngay!</a>
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
    function submitRegister(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(e.target);
        
        var url = form.attr('action');
       
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                
                if (data == '1') {
                    swal({
                        title: "Đăng ký thành công!",
                        text: "Click 'OK' để chuyển tới trang đăng nhập!",
                        type: "success"
                    }, function() {
                        window.location.replace("login.php");
                    });
                }
            }
        });
    }
    </script>

</body>

</html>