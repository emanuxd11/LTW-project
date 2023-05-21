const ERROR_COLOR = "red";
const SUCCESS_COLOR = "#0074D9";

function checkEmailExists() {
  var email = document.getElementById("email").value;
  var email_status = document.getElementById("email_status");
  
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        if (response == "registered") {
          email_status.innerHTML = "This email is already registered.";
          email_status.style.color = ERROR_COLOR;
        } else {
          email_status.innerHTML = "";
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
  var username_status = document.getElementById("username_status");
  var confirm_username_change = document.getElementById("confirm_username_change"); //Used only on profile username change

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        if (response == "taken") {
          username_status.innerHTML = "Username already taken.";
          username_status.style.color = ERROR_COLOR;
          confirm_username_change.style.display = "none";
        } else {
          username_status.innerHTML = "Username available.";
          username_status.style.color = SUCCESS_COLOR;
          confirm_username_change.style.display = "inline";
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

function checkPasswordGood() {
  var password = document.getElementById("password").value;
  var strength_status = document.getElementById("strength_status");
  var password_status = document.getElementById("password_status");

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        if (response == "not_strong") {
          strength_status.innerHTML = "Password must include at least one number, one letter and be at least 8 characters long.";
          strength_status.style.color = ERROR_COLOR;
          password_status.innerHTML = "";
          return false;
        } else if (response == "too_long") {
          strength_status.innerHTML = "Password cannot be longer than 20 characters.";
          strength_status.style.color = ERROR_COLOR;
          password_status.innerHTML = "";
          return false;
        } else {
          strength_status.innerHTML = "";
          return true;
        }
      } else {
        console.log("Error: " + xhr.status);
        return false
      }
    }
  };
  xhr.open("POST", "../actions/check_password_strength.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("password=" + password);
}

function checkPasswordsMatch() {
  if (document.getElementById("strength_status").innerHTML !== "") {
    return;
  }

  var password_status = document.getElementById("password_status");
  var password = document.getElementById("password").value;
  var passsword_confirmation = document.getElementById("password_confirmation").value;

  if (password !== passsword_confirmation) {
    password_status.innerHTML = "Passwords do not match.";
    password_status.style.color = ERROR_COLOR;
    return false
  } else {
    password_status.innerHTML = "Passwords match.";
    password_status.style.color = SUCCESS_COLOR;
    return true;
  }
}

// functions for dynamic search of agents


function agentSearch(department, ticket_id) {
  let query = document.getElementById('agent-search').value;
  let data = new URLSearchParams();
  
  data.append('query', `%${query}%`);
  if (typeof department === 'string' && department.trim().length === 0) {
    data.append('department', 'none');
  } else {
    data.append('department', department);
  }

  fetch("../actions/agent_search.php", {
    method: 'POST',
    body: data
  }) 
  .then(response => response.json())
  .then(data => {
    let agentList = document.getElementById('agent-list');
    agentList.innerHTML = '';
    data.forEach(agent => {
      let li = document.createElement('li');
      li.innerHTML = `${agent.username}`;
      li.addEventListener('click', function() {
        assignAgent(agent.id, ticket_id);
      });
      agentList.appendChild(li);
    });
  });
}

function assignAgent(agent_id, ticket_id) {
  console.log(`assigned ticket ${ticket_id} to agent ${agent_id}`);

  let data = new URLSearchParams();
  data.append('agent_id', agent_id);
  data.append('ticket_id', ticket_id);

  fetch("../actions/assign_ticket.php", {
    method: 'POST',
    body: data
  }).then(() => {
    // Refresh the page
    location.reload();
  })
  .catch(error => {
    console.error('Error:', error);
  });
}