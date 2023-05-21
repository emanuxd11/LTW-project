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
                                                        '<form action="/../actions/change_password.php" method="post">' + 
                                                            '<input type="text" class="change_box" id="username" name="changed_username" placeholder="New Username" oninput="checkUsernameExists(); disableUsernameChangeButton()">' +
                                                            '<span id="username_status"></span>' +
                                                            '<input type="submit" value="Confirm" id="confirm_username_change">' +
                                                        '</form>';
}

function changePassword() {
    document.getElementById('password_change').innerHTML = 'New Password: ' +
                                                            '<form action="/../actions/change_password.php" method="post">' + 
                                                                '<input type="password" class="change_box" id="password" name="changed_password" placeholder="New Password" oninput="verifyPassword()">' +
                                                                '<span id="strength_status"></span>' +
                                                                '<input type="password" class="change_box" id="password_confirmation" name="confirm_changed_password" placeholder="Repeat Password" oninput="verifyPassword()">' +
                                                                '<span id="password_status"></span>' +
                                                                '<input type="submit" value="Confirm" id="confirm_password_change" style="display:none">' +
                                                            '</form>';

    document.getElementById('confirm_password_change').style.display = 'none';
}

function verifyPassword() {
    var password_good = checkPasswordGood();
    var passwords_match = checkPasswordsMatch();

    if(document.getElementById('strength_status').innerHTML !== "") {
        password_good = false;
    }
    else {password_good = true;}
    console.log(password_good + " " + passwords_match);

    if (password_good && passwords_match) {
        document.getElementById('confirm_password_change').style.display = 'block';
        console.log("display block");
    }
    else {
        document.getElementById('confirm_password_change').style.display = 'none';
    }
    
}