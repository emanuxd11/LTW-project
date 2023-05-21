function changeProfileName() {
    console.log("changeProfileName() called");
    document.getElementById('profile_name').innerHTML = 'New Name: ' + 
                                                        '<form action="/../pages/profile.php" method="post">' + 
                                                            '<input type="text" class="change_box" id="change_profile_fname" name="changed_first_name" placeholder="New First Name">' +
                                                            '<input type="text" class="change_box" id="change_profile_lname" name="changed_last_name" placeholder="New Last Name">' +
                                                            '<input type="submit" value="Confirm" id="confirm_name_change">' +
                                                        '</form>';
}