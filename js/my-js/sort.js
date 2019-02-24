var query = document.getElementById("query").innerHTML;
function intermediate(first) {
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
			document.getElementById("main-div").innerHTML = this.responseText;   
		}
	};
	xhttp.open("GET", "./query/list_posts_ajax.php?query=" + query + "&first=" + first, true);
	xhttp.send();
}

function newFirst() {
	intermediate("ID");
}

function starFirst() {
	intermediate("Star");
}

function saveFirst() {
	intermediate("Save");
}

function scoreFirst() {
	intermediate("Score");
}