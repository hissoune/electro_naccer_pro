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
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "Electro_naccer_pro";

$connection = new mysqli($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
<div style="background-color:rgb(53, 163, 163);" class="d-flex justify-content-around  p-3  ">
<a href="dashpord.php" class="btn bg-primary text-light">back</a>
    <h4 class="text-light">manage your USERS</h4>
</div>
<div    class=" mt-5   rounded-2 w-100 p-5">
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
                       <button type="submit" name="action" value="delete" class="btn bg-danger text-light">Delete</button>
                       <button type="submit" name="action" value="verify" class="btn bg-primary text-light">Verify</button>
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
            }
        }
    }
    ?>
</tbody>

</table>
</div>
</body>
</html>