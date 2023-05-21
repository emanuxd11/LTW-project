function changeProfileName() {
    document.getElementById('profile_name').innerHTML = 'New Name: ' + 
                                                        '<form action="/../pages/profile.php" method="post">' + 
                                                            '<input type="text" class="change_box" id="change_profile_fname" name="changed_first_name" placeholder="New First Name">' +
                                                            '<input type="text" class="change_box" id="change_profile_lname" name="changed_last_name" placeholder="New Last Name">' +
                                                            '<input type="submit" value="Confirm" id="confirm_name_change">' +
                                                        '</form>';
}

function changeProfileUsername() {
    document.getElementById('edit_name_button').style.display = 'none';

    document.getElementById('profile_username').innerHTML = 'New Username: ' + 
                                                        '<form action="/../pages/profile.php" method="post">' + 
                                                            '<input type="text" class="change_box" id="username" name="changed_username" placeholder="New Username" oninput="checkUsernameExists(); disableUsernameChangeButton()">' +
                                                            '<span id="username_status"></span>' +
                                                            '<input type="submit" value="Confirm" id="confirm_username_change">' +
                                                        '</form>';
}