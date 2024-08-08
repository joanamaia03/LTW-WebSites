<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);

    if ($user) {
        $session->setId($user->id);
        $session->setName($user->name);
        $session->setRole($user->role);
        header('Location: ../pages/index.php');
        $session->addMessage('sucess', 'Login successful!');
    }
    else {
        header('Location: ../pages/login.php');
        $session->addMessage('error', 'Wrong credentials.');
    }

    

?>