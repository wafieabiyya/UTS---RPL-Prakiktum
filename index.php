<?php
session_start();
include 'assets/server/connection.php';

if (isset($_SESSION['logged_in'])) {
    header('location:dashboard.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['admin_email'];
    $password = ($_POST['admin_password']);

    $query = "SELECT admin_id, admin_name, admin_username, admin_phone, admin_email, admin_password
    FROM adm
    WHERE admin_email = ? AND admin_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result($admin_id, $admin_name, $admin_username, $admin_phone, $admin_email, $admin_password);
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_phone'] = $admin_phone;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_password'] = $admin_password;
            $_SESSION['logged_in'] = true;

            header('location:dashboard.php?message=Logged in successfully');
        } else {
            header('location:index.php?error=Could not verify your account');
        }
    } else {
        // Error
        header('location: index.php?error=Something went wrong!');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GooDang</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/4c7e0de464.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <!----------- START FORM lOGIN ------------------------ -->
            <div class="signIn-signUp">
                <form action="index.php" class="sign-in-form" method="POST">
                    <?php if (isset($_GET['error'])) ?>
                    <div role="alert">
                        <?php
                        if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        }
                        ?>
                    </div>
                    <h2 class="title">Sign In</h2>

                    <div class="input-field">
                        <i class="uil uil-user"></i>
                        <input type="email" placeholder="Email" name="admin_email" required>
                    </div>
                    <div class="input-field">
                        <i class="uil uil-lock"></i>
                        <input type="password" placeholder="Password" name="admin_password" required>
                    </div>
                    <button type="submit" class="btn solid" name="login_btn">Login</button>
                    <p class="social-text">
                        or sign in with
                    </p>
                    <div class="sosmed">
                        <a href="#" class="sosmed-icon"><i class="uil uil-instagram"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-twitter-alt"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-google"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-apple-alt"></i></a>
                    </div>
                </form>
                <!----------------------- END FORM lOGIN ------------------------ -->
                <!----------------------- START FORM Register ------------------------ -->
                <form class="sign-up-form" method="POST" action="action.php">
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="uil uil-user-plus"></i>
                        <input type="text" placeholder="Full Name" name="admin_name">
                    </div>
                    <div class="input-field">
                        <i class="uil uil-user"></i>
                        <input type="text" placeholder="User Name" name="admin_username">
                    </div>
                    <div class="input-field">
                        <i class="uil uil-phone-alt"></i>
                        <input type="text" placeholder="Phone Number" name="admin_phone">
                    </div>
                    <div class="input-field">
                        <i class="uil uil-envelope"></i>
                        <input type="email" placeholder="Email" name="admin_email">
                    </div>
                    <div class="input-field">
                        <i class="uil uil-lock"></i>
                        <input type="password" placeholder="Password" name="admin_password">
                    </div>
                    <button type="submit" class="btn">Register</button>
                    <p class="social-text">
                        or sign in with
                    </p>
                    <div class="sosmed">
                        <a href="#" class="sosmed-icon"><i class="uil uil-instagram"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-twitter-alt"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-google"></i></a>
                        <a href="#" class="sosmed-icon"><i class="uil uil-facebook-f"></i></a>
                    </div>
                </form>
                <!----------- END FORM Register ------------------------ -->
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New Here?</h3>
                    <p>You can create an account first to have access to the dashboard
                    </p>
                    <button class="btn transparant" id="sign-up-button" value="REGISTRASI">SIGN UP</button>
                </div>
                <img src="assets/img/gudang.svg" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>one of us?</h3>
                    <p>Please do sign In because your company need you
                    </p>
                    <button class="btn transparant" id="sign-in-button" value="SIGN IN">SIGN IN</button>
                </div>
                <img src="assets/img/Regis.svg" alt="" class="image">
            </div>
        </div>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="assets/javascript/app.js"></script>
</body>

</html>