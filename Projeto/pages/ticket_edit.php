<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');

  drawHeader($session);
  drawFooter();

  require_once(__DIR__ . '/../database/question.class.php');
  require_once(__DIR__ . '/../templates/questions.tpl.php');

  $db = getDatabaseConnection();

  $question = Question::getQuestion($db, intval($_GET['id']));

  drawEditQuestion($question);
  
?>
