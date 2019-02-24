function checkUsername() {
	var username = document.getElementsByName("username")[0].value;
	return username.length >= 8 && username.length <= 30;
}

function checkPassword() {
	var password = document.getElementsByName("password")[0].value;
	if (password.length < 8 || password.length > 30) 
		return false;
	var rePassword = document.getElementsByName("re-password")[0].value;
	return password == rePassword;
}

function checkPhone() {
	var phone = document.getElementsByName("phonenumber")[0].value;
	return phone.length == 10;
}

function checkBirthday() {
	var birthday = document.getElementsByName("birthday")[0].value;
	var t = birthday.split("-");
	var year = t[0];
	if (Number(year) < 1960)
		return false;
	return true;
}

function checkAddress() {
	var address = document.getElementsByName("address")[0].value;
	return address.length >= 10 && address.length <= 40;
}

function checkEmail() {
	var email = document.getElementsByName("email")[0].value;
	return email.length >= 10 && email.length <= 50;
}

function checkAndSubmit() {
	var errorNotify = document.getElementById("error-notify");
	if (!checkUsername()) {
		errorNotify.innerHTML = "Invalid username. Username is mandatory and has length in range (8, 30), inclusive";
		return;
	}
	if (!checkPassword()) {
		errorNotify.innerHTML = "Invalid password. Password is mandatory and has length in range (8, 13), inclusive";
		return;
	}
	if (!checkPhone()) {
		errorNotify.innerHTML = "Invalid Phone.";
		return;
	}
	if (!checkAddress()) {
		errorNotify.innerHTML = "Invalid Address";
		return;
	}
	if (!checkBirthday()) {
		errorNotify.innerHTML = "Invalid Birthday";
		return;
	}
	if (!checkEmail()) {
		errorNotify.innerHTML = "Invalid Email";
		return;
	}
	document.getElementById("register-form").submit();
}