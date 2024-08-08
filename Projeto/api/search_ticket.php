<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/question.class.php');

$db = getDatabaseConnection();

$questions = Question::searchQuestions($db, $_GET['search'], 8);

echo json_encode($questions);
?>
