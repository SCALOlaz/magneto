// Coded by Travis Beckham, modified by RMcGirr83
tooltip = {
	name : "tooltip",
	offsetX : -25,
	offsetY : 25,
	tip : null
};

tooltip.move = function (evt) {
	var x=0, y=0;
	if (document.all) {// IE

		x = (document.documentElement && document.documentElement.scrollLeft) ? document.documentElement.scrollLeft : document.body.scrollLeft;
		y = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
		x += window.event.clientX;
		y += window.event.clientY;

	} else {// Mozilla
		x = evt.pageX;
		y = evt.pageY;
	}
	this.tip.style.left = (x + this.offsetX) + "px";
	this.tip.style.top = (y + this.offsetY) + "px";
};
tooltip.show = function (text) {
	if (!this.tip) return;
	text = text.replace(/\n/g, "<br />");
	this.tip.innerHTML = text;
	this.tip.style.visibility = "visible";
	this.tip.style.display = "block";
	if (this.tip.offsetWidth > 400)
   this.tip.style.width = "400px";
};
tooltip.hide = function () {
	if (!this.tip) return;
	this.tip.style.visibility = "hidden";
	this.tip.style.display = "none";
	this.tip.innerHTML = "";
	this.tip.style.width = null;
};

tooltip.init = function () {

var tipNameSpaceURI = "http://www.w3.org/1999/xhtml";
if(!tipContainerID){ var tipContainerID = "tooltip";}
var tipContainer = document.getElementById(tipContainerID);

if(!tipContainer){
  tipContainer = document.createElementNS ? document.createElementNS(tipNameSpaceURI, "div") : document.createElement("div");
  tipContainer.setAttribute("id", tipContainerID);
  tipContainer.style.display = "none";
  document.getElementsByTagName("body").item(0).appendChild(tipContainer);
}

	if (!document.getElementById) return;

	this.tip = document.getElementById (this.name);
	if (this.tip) document.onmousemove = function (evt) {tooltip.move (evt)};

	var a, sTitle;
	var anchors = document.getElementsByTagName ("a");

	for (var i = 0; i < anchors.length; i ++) {
		a = anchors[i];
		sTitle = a.getAttribute("title");
		if(sTitle) {
			a.setAttribute("tooltip", sTitle);
			a.removeAttribute("title");
			a.removeAttribute("alt");
			a.onmouseover = function() {tooltip.show(this.getAttribute('tooltip'))};
			a.onmouseout = function() {tooltip.hide()};
		}
	}

};

// this is used instead in a non-prosilver based template
//window.onload = function () {
//	tooltip.init ();
//}
onload_functions.push('tooltip.init();'); // prosilver based template only