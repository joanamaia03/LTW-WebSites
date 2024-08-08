<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    $user = User::createUserWithPassword($db, $_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);

    if ($user) {
        $session->setId($user->id);
        $session->setName($user->name);
        $session->setRole($user->role);
        $session->addMessage('sucess', 'Register successful!');
        header('Location: ../pages/index.php');
        
    }
    else {
        $session->addMessage('error', 'Wrong credentials.');
        header('Location: ../pages/register.php');
    }

?>
