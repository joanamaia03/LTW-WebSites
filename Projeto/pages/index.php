<?php

	declare(strict_types=1);

	require_once('../database/connection.db.php');
	require_once(__DIR__ . '/../utils/session.php');
	$session = new Session();

	$db = getDatabaseConnection();
		

	require_once(__DIR__ . '/../templates/common.tpl.php');

	drawHeader($session);
	drawLogo();

	// Used just to check all users/debugging

	$stmt = $db->prepare('SELECT * FROM USER');
	$stmt->execute();
	$users = $stmt->fetchAll();

	echo '<h1> Users </h1>';
?>
	<div id="menu">
		<?php
			foreach( $users as $user) {
				echo '<h2>' . $user['name'] . '</h2>';
				echo '<p>' . $user['id'] . '</p>';
				echo '<p>' . $user['username'] . '</p>';
				echo '<p>' . $user['email'] . '</p>';
				echo '<p>' . $user['password'] . '</p>';
				echo'<p>' . $user['role'] . '</p>';
			}
		?>
	</div>
	<?php		

	$stmt = $db->prepare('SELECT * FROM DEPARTMENT');
	$stmt->execute();
	$departments = $stmt->fetchAll();

	?>	
	<!DOCTYPE html>
	<html lang="en-US">  
		<body>
			<div id="menu">
				<?php
				echo '<h2> Departments </h2>';

				foreach( $departments as $department) {
					echo '<h3>ID: ' . $department['id'] . '</h3>';
					echo '<p>Name: ' . $department['name'] . '</p>';
				}
				?>
			</div>
		</body>	
	
<?php	

	drawFooter();
	
?>
