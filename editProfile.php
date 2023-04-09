<?php
    session_start();
    include('assets/server/connection.php');

    $idAdmin = $_GET['admin_id'];

    $query = "SELECT * FROM adm WHERE admin_id = '$idAdmin'";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
</head>

<body>
    <!-- -------------------- SIDEBAR START ------------------------->
    <section id="sidebar">
        <a href="dashboard.php" class="logo"><img src="assets/img/logo2nobg 1.png" alt=""></a>
        <ul class="side-menu">
            <li><a href="dashboard.php"><i class="uil uil-create-dashboard icon"></i>Dashboard</a></li>
            <li class="divider">Main</li>
            <li><a href="adminView.php"><i class="uil uil-user icon"></i>Admin</a></li>
            <li><a href="addProduct.php"><i class="uil uil-plus icon"></i>Add Product</a></li>
        </ul>

    </section>
    <!-- -------------------- SIDEBAR END --------------------------->

    <!-- -------------------- NAVBAR START -------------------------->
    <section id="content">
        <!-- NAV -->
        <nav>
            <i class="uil uil-bars toggle-sidebar"></i>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="keyword" id="" placeholder="Search">
                    <i class="uil uil-search icon"></i>
                </div>
            </form>
            <span> <?php echo $_SESSION['admin_name'];?> </span>
            <span class="divider"></span>
            <div class="profile">
                <img src="assets/img/about_wafie.jpeg" class="image" alt="">
                <ul class="profile-link">
                    <li><a href=""><i class="uil uil-user"></i> Profile</a></li>
                    <li><a href="dashboard.php?logout=1"><i class="uil uil-signin"></i>Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- NAV -->
        <main>
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="dashboard.php">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Edit Profile</a></li>
            </ul>
            <div class="container">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <form action="editActionProfile.php" method="POST">
                    <h2>Edit Profile</h2>
                    <div class="content">
                        <div class="input-fields">
                            <label for="">Admin ID</label>
                            <input type="text" name="admin_id" readonly value="<?php echo $row['admin_id']; ?> ">
                        </div>
                        <div class="input-fields">
                            <label for="">Full Name</label>
                            <input type="text" name="admin_name" value="<?php echo $row['admin_name']; ?>">
                        </div>
                        <div class="input-fields">
                            <label for="">Username</label>
                            <input type="text" name="admin_username" value="<?php echo $row['admin_username']; ?>">
                        </div>
                        <div class="input-fields">
                            <label for="">Phone</label>
                            <input type="number" name="admin_phone" value="<?php echo $row['admin_phone']; ?>">
                        </div>
                        <div class="input-fields">
                            <label for="">Email</label>
                            <input type="email" name="admin_email" value="<?php echo $row['admin_email']; ?>" >
                        </div>
                        <div class="input-fields">
                            <label for="">Passowrd</label>
                            <input type="text" name="admin_password" value="<?php echo $row['admin_password']; ?>" >
                        </div>
                        <div class="alert">
                            <div class="button-submit">
                                <button action="submit" type="submit" >Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endwhile; ?>
            </div>
        </main>
        <script src="assets/javascript/main.js"></script>
</body>

</html>