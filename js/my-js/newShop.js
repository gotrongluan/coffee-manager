function selectDistrict() {
	var district = document.getElementById("sd").value;
	document.getElementById("sw").disabled = false;
	document.getElementById("ss").innerHTML = "";
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			document.getElementById("sw").innerHTML = this.responseText;   
		}
	};
	xhttp.open("GET", "../html/getWards.php?dict=" + district, true);
	xhttp.send();
}

function selectWard() {
	var district = document.getElementById("sd").value;
	var ward = document.getElementById("sw").value;
	document.getElementById("ss").disabled = false;
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			document.getElementById("ss").innerHTML = this.responseText;   
		}
	};
	xhttp.open("GET", "../html/getStreets.php?dict=" + district + "&ward=" + ward, true);
	xhttp.send();
}

function checkNewName(newName) {
	return true;
}

function yesName() {
	var newName = document.getElementById("shop-name-input").value;
	//check dieu kien newName
	document.getElementById("name-form").submit();
}

function noName() {
	var oldName = document.getElementById("shop-name-span").innerHTML;
	document.getElementById("shop-name-input").value = oldName;
}

//--------------------------------------------
function checkDesc(newDesc) {
	return true;
}

function yesDesc() {
	var newDesc = document.getElementById("shop-desc-textarea").value;
	//check newDesc
	document.getElementById("desc-form").submit();
}

function noDesc() {
	var oldDesc = document.getElementById("shop-desc-p").innerHTML;
	document.getElementById("shop-desc-textarea").value = oldDesc;
}

//----------------------------
function checkPhone(newPhone) {

}

function yesPhone() {
	var newPhone = document.getElementById("shop-phone-input").value;
	//check dieu kien newName
	document.getElementById("phone-form").submit();
}

function noPhone() {
	var oldPhone = document.getElementById("shop-phone-span").innerHTML;
	document.getElementById("shop-phone-input").value = oldPhone;
}
//-------------------------------
function checkNumAdd(numAdd) {

}

function yesAdd() {
	var addNum = document.getElementById("shop-num-add-input").value;
	//checkaddNum
	document.getElementById("address-form").submit();
}

function noAdd() {

}

//---------------------
function checkHour(hour) {

}

function checkMinute(minute) {

}

function yesOpen() {
	var hour = document.getElementById("shop-open-hour-input").value;
	var minute = document.getElementById("shop-open-minute-input").value;
	//check
	document.getElementById("open-form").submit();
}

function noOpen() {
	document.getElementById("shop-open-hour-input").value = "10";
	document.getElementById("shop-open-minute-input").value = "30";
}

//--------------------------------------
function yesClose() {
	var hour = document.getElementById("shop-close-hour-input").value;
	var minute = document.getElementById("shop-close-minute-input").value;
	//check
	document.getElementById("close-form").submit();
}

function noClose() {
	document.getElementById("shop-close-hour-input").value = "23";
	document.getElementById("shop-close-minute-input").value = "00";
}

//-----------------------------------------
function yesType() {
	document.getElementById("type-form").submit();
}

function noType() {

}