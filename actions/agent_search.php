<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $search_query = $_POST['query'];
  $department = $_POST['department'];

  header('Content-Type: application/json;charset=utf-8');

  if ($department == 'none') {
    echo User::getAllAgents($db, $search_query);
    // for debug if seeing the json is necessary
    // file_put_contents('agents.json', User::getAllAgents($db, $search_query));
  } else {
    echo User::getAgentsByDepartment($db, $department, $search_query);
  }
?>