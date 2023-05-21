<?php
    require_once(__DIR__ . '/../utils/session.php');

    function ChangeName($db, $new_fname, $new_lname) {
        $old_first_name = User::getUser($db, $_SESSION['id'])->first_name;
        $old_last_name = User::getUser($db, $_SESSION['id'])->last_name;

        if (($new_fname == null or $new_fname == '') and ($new_lname == null or $new_lname == '')) {
            $new_fname = $old_first_name;
            $new_lname = $old_last_name;
        }
        else if ($new_fname == null or $new_fname == ''){
            $new_fname = $old_first_name;
        } 
        else if ($new_lname == null or $new_lname == '') {
            $new_lname = $old_last_name;
        }
        
        $_SESSION['name'] = $new_fname . ' ' . $new_lname;
        
        $stmt = $db->prepare('
          UPDATE user
          SET first_name = ?, last_name = ?
          WHERE id = ?
        ');
        $stmt->execute(array($new_fname, $new_lname, $_SESSION['id']));
    }

    function ChangeUsername($db, $new_username) {
        $old_username = $_SESSION['username'];

        if ($new_username == null or $new_username == '') {
            $new_username = $old_username;
        }

        $_SESSION['username'] = $new_username;
        
        $stmt = $db->prepare('
          UPDATE user
          SET username = ?
          WHERE id = ?
        ');
        $stmt->execute(array($new_username, $_SESSION['id']));
    }
?>