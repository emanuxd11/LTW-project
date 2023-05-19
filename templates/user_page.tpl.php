<?php
    function drawProfileInfo($session) {
        echo '<div class="profile-info">';
            echo '<h2>Name: ' . $session->getName() . '</h2>';
            echo '<h3>Username: ' . $session->getUsername() . '</h3>';
        echo '</div>';
    }
?>