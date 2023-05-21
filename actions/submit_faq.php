<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/faq.class.php');

  $db = getDatabaseConnection();

  $id = Faq::submitFaq($db, $_POST['title'], $_POST['answer']);

  header('Location: ../pages/faq.php?id=' . $id);
?>
