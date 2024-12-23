<?php 
    session_start();
    include("../koneksi.php");
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = mysqli_query($konek,"select * from users where role='user' and user_id='$id'")or die (mysqli_error($konek));
        while($data=mysqli_fetch_array($query)){
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['fullname'] = $data['fullname'];
            $_SESSION['major'] = $data['major'];
            $_SESSION['university'] = $data['university'];
            $_SESSION['profile_picture'] = $data['profile_picture'];
        }
    }else{
        header("Location: ../user/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <title>Profile Pengguna</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background-color: #F9F9F9;
        }
        .navbar{
            background-color: #1E5B86;
        }
        .nav-link{
            color:white;
        }
        .profile-nav{
            border-radius: 20%;
            width: 50px;
            height: 38px;
        }
        p{
            color: #ADA7A7;
        }
        .img-top img{
            width: 100%;
            margin-bottom: 10px;
        }
        main{
            width: 90%;
        }
        .btn{
            background-color: #1E5B86;
        }
        .profile-img{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .name-email{
            margin-left: 20px;
        }
        .d-flex .profile-pict{
            width: 80px;
            height: 80px;
            border-radius: 100%;
        }
        .name-email{
            margin-top: 14px;
        }
        .form-section {
            display: flex;
            gap: 20px;
        }
        .form-section .left, .form-section .right {
            flex: 1;
        }
        .form-label {
            color: #555;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-primary px-3">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../search.php">Buy</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../uploads/uploaded.php">Sell</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../monetisasi.php">History</a>
            </li>
        </ul>
        <form class="d-flex" role="search" action="search.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <?php if($_SESSION['profile_picture'] != "") { ?>
                <div class="dropdown" style="width : 38px;">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                        <img class="profile-nav" src="../uploads/<?=$_SESSION['profile_picture']?>" alt="Profile Picture" style="width: 38px;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="user/logout.php">Logout</a></li>
                    </ul>
                </div>
                <?php } else { ?>
                <div class="dropdown" style="width : 38px;">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                        <img class="profile-nav" src="default.png" alt="Profile Picture" style="width: 38px;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="user/logout.php">Logout</a></li>
                    </ul>
                </div>
                <?php } ?>
            <a href="notifikasi.php" style="margin-left: 8px;"><img src="notif.png" alt="Notifikasi"></a>
            <a href="../cart.php" style="margin-left: 8px; padding:1px; background-color:white; border-radius:8px;"><img src="../cart (2).png" alt="Cart" style="height:36px"></a>
        </form>
        </div>
    </div>
    </nav>

    <main class="m-auto">
        <!-- <h5 class="mt-2">Welcome, <?=$_SESSION['name'];?></h5>
        <p>Tue, 29 Oct 2024</p> -->
        <div class="card my-4">
            <div class="img-top"><img src="img-top.png" alt=""></div>
            <div class="profile-img mx-4">
                <div class="d-flex">
                    <?php if($_SESSION['profile_picture'] != "") { ?>
                        <img class="profile-pict" src="../uploads/<?=$_SESSION['profile_picture']?>" alt="Profile Picture">
                    <?php } else { ?>
                        <img class="profile-pict" src="default.png" alt="Profile Picture">
                    <?php } ?>
                    <div class="name-email">
                        <h6><?=$_SESSION['name']?></h6>
                        <p><?=$_SESSION['email']?></p>
                    </div>
                </div>
                <a href="user-profile-edit.php"><button type="button" class="btn btn-primary" id="edit-button">Edit</button></a>
            </div>
            <div class="edit px-4 py-3">
                <form action="" method="GET" class="form-section" id="profile-form">
                    <div class="left">
                        <div class="mb-3">
                            <label for="full-name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full-name" placeholder="Your First Name" name="fullname" disabled value="<?= $_SESSION['fullname'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="major" class="form-label">Major</label>
                            <input type="text" class="form-control" id="major" placeholder="Your Major" name="major" required disabled value="<?= $_SESSION['major'] ?>">
                        </div>
                    </div>
                    <div class="right">
                        <div class="mb-3">
                            <label for="nick-name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="nick-name" placeholder="Your Username" name="username" required disabled value="<?= $_SESSION['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="university" class="form-label">University</label>
                            <input type="text" class="form-control" id="university" placeholder="Your University" name="university" required disabled value="<?= $_SESSION['university'] ?>">
                        </div>
                    </div>
                </form>
                <div class="history-section mt-2">
                    <p>My Histories</p>
                    <a href="../monetisasi.php"><button class="btn btn-primary">Histories</button></a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>