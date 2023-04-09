<?php
session_start();
include('assets/server/connection.php');

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM products WHERE id_product LIKE '%$keyword%' OR 
        product_name LIKE '%$keyword%' OR product_category LIKE '%$keyword%' OR product_description LIKE '%$keyword%' ";
} else {
    $query = 'SELECT * FROM products';
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

$kurs_dollar = 14940;

function setRupiah($price)
{
    $result = "Rp" . number_format($price, 0, ',', '.');
    return $result;
}
?>

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
                    <p>Products Table</p>
                    <form action="" method="POST">
                        <div class="search">
                            <input type="text" name="keyword" class="input-search" placeholder="search...">
                            <button type="submit" name="cari"><i class="uil uil-search icon"></i></button>
                        </div>
                    </form>

                </div>
                <div class="table-section">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc(($result))) { ?>
                                <tr>
                                    <td><?php echo $row['id_product'] ?></td>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td><?php echo $row['product_description'] ?></td>
                                    <td><?php echo $row['product_category'] ?></td>
                                    <td><?php echo $row['product_quantity'] ?></td>
                                    <td><?php echo setRupiah(($row ['product_price'] * $kurs_dollar ))?></td>
                                    <td>
                                        <a class="bx bx-edit" href="editProduct.php?id_product=<?php echo $row['id_product']; ?>" role="button" onclick="return confirm ('Are you sure want to edit this data?')">
                                        
                                        </a>
                                        <a class="bx bx-trash" href="deleteAction.php?id_product=<?php echo $row['id_product']; ?>" role="button" onclick="return confirm('Are you sure want to delete this data?')">
                                        
                                        </a>
                                    </td>
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