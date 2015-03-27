$ = function(selector){
	return document.querySelector(selector);
}
$$ = function(selector){
	return document.querySelectorAll(selector);
}

function toggle(el) {
	el = document.getElementById(el);
	if(el.className == "shown"){
		el.className = "";
	} else {
		el.className = "shown";
	}
}