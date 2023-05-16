function checkValidTitle() {
  const title_input = document.getElementById("title");
  const title_status = document.getElementById("title_status");
  const submit_button = document.getElementById("submit-button");
  if (title_input.value.length < 8) {
    title_status.innerHTML = "Title must be at least 8 characters long";
    title_status.style.color = "red";
    submit_button.disabled = true;
  } else {
    title_status.innerHTML = "";
    submit_button.disabled = false;
  }
}

function checkValidDescription() {
  const title_input = document.getElementById("description");
  const description_status = document.getElementById("description_status");
  const submit_button = document.getElementById("submit-button");
  if (title_input.value.length < 8) {
    description_status.innerHTML = "Description must be at least 20 characters long";
    description_status.style.color = "red";
    submit_button.disabled = true;
  } else {
    description_status.innerHTML = "";
    submit_button.disabled = false;
  }
}