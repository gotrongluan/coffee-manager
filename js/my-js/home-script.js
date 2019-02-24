
window.onscroll = function() {ChangeSticky()};

var navbar = document.getElementById("navigation");
var sticky = navbar.offsetTop;

function ChangeSticky()
{
 	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	}
  	else {
    	navbar.classList.remove("sticky");
	}
}

var lefts = document.getElementsByClassName("left-slogan");
var rights = document.getElementsByClassName("right-slogan");
var i;

for (i = 0; i < lefts.length; ++i) {
    var children = lefts[i].children;
    children[0].style.float = children[1].style.float = "left";
}

for (i = 0; i < rights.length; ++i) {
    var children = rights[i].children;
    children[0].style.float = children[1].style.float = "right";
}