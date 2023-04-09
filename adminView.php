<?php
session_start();
include('assets/server/connection.php');

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM adm WHERE admin_id LIKE '%$keyword%' OR 
        admin_name LIKE '%$keyword%' OR admin_username LIKE '%$keyword%' OR admin_email LIKE '%$keyword%' ";
} else {
    $query = 'SELECT * FROM adm';
}

$result = mysqli_query($conn, $query);

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['admin_email']);
        header('location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View</title>

    <link rel="stylesheet" href="assets/css/dash.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png">
</head>

<body>

    <!-- -------------------- SIDEBAR START ------------------------->
    <section id="sidebar">
        <a href="#" class="logo"><img src="assets/img/logo2nobg 1.png" alt=""></a>
        <ul class="side-menu">
            <li><a href="dashboard.php"><i class="uil uil-create-dashboard icon"></i>Dashboard</a></li>
            <li class="divider">Main</li>
            <li><a href=""><i class="uil uil-user icon"></i>Admin</a></li>
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
                    <li><a href="editProfile.php?admin_id=<?php echo $_SESSION['admin_id'] ?>"><i class="uil uil-user"></i>Edit Profile</a></li>
                    <li><a href="dashboard.php?logout=1"><i class="uil uil-signin"></i>Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAV -->

        <!-- --------------------MAIN START ------------------------ -->
        <main>
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="dashboard.php">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Admin View</a></li>

            </ul>
            <div class="info-table">
                <div class="card">
                    <div class="head">
                        <h2><?php
                            $totalBarang = mysqli_query($conn, "SELECT COUNT(product_name) from products");
                            $row = mysqli_fetch_assoc($totalBarang);
                            $total = $row["COUNT(product_name)"];

                            echo $total
                            ?>
                        </h2>
                        <p>Jumlah Barang</p>
                    </div>
                </div>
                <div class="card">
                    <div class="head">
                        <h2><?php
                            $totalBarang = mysqli_query($conn, "SELECT SUM(product_quantity) from products");
                            $row = mysqli_fetch_assoc($totalBarang);
                            $total = $row["SUM(product_quantity)"];

                            echo $total
                            ?>
                        </h2>
                        <p>Total Quantity</p>
                    </div>
                </div>
                <div class="card">
                    <div class="head">
                        <h2> <?php
                                $totalAdmin = mysqli_query($conn, "SELECT COUNT(admin_name) FROM adm");
                                $row = mysqli_fetch_assoc($totalAdmin);
                                $total = $row["COUNT(admin_name)"];

                                echo $total
                                ?>
                        </h2>
                        <p>Jumlah Admin</p>
                    </div>
                </div>
            </div>
            <div class="table">
                <div class="table-header">
                    <p>Admin List</p>
                    <form action="" method="POST">
                        <div class="search">
                            <input type="text" name="keyword" class="input-search" placeholder="search...">
                            <button type="submit" name="cari"><i class="uil uil-search icon"></i></button>
                        </div>
                    </form>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc(($result))) { ?>
                                <tr>
                                    <td><?php echo $row['admin_id'] ?></td>
                                    <td><?php echo $row['admin_name'] ?></td>
                                    <td><?php echo $row['admin_username'] ?></td>
                                    <td><?php echo $row['admin_phone'] ?></td>
                                    <td><?php echo $row['admin_email'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- --------------------MAIN END ------------------------ -->

    </section>
    <!-- -------------------- NAVBAR END - -------------------------->
    <script src="assets/javascript/main.js"></script>
</body>

</html>