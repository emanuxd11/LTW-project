<?php
    function drawProfileInfo($session) {
        echo '<div class="profile-info">';
            echo '<img id="default_profile_image" src="/../images/default-user-image.png" alt="default-user-image.png" title="Your Profile Picture">';
            echo '<h2>Name: ' . $session->getName() . '</h2>';
            echo '<h3>Username: ' . $session->getUsername() . '</h3>';
        echo '</div>';
    }
?>