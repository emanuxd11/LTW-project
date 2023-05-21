<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/faq.class.php');

  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  require_once(__DIR__ . '/../templates/faq.tpl.php');

  $db = getDatabaseConnection();

  $faq_id = intval($_GET['id']);
  $faq = Faq::getFaqByID($db, $faq_id);

  drawHeader($session);

  drawFaq($faq);

  drawFooter();
?>