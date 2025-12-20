<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
      <style>
                html,
        body {
            width: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .image-login {
            width: 60%;
            background: url('../../assets/images/login.jpg') center/cover;
        }

        .login-section {
            width: 40%;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
        }

        .login-form label {
            color: black;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .login-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            margin-top: 5px;
            background: #ffffffff;
             border: 1px solid #999;
            border-radius: 6px;
            color: black;
            font-size: 14px;
        }

        .login-form input::placeholder {
            color: #999;
        }

        .login-form button {
            width: 100%;
            padding: 12px;
            background: white;
            border: 2px solid black;
            color: black;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-form button:hover {
            background: black;
            color:white;
        }

        .error-message {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        @media (max-width: 728px) {
            .image-login {
                display: none;
            }

            .login-section {
                width: 100%;
            }
        }
      </style>
</head>
<body>
    <?php 
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        // Cek Input ke database apakah sudah sesuai atau belum dengan data yg ada
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM users WHERE email ='$input'";
        } else {
            $query = "SELECT * FROM users WHERE username ='$input'";
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                // arahkan ke admin
                header("Location: dashboard.php");
                exit();
            }
            else {
                echo "<p style='color: red'> Password Salah</p>";
            }
        }
        else{
            echo "<p style='color: red'> Username/email tidak sesuai</p>";
        }
    }
    ?>
<main class="login-container">
    <div class="image-login"></div>
    <section class="login-section">
        <form class="login-form" method="post" action="">

        <h2>Masuk Sebagai Admin</h2>
            <label>Username atau Email</label> <br> 
            <input type="text" name="username" placeholder="Masukkan Username Email" required> <br>
            
            <label>Password</label> <br>
            <input type="password" name="password" placeholder="Masukkan Password" required> <br>
        <br>
        
        <button type="submit" name="login">Login</button>
    </form>
</section>
</main>
</body>
</html>