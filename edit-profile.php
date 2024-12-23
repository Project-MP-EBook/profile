<?php 
    include("../koneksi.php");
    if(isset($_GET['fullname'])){
        $fullname = $_GET['fullname'];
        $name = $_GET['username'];
        $major = $_GET['major'];
        $university = $_GET['university'];

        $query = mysqli_query($konek,"UPDATE users SET fullname='$fullname',name='$name',major='$major',university='$university' WHERE user_id='$id'")or die (mysqli_error($konek));

        // Refresh halaman untuk menampilkan data yang telah diperbarui
        header("Location: user-profile.php");
        exit;
    }
?>