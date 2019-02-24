function checkedStar(i) {
	var stars = document.getElementsByClassName("fa-star");
	var j;
	var num = 0;
	if (stars[i].classList.contains("checked"))
	{
		stars[i].classList.remove("checked");
		num = i;
	}
	else
	{
		for (j = 0; j <= i; ++j)
		{
			if (!stars[j].classList.contains("checked"))
			{
				stars[j].classList.add("checked");
			}
		}
		num = i + 1;
	}
	for (j = i + 1; j < stars.length; ++j)
	{
		if (stars[j].classList.contains("checked"))
		{
			stars[j].classList.remove("checked");
		}
	}
	var otr = document.getElementById("otr");
	if (num > 0)
	{
		otr.style.display = "block";
		otr.innerHTML = "Bạn đã đánh giá " + num.toString() + " sao";
	}	
	else {
		otr.style.display = "none";
	}
}

function likeThis() {
	var like = document.getElementById("lk");
	like.classList.toggle("tr-liked");
}