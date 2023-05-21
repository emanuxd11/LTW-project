function changeProfileName(first_name, last_name) {
    console.log("changeProfileName() called");
    document.getElementById('profile_name').innerHTML = 'New Name: ' + 
                                                        /*'<form >' +   */ 
                                                            '<span class="input" role="textbox" id="change_profile_fname" name="changed_first_name" contenteditable>' + first_name + '</span>' +
                                                            '<span class="input" role="textbox" id="change_profile_lname" contenteditable>' + last_name + '</span>' +
                                                            '<img class="confirm_button" id="confirm_name_button" src="/../images/check_button.png" alt="check_button.png" title="Confirm Name Change" type="submit">'/* +
                                                        '</form>'*/;
}

function confirmProfileUsername() {

}