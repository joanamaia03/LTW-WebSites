<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) {
        $session->addMessage('error', 'You must be logged in to perform this action');
        die(header('Location: /'));
    }

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/comments.class.php');

    if (trim($_POST['text']) === '') {
        $session->addMessage('error', 'Comment text cannot be empty');
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $db = getDatabaseConnection();

    $comment = Comment::getQuestionComments($db, intval($_POST['id']));

    if ($comment) {
        $comments->text = $_POST['text'];
        $comments->save($db);
        $session->addMessage('success', 'Comment updated');
        header('Location: ../pages/comment.php?id=' . $_POST['id']);
    } else {
        $session->addMessage('error', 'Comment does not exist');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>