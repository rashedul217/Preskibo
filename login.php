<head>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="align">

  <div class="grid">

  	<p class="text--center" style="color: #28ceff; font-size: 38px;">Login<br></p>
	<?php
    require('db.php');
    session_start();
    
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        $query    = "SELECT * FROM `doctors` WHERE username='$username'AND Password='$password'";

        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $res= mysqli_fetch_assoc($result);



        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $res['Full_Name'];
            $_SESSION['doctor_id']= $res['ID'];
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3 class='text--center'>Incorrect Username/password.</h3><br/>
                  <p class='link text--center'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form action="" method="POST" class="form login">

      <div class="form__field">
        <label for="login__username">
          <i class="fas fa-user icon"></i>
          <span class="hidden">Username</span></label>
        <input autocomplete="username" id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>
      </div>

      <div class="form__field">
        <label for="login__password">
          <i class="fas fa-lock icon"></i>
          <span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
      </div>

      <div class="form__field">
        <input type="submit" value="Sign In" name="submit">
      </div>
      	<p class="text--center">Not A Member? <br><a href="signup.php">Sign up now</a></p>

    </form>



    <?php
    }
?>

    
  </div>

</body>