<?php
    include("../connect.php");
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];




    // isAdmin: 1=admin 0=user

	$strSQL = "SELECT * FROM `user_water` WHERE `email_user`='$email' AND `password_user`='$password'";
    $result = mysqli_query($conn, $strSQL);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $_SESSION["id_user"] = $row['id_user'];
            $_SESSION["email_user"] = $row['email_user'];
            $_SESSION["status_user"] = $row['status'];
            $_SESSION["id_session"] = session_id();
        }
        // echo $id_session."<br>";
        // echo $_SESSION["id_user"]."<br>";
        // echo $_SESSION["email_user"]."<br>";
	    // echo $_SESSION["status_user"]."<br>";
        // echo $id_session."<br>";
        session_write_close();
        header("location:../index.php");
    }else {
      echo ("<script language='JavaScript'>
                window.alert('อีเมลหรือรหัสผ่าน ไม่ถูกต้อง');
                window.location.href='../login.php';
             </script>");
    }



 ?>
