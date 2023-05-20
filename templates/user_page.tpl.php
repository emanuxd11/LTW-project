<?php
    function drawProfileInfo($session, $db) { //Possivelmente tirar $db das vars pois n sei se nao sera um risco de segurança
        $str_join_date = User::getUser($db, $session->getId())->creation_date;
        $unformat_join_date = strtotime($str_join_date);
        $join_date = date('d/m/Y', $unformat_join_date);
        
        echo '<div class="profile">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Your Profile Picture">';
            echo '<div class="profile-info">';
                echo '<h2>Name: ' . $session->getName() . '<img class="edit_button" id="edit_name_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name">' . '</h2>';
                echo '<h2>Username: ' . $session->getUsername() . '<img class="edit_button" id="edit_username_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name">' . '</h2>';
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

    /* Function to add later
    function drawEditNameForm() {
        echo '<form id="edit_name_form" action="../actions/user_edit_name.php" method="post">';
            echo '<input type="text" name="first_name" placeholder="First Name" required>';
            echo '<input type="text" name="last_name" placeholder="Last Name" required>';
            echo '<button type="submit">Save</button>';
        echo '</form>';
    }
    */

    function drawUserInfo($user, $db) { //Possivelmente tirar $db das vars pois n sei se nao sera um risco de segurança
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