


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>electro naccer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"></head>
</head>
<body class="bg-">
<nav class="bg-primary d-flex justify-content-between p-3 ">
  <div class="d-flex mx-4 mt-1 ">
    
    <h5>Welcom! in electrolherba</h5>
  </div>
  <div class="mx-4">
    
    <img width="20 px " height="20px" class="mx-5"  src="logo.png" alt="">

  </div>

 </nav>
 <div class="tabs d-flex justify-content-center p-4 container">
        <button onclick="showSignUp()" class="btn bg-primary text-light mx-2">Sign Up</button>
        <button onclick="showSignIn()" class="btn bg-primary text-light">Sign In</button>
    </div>

    <div class="forms container justify-content-center">
        <div id="signup" class="form-section container justify-content-center mx-5">
            <!-- Sign-up form -->
            <form  method="POST">
                <div class="form-group mb-3 w-75 mx-5">
                    <label for="signup-name">name</label>
                    <input type="txt" name="usernam" class="form-control" id="signup-name" placeholder="Enter username">
                </div>
                <div class="form-group mb-3 w-75 mx-5">
                    <label for="signup-password">email</label>
                    <input type="email" name="email_up" class="form-control" id="signup-email" placeholder="email">
                </div>
                <div class="form-group mb-3 w-75 mx-5">
                    <label for="signup-password">Password</label>
                    <input type="password" name="passwords" class="form-control" id="signup-password" placeholder="Password">
                </div>
                <button type="submit" class="btn bg-primary text-light mx-5"  onclick="showSinIn()">Sign Up</button>
            </form>
        </div>

        <div id="signin" class="form-section container justify-content-center mx-4" style="display: none;">
            <!-- Sign-in form -->
            <form  method="POST">
                <div class="form-group mb-3 w-75 mx-5">
                    <label for="signin-identifient">email</label>
                    <input type="email" name="email_in" class="form-control" id="signin-identifient" placeholder="Enter email">
                </div>
                <div class="form-group mb-3 w-75 mx-5">
                    <label for="signin-password">Password</label>
                    <input type="password" name="password" class="form-control" id="signin-password" placeholder="Password">
                </div>
                <button type="submit" class="btn bg-primary text-light">Sign In</button>
            </form>
        </div>
    </div>

    <script>
        function showSignUp() {
            document.getElementById("signup").style.display = "block";
            document.getElementById("signin").style.display = "none";
        }

        function showSignIn() {
            document.getElementById("signup").style.display = "none";
            document.getElementById("signin").style.display = "block";
        }
        
    </script>
<?php
session_start();
include('conex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['usernam'], $_POST['email_up'], $_POST['passwords'])) {
        // Sign-up form handling
        $username = $_POST['usernam'];
        $email_up = $_POST['email_up'];
        $password = $_POST['passwords'];
        
        echo '<script>alert("sign up success !!   wait for validation!!!")</script>';
        
        $stmt = $connection->prepare("INSERT INTO User (user_nam, email, Passwords, is_admin, setuation) VALUES (?, ?, ?, 0, 0)");
        $stmt->bind_param("sss", $username, $email_up, $password);
        $stmt->execute();
        
        // Close the statement
        $stmt->close();
    } elseif (isset($_POST['email_in'], $_POST['password'])) {
        // Sign-in form handling
        $email_in = $_POST['email_in'];
        $password = $_POST['password'];

        $stmt = $connection->prepare("SELECT * FROM User WHERE email = ? AND Passwords = ?");
        $stmt->bind_param("ss", $email_in, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        echo'<script>alert('.$result->num_rows.')';
        if ($result->num_rows > 0) {
           
            $user = $result->fetch_assoc();

            if ($user['is_admin'] == 1 && $user['setuation'] == 1) {
                $_SESSION['email_in'] = $email_in;
                header("Location: dashpord.php");
                exit();
            } elseif ($user['is_admin'] == 0 && $user['setuation'] == 1) {
                $_SESSION['email_in'] = $email_in;
                header("Location: home.php");
                exit();
            } else if ($user['is_admin'] == 0 && $user['setuation'] == 0){
                $_SESSION['email_in'] = $email_in;
                header("Location: modify_category.php");
                exit();
            }
        } else {
            // Handle invalid login here (for example, show an error message)
            echo '<script>alert("Invalid email or password!")</script>';
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the MySQL connection
$connection->close();
?>






    
</body>
</html>