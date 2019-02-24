<?php
	function checkUsername($username) {
		$len = strlen($username);
		return $len >= 8 && $len <= 30;
	}

	function checkPassword($password, $re_password) {
		$len = strlen($password);
		if ($len < 8 || $len > 30)
			return false;
		return $password == $re_password;
	}

	function checkPhone($phone) {
		return strlen($phone) == 10;
	}

	function checkAddress($address) {
		$len = strlen($address);
		return $len >= 10 && $len <= 40;
	}

	function checkBirthday($birthday) {
		$d = date_parse($birthday);
		return $d["year"] >= 1970;
	}

	function checkEmail($email) {
		$len = strlen($email);
		return $len >= 10 && $len <= 50;
	}

	function checkRegister($username, $password, $re_password, $phone, $address, $birthday, $email, &$error) {
		if (!checkUsername($username)) {
			$error = "Invalid username. Username is mandatory and has length in range (8, 30), inclusive";
			return true;
		}
		if (!checkPassword($password, $re_password)) {
			$error = "Invalid password. Password is mandatory and has length in range (8, 13), inclusive";
			return true;
		}
		if (!checkPhone($phone)) {
			$error = "Invalid Phone.";
			return true;
		}
		if (!checkAddress($address)) {
			$error = "Invalid Address";
			return true;
		}
		if (!checkBirthday($birthday)) {
			$error = "Invalid Birthday";
			return true;
		}
		if (!checkEmail($email)) {
			$error = "Invalid Email";
			return true;
		}
		return false;
	}
?>