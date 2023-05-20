<?php
    function drawProfileInfo($session) {
        echo '<div class="profile">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Your Profile Picture">';
            echo '<div class="profile-info">';
                echo '<h2>Name: ' . $session->getName() . '<img id="edit_name_button" src="/../images/edit_button.png" alt="edit_button.png" title="Change Name">' . '</h2>';
                echo '<h3>Username: ' . $session->getUsername() . '</h3>';
            echo '</div>';
        echo '</div>';
    }
?>