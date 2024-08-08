<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    drawHeader($session);

    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../templates/tickets.tpl.php');

	require_once(__DIR__ . '/../database/ticket.class.php');

    $query = "SELECT * FROM Ticket";
    $statement = $db->query($query);
    $tickets = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tickets as $ticket) {
        $departmentName = 'None';

        if ($ticket['department_id'] !== null) {
            $query = "SELECT name FROM Department WHERE id = :department_id";
            $statement = $db->prepare($query);
            $statement->bindParam(':department_id', $ticket['department_id']);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                $departmentName = $result['name'];
            }
        }

		$ticketObject = new Ticket(
			$ticket['id'],
			$ticket['title'],
			$ticket['description'],
			new DateTime($ticket['date']),
			$ticket['status'],
			$ticket['creator_id'],
			$ticket['assignee_id'],
			(int)$ticket['department_id']
		);
		

        drawSimpleTicket($ticketObject, $departmentName);
    }

    drawFooter();
?>
