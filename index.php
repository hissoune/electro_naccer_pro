<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"></head>
</head>
<body>
<nav class="bg-primary d-flex justify-content-between p-3 ">
  <div class="d-flex mx-4 mt-1 ">
    
    <h5>Welcom! in electrolherba</h5>
  </div>
  <div class="mx-4">
    
    <img width="20 px " height="20px" class="mx-5"  src="logo.png" alt="">

  </div>

 </nav>
 <div class="tabs d-flex justify-content-end p-4">
        <button onclick="showSignUp()" class="btn bg-primary text-light mx-2">Sign Up</button>
        <button onclick="showSignIn()" class="btn bg-primary text-light">Sign In</button>
    </div>

    <div class="forms">
        <div id="signup" class="form-section">
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
                <button type="submit" class="btn bg-primary text-light"  onclick="showSinIn()">Sign Up</button>
            </form>
        </div>

        <div id="signin" class="form-section" style="display: none;">
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
$hostname = "localhost";
$username = "root";
$password = "";
$database = "Electro_naccer_pro";

$connection = new mysqli($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST['usernam'], $_POST['email_up'], $_POST['passwords'])){
  $username =$_POST['usernam'] ;
  $email_up = $_POST['email_up'];
  $pawwwords = $_POST['passwords'];

  $connection->query("INSERT INTO User (user_nam ,email , Passwords , is_admin,setuation) VALUES ( '$username' ,'$email_up', '$pawwwords', 0 , 0)");
  header("Location:modify_category.php");
  exit();
    
}





    if (isset($_POST['email_in'], $_POST['password'])) {
        $email_in = $_POST['email_in'];
        $password = $_POST['password'];

        
        $stmt = $connection->prepare("SELECT * FROM User WHERE email = ? AND Passwords = ?");
        $stmt->bind_param("ss", $email_in, $password); 
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows > 0) {
           
            $user = $result->fetch_assoc();

   
        if ($user['is_admin'] == 1 && $user['setuation']==1) {
           
            header("Location: dashpord.php");
            exit();
        } 
   
    else if ($user['is_admin'] == 0 && $user['setuation' ] == 1){
        header("Location: home.php");
        exit();
    }
    else {
        header("Location:modify_category.php");
        exit();
        }
    }
       
        $stmt->close();
    }
}

// Close the MySQL connection
$connection->close();
?>




<footer class="no-print bg-dark text-light">
        <div class="card mt-5 mb-4"></div>  
        <div class=" container tol MMM">
      <div class="row  FFF ">
      <div class=" col-lg-3  col-sm-4 col-6"><img class="w-50 " src="logo.png" alt=""></h5>
        <P class="w-50">Savor the artistry where every dish is a culinary masterpiece</P>
      
      </div>
      <div class="col-lg-3 col-sm-4 col-6">
          <h6 >Useful links</h6>
          <p>About us</p>
          <p>Events</p>
          <p>Blogs</p>
          <p>FAQ</p>
      </div>
      <div class="  col-lg-3 col-sm-4 col-6">
          <h6 >Main Menu</h6>
          <p>Home</p>
          <p>Menu</p>
          <p>Blogs</p>
          <p>Create</p>

      </div>
      <div class=" col-lg-3  col-sm-4 col-6">
          <h6 >Contact Us</h6>
          <p>wokstar@email.coms</p>
          <p>+64 958 248 966</p>
          <p>Social media</p>
       
      </div>
  </div>
  <div   class="row " >
      <div class="col-lg-5   ">
  
</div>
  <div class="col-lg-5 mt-4  col-12 "><p >Copyright   2023 Dscode | All rights reserved</p></div>
</div>
  </div> 
</footer>
    
</body>
</html>