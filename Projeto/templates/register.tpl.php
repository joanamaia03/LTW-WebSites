<?php 
    declare(strict_types = 1); 
    
    require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawRegisterForm(Session $session) { ?>
    <div class="frase">
        <p>Create your account!</p>
    </div>
    
    <form action="../actions/action_register.php" method="POST" class="login_register">
        <label>
            Name 
        </label>
        <input type="text" id="name" name="name"><br>
        <label>
            Username 
        </label>
        <input type="text" id="username" name="username"><br>
        <label>
            E-mail 
        </label>
        <input type="email" id="email" name="email"><br>
        <label>
            Password 
        </label>
        <input type="password" id="password" name="password"><br>
        
        <label>Role</label>
            <select id="role" name="role">
                <option value="client">Client</option>
                <option value="agent">Agent</option>
                <option value="admin">Admin</option>
            </select>

        <div class="button">
            <button type="submit">Register</button>
            <p class="center">Already have an account?<a href="login.php" class="done"> Login</a></p>
        </div> 
    </form>
    
<?php } ?>
