<?php
session_start();
require_once("include/constants.php");
//if (!isset($_SESSION["session_username"]) || $_SESSION["session_username"] != DB_GUEST_NAME)
//    $_SESSION["session_username"] = DB_GUEST_NAME;
require_once("include/connection.php");

if (isset($_POST["login"])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $today = date("Y-m-d");
        $query = mysqli_query($link, "SELECT * FROM usertbl WHERE email='" . $email . "' AND password='" . $password . "'");
        $numrows = mysqli_num_rows($query);

        if ($numrows != 0) {
            echo "User in database";

            while ($row = mysqli_fetch_assoc($query)) {
                $dbemail = $row['email'];
                $dbpassword = $row['password'];
                $dbusername = $row['username'];
            }

            if ($dbemail == $dbemail && $password == $dbpassword) {
                $_SESSION['session_username'] = $dbusername;
                $sql = "UPDATE `usertbl` SET `last_online_date` = '$today' WHERE `usertbl`.`username` = '$dbusername';";
                $result = mysqli_query($link, $sql);
                header("Location: Dashboard.php"); 
            }
        } else {
            $message = "Invalid email or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}
require_once("include/header.php");
?>

<div class="letschat_heading">
    <h1 style="font-family: 'Great Vibes', cursive;
      font-size: 30px;
      text-align: center;
      margin-top: 2em;">LetsChat</h1>
</div>

<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="emailInput">Email address</label>
                    <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email" required>
                    
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check1">
                    <label class="form-check-label" for="check1">Remember me</label>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
                <div class="alert alert-light align-left" role="alert">
                    No account? <a href="signup.php" class="alert-link">Register Now.</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include("include/footer.php");
?>