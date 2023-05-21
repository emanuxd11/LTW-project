<?php 
    declare(strict_types = 1);
    $user_id = (int)$_POST['user_id'];
    $client_type = $_POST['client_type'];

    echo '<script>console.log(' . $user_id . ')</script>';
    echo '<script>console.log(' . $client_type . ')</script>';

    require_once(__DIR__ . '/../database/connection.db.php');

    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    if (User::getUser($db, $user_id)->isUserAgent($db)) {
        if ($client_type == 'client') {
            $stmt = $db->prepare('
                DELETE FROM agent WHERE user_id = ?
            ');

            $stmt->execute(array($user_id));
        } else if ($client_type == 'admin') {
            $stmt = $db->prepare('
                DELETE FROM agent WHERE user_id = ?
            ');

            $stmt->execute(array($user_id));

            $stmt = $db->prepare('
                INSERT INTO admin (user_id) VALUES (?)
            ');

            $stmt->execute(array($user_id));
        }
    } 
    else if (User::getUser($db, $user_id)->isUserClient($db) && $client_type == 'agent') {
        $stmt = $db->prepare('
            INSERT INTO agent (user_id) VALUES (?)
        ');

        $stmt->execute(array($user_id));
    }
    else if (User::getUser($db, $user_id)->isUserAdmin($db)) {
        if ($client_type == 'client') {
            $stmt = $db->prepare('
                DELETE FROM admin WHERE user_id = ?
            ');

            $stmt->execute(array($user_id));
        } else if ($client_type == 'agent') {
            $stmt = $db->prepare('
                DELETE FROM admin WHERE user_id = ?
            ');

            $stmt->execute(array($user_id));

            $stmt = $db->prepare('
                INSERT INTO agent (user_id) VALUES (?)
            ');

            $stmt->execute(array($user_id));
        }
    }
    
    header('Location: ../pages/user.php?id=' . $user_id);
?>