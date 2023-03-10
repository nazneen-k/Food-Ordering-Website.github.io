<?php 
include('../config/constants.php');

?>

<html>
 <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/login.css">

 </head>

    <body>
    
        <div class="outer-box">
            <div class="inner-box">
               <header class="sign-up">
                   <h1>Login</h1>
               </header>

               <?php
               if(isset($_SESSION['login']))
               {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
               } 

               if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);

               }
               ?>
               <br>

               <main class="signup-body">

                    <form action="" method="POST" class="text-center">
                      <p>  <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter username">
                        </p>
                        <p>
                    <label for="password">Password</label> 
                        <input type="text" name="password" placeholder="Enter Password">
                        </p>
                            <p>
                        <input type="submit" name="submit" value="Login" class="btn-primary">
                        </p>
                    </form>

                </main>


            <!-- <footer class="signup-footer"> -->
                <!-- <p> -->
                    <!-- Already have an Account? -->
                    <!-- <a href="#">Login</a> -->
                <!-- </p> -->
            <!-- </footer> -->


            </div>
        <div class="circle c1"></div>
        <div class="circle c2"></div>
        </div>
    </body>
</html>

<?php 


// Check whether the submit button is clicled or not
if(isset($_POST['submit']))
{
    // Process for login
    // 1.Get the data from login form
  $username = $_POST['username'];
   $password = md5($_POST['password']);

//    2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password= '$password'";

        // 3.Execute the Query
        $res = mysqli_query($conn,$sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User Available and Login Success
            $_SESSION['login'] = "<div class ='success'> Login Successfully.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            // Redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else{
            // User not Availabe and Login Failed
            $_SESSION['login'] = "<div class ='error text-center'>Username or password did not match.</div>";
            // Redirect to home page/dashboard
            header('location:'.SITEURL.'admin/login.php');
        }



}

?>