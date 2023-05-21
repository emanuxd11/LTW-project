<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
  
    require_once(__DIR__ . '/../database/connection.db.php');
  
    require_once(__DIR__ . '/../templates/common.tpl.php');

    require_once(__DIR__ . '/../database/user.class.php');

    require_once(__DIR__ . '/../templates/user_page.tpl.php');

    require_once(__DIR__ . '/../templates/ticket_show.tpl.php');
  
    $db = getDatabaseConnection();

    $user_id = (int)$_GET['id'];

    if ($user_id == $session->getId()) {
        header('Location: profile.php');
    }

    $user = User::getUser($db, $user_id);
  
    drawHeader($session);
    drawUserInfo($user, $db);
    drawClientTypeManager($session, $user, $db);
    drawUserTickets($db, $user_id);
    drawFooter();
?>