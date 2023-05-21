<?php
    function drawProfileInfo($session, $db) {
        $str_join_date = User::getUser($db, $session->getId())->creation_date;
        $unformat_join_date = strtotime($str_join_date);
        $join_date = date('d/m/Y', $unformat_join_date);

        $first_name = explode(" ", $session->getName())[0];
        $last_name = explode(" ", $session->getName())[1];

        echo '<script>console.log("first_name= ' . $first_name . ' last_name= ' . $last_name .'")</script>';
        
        echo '<div class="profile">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Your Profile Picture">';
            echo '<div class="profile-info">';
                echo '<h2 id="profile_name">Name: ' . $session->getName() . '<img class="edit_button" id="edit_name_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name" onclick="changeProfileName()">' . '</h2>';
                echo '<h2 id="profile_username">Username: ' . $session->getUsername() . '<img class="edit_button" id="edit_username_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Username" onclick="changeProfileUsername()">' . '</h2>';
                echo '<h2>Joined NNTickets on: ' . $join_date . '</h2>';
                echo '<h2>Account Type: ';
                    if($session->isSessionAdmin($db)) {
                        echo 'Admin';
                    }
                    else if($session->isSessionAgent($db)) {
                        echo 'Agent';
                    }
                    else {
                        echo 'Client';
                    }
                echo '</h2>';
            echo '</div>';
        echo '</div>';
    }

    function drawUserInfo($user, $db) { 
        $str_join_date = $user->creation_date;
        $unformat_join_date = strtotime($str_join_date);
        $join_date = date('d/m/Y', $unformat_join_date);

        echo '<div class="user-profile">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Profile Picture">';
            echo '<div class="user-info">';
                echo '<h2>Name: ' . $user->first_name . ' ' . $user->last_name . '</h2>';
                echo '<h2>Username: ' . $user->username . '</h2>';
                echo '<h2>Joined NNTickets on: ' . $join_date . '</h2>';
                echo '<h2>Account Type: ';
                    if ($user->isUserAdmin($db)) {
                        echo 'Admin';
                    }
                    else if ($user->isUserAgent($db)) {
                        echo 'Agent';
                    }
                    else {
                        echo 'Client';
                    }
                echo '</h2>';
            echo '</div>';
        echo '</div>';
    }
?>