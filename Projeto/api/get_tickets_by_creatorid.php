<?php
    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('SELECT t.id, t.title, t.description, t.date, t.status, t.department_id, d.name AS department_name FROM Ticket t LEFT JOIN Department d ON t.department_id = d.id WHERE t.creator_id = :userID');
    $stmt->execute(['userID' => $session->getId()]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($tickets);
    

?>
