function checkEmailExists() {
    var email = document.getElementById("email").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          if (response == "registered") {
            document.getElementById("email_status").innerHTML = "This email is already registered.";
          } else {
            document.getElementById("email_status").innerHTML = "";
          }
        } else {
          console.log("Error: " + xhr.status);
        }
      }
    };
    xhr.open("POST", "../actions/check_email.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("email=" + email);
}

function checkUsernameExists() {
    var username = document.getElementById("username").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          if (response == "taken") {
            document.getElementById("username_status").innerHTML = "Username already taken.";
          } else {
            document.getElementById("username_status").innerHTML = "Username available.";
          }
        } else {
          console.log("Error: " + xhr.status);
        }
      }
    };
    xhr.open("POST", "../actions/check_username.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("username=" + username);
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
