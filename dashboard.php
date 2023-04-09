<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/css/dash.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>

<body>

    <!-- -------------------- SIDEBAR START ------------------------->
    <section id="sidebar">
        <a href="#" class="logo"><img src="assets/img/logo2nobg 1.png" alt=""></a>
        <ul class="side-menu">
            <li><a href=""><i class="uil uil-create-dashboard icon"></i>Dashboard</a></li>
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
            <span> <?php echo $_SESSION['admin_name'] ?></span>
            <span class="divider"></span>
            <div class="profile">
                <img src="assets/img/about_wafie.jpeg" class="image" alt="">
                <ul class="profile-link">
                    <li><a href="editProfile.php?admin_id=<?php echo $_SESSION['admin_id'] ?>"><i class="uil uil-user"></i> Edit Profile</a></li>
                    <li><a href="dashboard.php?logout=1"><i class="uil uil-signin"></i>Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAV -->

        <!-- --------------------MAIN START ------------------------ -->
        
        <main style="background-color: #f1f0f6">
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Dashboard</a></li>

            </ul>
        </main>
        <!-- --------------------MAIN END ------------------------ -->

    </section>
    <!-- -------------------- NAVBAR END - -------------------------->
    <script src="assets/javascript/main.js"></script>
</body>

</html>