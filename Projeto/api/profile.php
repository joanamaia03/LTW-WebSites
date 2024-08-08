<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../templates/profile.tpl.php');
require_once(__DIR__ . '/../utils/session.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    $db = getDatabaseConnection();

    switch ($action) {
        case 'getEditProfileContent':
            $user = User::getUser($db, $session->getId());
            $content = getEditProfileContent($user);
            echo $content;
            break;
        case 'getNewTicketContent':
            $content = getNewTicketContent();
            echo $content;
            break;
        case 'getMyTicketsContent':
            $content = getMyTicketsContent();
            echo $content;
            break;
        case 'updateAssignedAgent':
            $content = updateAssignedAgent();
            echo $content;
            break;
        case 'updateTicketStatus':
            $content = updateTicketStatuse();
            echo $content;
            break;
        case 'getUpdatedRole':
            $content = getUpdatedRole();
            echo $content;
            break;
        case 'getAddDepartment':
            $content = getAddDepartment();
            echo $content;
            break;
        case 'getAssignAgentToDepartment':
            $content = getAssignAgentToDepartment();
            echo $content;
            break;
    }
}
?>
