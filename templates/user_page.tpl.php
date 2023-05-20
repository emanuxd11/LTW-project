<?php
    function drawProfileInfo($session) {
        echo '<div class="profile">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Your Profile Picture">';
            echo '<div class="profile-info">';
                echo '<h2>Name: ' . $session->getName() . '<img class="edit_button" id="edit_name_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name">' . '</h2>';
                echo '<h2>Username: ' . $session->getUsername() . '<img class="edit_button" id="edit_username_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name">' . '</h2>';
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
?>