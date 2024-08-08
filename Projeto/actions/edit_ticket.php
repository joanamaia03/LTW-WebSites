<?php

    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/ticket.class.php');

    $ticketId = $_POST['editTicketId'];
    $title = $_POST['editTicketTitle'];
    $description = $_POST['editTicketDescription'];
    $department = $_POST['editTicketDepartment'];

    $success = Ticket::editTicket($db, $ticketId, $title, $description, $department);

    if ($success) {
        $session->addMessage('success', 'Ticket updated successfully!');
    } else {
        $session->addMessage('error', 'Failed to update the ticket.');
    }

    header('Location: ../pages/ticket.php?ticketId=' . $ticketId);

    exit();
?>
