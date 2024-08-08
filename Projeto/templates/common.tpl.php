<?php
    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');

	$requestUri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

?>


<?php function drawLoggedIn(Session $session) { ?>
	<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/profile.php') !== false) ? 'class="active"' : ''; ?> href="../pages/profile.php"><i class="fa-sharp fa-solid fa-user"></i> Profile </a>
	<a href="../pages/index.php" id="logoutLink">Logout</a>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var logoutLink = document.getElementById('logoutLink');
			if (logoutLink) {
			logoutLink.addEventListener('click', function(event) {
				event.preventDefault();
				document.getElementById('logoutForm').submit();
			});
			}
		});
	</script>


	<form id="logoutForm" action="../actions/action_logout.php" method="POST" class="logout"> </form>
	

<?php } ?>

<?php function drawLoggedOut(Session $session) { ?>
	<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/register.php') !== false) ? 'class="active"' : ''; ?> href="../pages/register.php"> Register </a>
	<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/login.php') !== false) ? 'class="active"' : ''; ?> href="../pages/login.php"> Login </a>
	
<?php } ?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">  
    <head>
	    <title>Loving and Learning: Your Guide to Healthy, Happy Relationships</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/style.css">
		<script src="https://kit.fontawesome.com/4c23b4e371.js" crossorigin="anonymous"></script>
		<link href="https://fonts.google.com/" rel="stylesheet">
    </head>
    <body>
	    <header>
		
			<div class="navbar">
				<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/index.php') !== false) ? 'class="active"' : ''; ?> href="../pages/index.php"><i class="fa-sharp fa-solid fa-house"></i> Home </a>
				<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/aboutUs.php') !== false) ? 'class="active"' : ''; ?> href="../pages/aboutUs.php"><i class="fa-sharp fa-solid fa-envelope"></i> About Us </a>
				<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/tickets.php') !== false) ? 'class="active"' : ''; ?> href="../pages/tickets.php"><i class="fa-sharp fa-solid fa-lightbulb"></i> Tickets </a>
				<a <?php echo (strpos($_SERVER['REQUEST_URI'], '/pages/faq.php') !== false) ? 'class="active"' : ''; ?> href="../pages/faq.php"><i class="fa-sharp fa-solid fa-question"></i> FAQ </a>
				<input type="text" placeholder="Search..">
				<?php 
					if ($session->isLoggedIn()) drawLoggedIn($session);
					else drawLoggedOut($session);
				?>
			</div>
	    </header>


		
		<section id="messages">
		<?php foreach ($session->getMessages() as $message) { ?>
			<article class="<?=$message['type']?>">
			<?=$message['text']?>
			</article>
		<?php } ?>
		</section>
    <main>
<?php } ?>

<?php function drawLogo() {?>
	<center>
        <img src="/../docs/Group 1.png" class="Logo">
    </center>  
<?php } ?>
	   

<?php function drawFooter() { ?>
    <footer>
	    <p>&copy Loving and Learning</p>
    </footer>
<?php } ?>
