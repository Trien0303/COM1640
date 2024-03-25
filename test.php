<?php
include_once("./connect.php");
session_start();
if (isset($_POST['signin'])) {
 
    // Lấy dữ liệu nhập vào và chống SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
 
    // Tìm kiếm người dùng theo tên đăng nhập
    $result = mysqli_query($conn, "SELECT username, password, roleId FROM users WHERE username='$username'");
 
    // Kiểm tra xem có người dùng với tên đăng nhập đã nhập không
    if (mysqli_num_rows($result) == 1) {
       $row = mysqli_fetch_assoc($result);
 
       // So sánh mật khẩu đã nhập với mật khẩu trong cơ sở dữ liệu
       if ($password === $row['password']) {
          // Đăng nhập thành công, thiết lập session và chuyển hướng người dùng
          echo "dô rồi con.";
 
          $userRole = $row["roleId"];
 
 
          if ($userRole == "1") {
             $_SESSION['username'] = $username;
             echo '<meta http-equiv="refresh" content="0;URL=./test1.php"/>';
          } else {
             $_SESSION['username'] = $username;
             echo '<meta http-equiv="refresh" content="0;URL=./admin/admin.php"/>';
          }
       } else {
          // Mật khẩu không khớp
          echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
       }
    } else {
       // Người dùng không tồn tại
       echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'><button>Ok</button></a>";
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>GREENWICH</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="#">
        <input type="hidden" name="signin" value="1">
        <h3>Login</h3>

        <label for="username">Username</label>
        <input name="username" type="text" placeholder="Enter UserName" id="username">

        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Enter Password" id="password">
        <button type="button" onclick="window.location.href='./Register.php'">REGISTER</button>
        <button type="submit" name="login">LOGIN</button>
    </form>
</body>
</html>