<?php 
    declare(strict_types = 1); 
    
    require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawLoginForm() { ?>
  <div class="frase">
            <p>Please enter your account!</p>
  </div>
  <form action="../actions/action_login.php" method="POST" class="login_register">
    <label>
      E-mail 
    </label>
    <input type="email" name="email"><br></br>
    <label>
      Password 
    </label>
    <input type="password" name="password"><br></br>

    <div class="button">
      <button type="submit">Login</button>
      <p class="center">Don't have an account?<a href="register.php" class="done"> Register</a></p>
    </div>
  </form>

<?php } ?>