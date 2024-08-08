<?php

    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/ticket.class.php');

    $creator_id = $session->getId();

    $ticket = Ticket::createTicket($db, $creator_id, $_POST['title'], $_POST['description'], $_POST['department']);

    if ($ticket) {
        $session->addMessage('sucess', 'New ticket submitted!');
    }
    else {
        $session->addMessage('error', "Couldn't submit the ticket .");
    }

    header('Location: ../pages/profile.php');
    exit();
?>