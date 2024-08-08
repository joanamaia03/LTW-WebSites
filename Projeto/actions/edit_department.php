<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/ticket.class.php');

$ticketId = $_POST['editTicketId'];
$department = $_POST['editTicketDepartment'];

$success = Ticket::editDepartment($db, $ticketId, $department);

if ($success) {
    $session->addMessage('success', 'Department updated successfully!');
} else {
    $session->addMessage('error', 'Failed to update the department.');
}

header('Location: ../pages/ticket.php?ticketId=' . $ticketId);
exit();
?>
