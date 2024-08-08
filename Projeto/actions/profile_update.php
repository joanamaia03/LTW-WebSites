<?php

    declare(strict_types=1);


    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    User::updateUser($db, $session->getId(), $_POST['name'], $_POST['username'], $_POST['email'], $_POST['password']);


    // Redireciona para a página de perfil do cliente
    header('Location: ../pages/profile.php');
    exit();
?>
