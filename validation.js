function validateRegister() {
  var firstName = document.getElementById("register_firstName").value,
  lastName = document.getElementById("register_lastName").value,
  email = document.getElementById("register_email").value;

  var re = /^[A-Za-z]+$/;
  if (!re.test(String(firstName).toLowerCase())) {
    document.getElementById("register_email_error").appendChild(document.createTextNode("Please enter a valid first name"));
    return false;
  }
  if (!re.test(String(lastName).toLowerCase())) {
    document.getElementById("register_email_error").appendChild(document.createTextNode("Please enter a valid last name"));
    return false;
  }
  re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(String(email).toLowerCase())) {
    document.getElementById("register_email_error").appendChild(document.createTextNode("Please enter a valid e-mail address"));
    return false;
  }
  return true;
}

window.onload = function() {
  document.getElementById("form_register").onsubmit = validateRegister;
};
