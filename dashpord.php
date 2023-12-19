
<?php
 ob_start();
session_start();

if (!isset($_SESSION['email_in'])) {
    header('Location: index.php');
    exit(); 
}
include('conex.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>


<style>.nanimo:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease; 
        
    }</style>
<div style="background-color:rgb(53, 163, 163);" class="d-flex justify-content-around  p-3 container ">
<div class="w-100 ">
    <nav style=" background-color:aqua;" class="navbar navbar-expand-lg navbar-light bg-light flex-column w-100 ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNavbar"
        aria-controls="sidebarNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="sidebarNavbar">
        <ul class="navbar-nav ">
           
            <li class="nav-item">
                <a class="nav-link nanimo" href="dashpord.php">manage users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nanimo" href="MANGECAT.php">manage categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nanimo" href="manage_products.php">manage products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn bg-primary  text-light nanimo" href="log_out.php">log out</a>
            </li>
        </ul>
    </div>
</nav>


</div>
</div>
<div    class=" mt-5   rounded-2 w-100 p-5 container">
<h3 class="text-center">users</h3>
<table class="table rounded-2 w-100 ">
<thead class="bg-black text-light ">
    <tr class="table ">
        <th class="bg-black text-light " scope="col">ID</th>
        <th class="bg-black text-light " scope="col">Name</th>
        <th class="bg-black text-light " scope="col">Email</th>
        <th class="bg-black text-light " scope="col">admin</th>
        <th class="bg-black text-light " scope="col">situation</th>
        <th class="bg-black text-light " scope="col">delet/verifier</th>

    </tr>
</thead>

<tbody>
    <?php

    $sql = "SELECT * FROM User where is_admin = 0";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr class="justify-content-center">';
            echo "<td>" . $row["userid"] . "</td>";
            echo "<td>" . $row["user_nam"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["is_admin"] . "</td>";
            echo "<td>" . $row["setuation"] . "</td>";
            echo '<td>
                  <form method="POST" class="user-action-form">
                       <input type="hidden" name="userid" value="' . $row["userid"] . '">
                       <button type="submit" name="action" value="delete" class="btn bg-danger text-light nanimo">Delete</button>
                       <button type="submit" name="action" value="verify" class="btn bg-primary text-light nanimo">Verify</button>
                       <button type="submit" name="action" value="admin" class="btn bg-success text-light nanimo">admin</button>
                  </form>
                  </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No users found</td></tr>";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['action'])) {
            $userid = $_POST['userid'];

            if ($_POST['action'] === 'delete') {
                $delete_user = "DELETE FROM User WHERE userid = $userid";
                if ($connection->query($delete_user) === TRUE) {
                   
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error deleting user: " . $connection->error;
                }
            } elseif ($_POST['action'] === 'verify') {
                $update_user = "UPDATE User SET setuation = 1 WHERE userid = $userid";
                if ($connection->query($update_user) === TRUE) {
                  
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error verifying user: " . $connection->error;
                }
            } elseif ($_POST['action'] === 'admin') {
                $update_user = "UPDATE User SET is_admin = 1 WHERE userid = $userid";
                if ($connection->query($update_user) === TRUE) {
                  
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error verifying user: " . $connection->error;
                }
        }
        }}
    ?>
</tbody>

</table>
</div>

<div    class=" mt-5   rounded-2 w-100 p-5 container  adimn">

<h3 class="text-center">admins</h3>
<table class="table rounded-2 w-100 ">
<thead class="bg-black text-light ">
    <tr class="table ">
        <th class="bg-black text-light " scope="col">ID</th>
        <th class="bg-black text-light " scope="col">Name</th>
        <th class="bg-black text-light " scope="col">Email</th>
        <th class="bg-black text-light " scope="col">admin</th>
        <th class="bg-black text-light " scope="col">situation</th>
       
    </tr>
</thead>

<tbody>
    <?php
    
    $sql = "SELECT * FROM User where is_admin = 1";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr class="justify-content-center">';
            echo "<td>" . $row["userid"] . "</td>";
            echo "<td>" . $row["user_nam"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["is_admin"] . "</td>";
            echo "<td>" . $row["setuation"] . "</td>";
            
            echo "</tr>";}}
            ob_end_flush();

            ?>
            </tbody>

</table>
</div>
</body>
</html>