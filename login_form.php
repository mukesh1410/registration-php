<?php
include("./config.php");
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'"; 

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
       $row = mysqli_fetch_assoc($result);

       if(isset($row['user_type']) && $row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
       } elseif(isset($row['user_type']) && $row['user_type'] == 'user'){    
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
       }
    } else {
        $error[] = 'incorrect email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="POST" action="">
            <h3>login now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register_form.php">register now</a></p>
        </form>
    </div>
</body>
</html>
