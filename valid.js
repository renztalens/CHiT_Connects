	//Validtion Code For Inputs

var username = document.forms['form']['username'];
var password = document.forms['form']['password'];

var user_error = document.getElementById('user_error');
var pass_error = document.getElementById('pass_error');

function validated(){
	if (username.value.length <= 1) {
		username.style.border = "1px solid red";
		user_error.style.display = "block";
		username.focus();
		return false;
	}
	if (password.value.length <= 1) {
		password.style.border = "1px solid red";
		pass_error.style.display = "block";
		password.focus();
		return false;
	}
}

