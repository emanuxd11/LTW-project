<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
  
    require_once(__DIR__ . '/../actions/change_profile_info.php');
    $changed_fname = $_POST['changed_first_name'];
    $changed_lname = $_POST['changed_last_name'];
    $changed_username = $_POST['changed_username'];

    require_once(__DIR__ . '/../database/connection.db.php');
  
    require_once(__DIR__ . '/../templates/common.tpl.php');

    require_once(__DIR__ . '/../database/user.class.php');

    require_once(__DIR__ . '/../templates/user_page.tpl.php');

    require_once(__DIR__ . '/../templates/ticket_show.tpl.php');
  
    $db = getDatabaseConnection();

    ChangeName($db, $changed_fname, $changed_lname); 
    ChangeUsername($db, $changed_username);
  
    drawHeader($session);
    drawProfileInfo($session, $db);
    /*drawClientTypeManager($session, User::getUser($db, $session->getId()), $db);*/
    drawMyTickets($session, $db);
    drawFooter();
?>