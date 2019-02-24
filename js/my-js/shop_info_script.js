var btns = document.getElementsByClassName("change-btn");
var i;
for (i = 0; i < btns.length; ++i)
	btns[i].style.display = "none";
// document.getElementById("desc_text_area").style.display = "none";
//----------------------------
function editShop(type) {
	document.getElementById("edit_" + type + "_btn").style.display = "none";
	document.getElementById("accept_" + type + "_btn").style.display = "inline-block";
	document.getElementById("reject_" + type + "_btn").style.display = "inline-block";
	
}

function unEditShop(type) {
	document.getElementById("edit_" + type + "_btn").style.display = "inline-block";
	document.getElementById("accept_" + type + "_btn").style.display = "none";
	document.getElementById("reject_" + type + "_btn").style.display = "none";
}
//----------------name---------------------
function editShopName() {
	editShop("name");
	document.getElementById("shop_name").readOnly = false;
}

function checkShopName(name) {
	return true;
}

function acceptChangeName() {
	var newName = document.getElementById("shop_name").value;
	if (checkShopName(newName)) {
		document.getElementById("name-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Tên mới không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangeName() {
	var oldName = document.getElementById("shop_name_hidden").value;
	document.getElementById("shop_name").value = oldName;
	document.getElementById("shop_name").readOnly = true;
	unEditShop("name");
}
//-------------phone----------------------
function editShopPhone() {
	editShop("phone");
	document.getElementById("shop_phone").readOnly = false;
}

function checkShopPhone(phone) {
	return phone.length == 10;
}

function acceptChangePhone() {
	var newPhone = document.getElementById("shop_phone").value;
	if (checkShopPhone(newPhone)) {
		document.getElementById("phone-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Số điện thoại mới không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangePhone() {
	var oldPhone = document.getElementById("shop_phone_hidden").value;
	document.getElementById("shop_phone").value = oldPhone;
	document.getElementById("shop_phone").readOnly = true;
	unEditShop("phone");
}

//------------------desc---------------------
function editShopDesc() {
	editShop("desc");
	document.getElementById("desc_hidden").style.display = "none";
	document.getElementById("desc_text_area").style.display = "block";
}

function checkShopDesc(desc) {
	return true;
}

function acceptChangeDesc() {
	var newDesc = document.getElementById("desc_text_area").value;
	if (checkShopDesc(newDesc)) {
		document.getElementById("desc-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Mô tả mới không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangeDesc() {
	document.getElementById("desc_hidden").style.display = "inline-block";
	var oldDesc = document.getElementById("desc_hidden").value;
	document.getElementById("desc_text_area").value = oldDesc;
	document.getElementById("desc_text_area").style.display = "none";
	unEditShop("desc");
}

//-------------------type------------------
function editShopType() {
	editShop("type");
	document.getElementById("type_hidden").style.display = "none";
	document.getElementById("type_select").style.display = "block";
}

function acceptChangeType() {
	document.getElementById("type-form").submit();
}

function rejectChangeType() {
	document.getElementById("type_hidden").style.display = "inline-block";
	document.getElementById("type_select").style.display = "none";
	unEditShop("type");
}

//------------------addresss-----------------------
function selectDistrict() {
	var district = document.getElementById("shop_district").value;
	var ward = document.getElementById("shop_ward");
	ward.style.display = "block";
	document.getElementById("shop_street").style.display = "none";
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			ward.innerHTML = this.responseText;  
		}
	};
	xhttp.open("GET", "./query/get_wards.php?dict=" + district, true);
	xhttp.send();
}

function selectWard() {
	var district = document.getElementById("shop_district").value;
	var ward = document.getElementById("shop_ward").value;
	var street = document.getElementById("shop_street")
	street.style.display = "block";
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			street.innerHTML = this.responseText;   
		}
	};
	xhttp.open("GET", "./query/get_streets.php?dict=" + district + "&ward=" + ward, true);
	xhttp.send();
}

function editShopAddress() {
	editShop("address");
	document.getElementById("address_hidden").style.display = "none";
	document.getElementById("add_number").style.display = "block";
	document.getElementById("shop_district").style.display = "block";
}

function checkAddressNumber(addnum) {
	return true;
}

function acceptChangeAddress() {
	var addnum = document.getElementById("add_number").value;
	if (checkAddressNumber(addnum)) {
		document.getElementById("address-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Địa chỉ mới không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangeAddress() {
	document.getElementById("address_hidden").style.display = "block";
	document.getElementById("add_number").style.display = "none";
	document.getElementById("shop_district").style.display = "none";
	document.getElementById("shop_ward").style.display = "none";
	document.getElementById("shop_street").style.display = "none";
	unEditShop("address");
}

//-------------open----------------------------
function editShopOpen() {
	editShop("open");
	document.getElementById("open_hidden").style.display = "none";
	document.getElementById("hour_open").style.display = "block";
	document.getElementById("minute_open").style.display = "block";
}

function checkOpen(hour, minute) {
	return true;
}

function acceptChangeOpen() {
	var hour = document.getElementById("hour_open").value;
	var minute = document.getElementById("minute_open").value;
	if (checkOpen(hour, minute)) {
		document.getElementById("open-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Giờ mở cửa không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangeOpen() {
	document.getElementById("open_hidden").style.display = "block";
	document.getElementById("hour_open").style.display = "none";
	document.getElementById("minute_open").style.display = "none";
	unEditShop("open");
}

//-------------close----------------------------
function editShopClose() {
	editShop("close");
	document.getElementById("close_hidden").style.display = "none";
	document.getElementById("hour_close").style.display = "block";
	document.getElementById("minute_close").style.display = "block";
}

function checkClose(hour, minute) {
	return true;
}

function acceptChangeClose() {
	var hour = document.getElementById("hour_close").value;
	var minute = document.getElementById("minute_close").value;
	if (checkClose(hour, minute)) {
		document.getElementById("close-form").submit();
	}
	else {
		document.getElementById("error_notify").innerHTML = "Giờ đóng cửa không hợp lệ";
		$("#exampleModal").modal();
	}
}

function rejectChangeClose() {
	document.getElementById("close_hidden").style.display = "block";
	document.getElementById("hour_close").style.display = "none";
	document.getElementById("minute_close").style.display = "none";
	unEditShop("close");
}

var currentImg = -1;
var currentItem = -1;

function first(index) {
	currentImg = index;
	$("#deleteImgModal").modal();
}

function accepted() {
	var f = "img-shop-" + currentImg;
	document.getElementById(f).submit()
}

function second(id) {
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			document.getElementById("item-view").innerHTML = this.responseText;
			document.getElementById("mylove").href = "edit_item.php?IDITEM=" + id;
			$("#detailItemModal").modal();
		}
	};
	xhttp.open("GET", "./query/get_item_info.php?IDITEM=" + id, true);
	xhttp.send();
}

function third(id) {
	currentItem = id;
	$("#deleteItemModal").modal();
}

function itemAccepted() {
	window.location.replace("./query/delete_item.php?IDITEM=" + currentItem);
}