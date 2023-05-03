function checkEmailExists() {
    var email = document.getElementById("email").value;

    $.ajax({
        url: "../actions/check_email.php",
        type: "POST",
        data: { email: email },
        success: function(response) {
            if (response == "registered") {
                document.getElementById("email_status").innerHTML = "This email address is already registered.";
            } else {
                document.getElementById("email_status").innerHTML = "";
            }
        }
    });
}

function checkUsernameExists() {
    var username = document.getElementById("username").value;

    $.ajax({
        url: "../actions/check_username.php",
        type: "POST",
        data: { username: username },
        success: function(response) {
            if (response == "taken") {
                document.getElementById("username_status").innerHTML = "Username already taken.";
            } else {
                document.getElementById("username_status").innerHTML = "Username available.";
            }
        }
    });
}

function checkPasswordsMatch() {
    var password = document.getElementById("password").value;
    var passsword_confirmation = document.getElementById("password_confirmation").value;

    if (password !== passsword_confirmation) {
        document.getElementById("password_status").innerHTML = "Passwords do not match.";
    } else {
        document.getElementById("password_status").innerHTML = "Passwords match.";
    }
}

