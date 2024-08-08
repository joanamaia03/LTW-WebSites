<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../templates/tickets.tpl.php');

drawHeader($session);

$db = getDatabaseConnection();

$ticketId = $_GET['ticketId'] ?? null;

if ($ticketId !== null) {
    $query = "SELECT * FROM Ticket WHERE id = :ticketId";
    $statement = $db->prepare($query);
    $statement->bindParam(':ticketId', $ticketId);
    $statement->execute();
    $ticket = $statement->fetch(PDO::FETCH_ASSOC);

    if ($ticket) {
        $departmentName = 'None';

        if ($ticket['department_id'] !== null) {
            $query = "SELECT name FROM Department WHERE id = :departmentId";
            $statement = $db->prepare($query);
            $statement->bindParam(':departmentId', $ticket['department_id']);
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

        drawTicket($session, $ticketObject, $departmentName);

        if($session->getId() === $ticket['creator_id']) {
            drawTicketCreator($ticketObject);
        }
        if ($session->getRole() === 'agent' || $session->getRole() === 'admin') {
            drawTicketAgent($ticketObject);
        }
    } else {
        echo 'Ticket not found.';
    }
} else {
    echo 'Invalid ticket ID.';
}

drawFooter();
?>
