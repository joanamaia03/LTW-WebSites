<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    
    if (!$session->isLoggedIn()) {
        $session->addMessage('error', 'You must be logged in to perform this action');
        die(header('Location: /'));
    }
    
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/question.class.php');
    
    if (trim($_POST['title']) === '') {
        $session->addMessage('error', 'Question title cannot be empty');
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }
    
    $db = getDatabaseConnection();
    
?>