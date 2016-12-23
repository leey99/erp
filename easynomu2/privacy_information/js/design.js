//GNB
var source;
function dEI(elementID){
	return document.getElementById(elementID);
}
function onTopNavi(viewNum, num){
	for(var i = 1; i < num; i++){
		var onList=dEI("item"+i);
		var onImg=onList.getElementsByTagName("img").item(0);
		if(i==viewNum){
			onList.className="on";
			var ImgCheck = onImg.src.substring(onImg.src.length-3, onImg.src.length);
			if (ImgCheck!="on.gif") {
				onImg.src = onImg.src.replace("off.gif", "on.gif");
			}
		}else{
			onList.className="";
				if (ImgCheck="on.gif") {
				onImg.src = onImg.src.replace("on.gif", "off.gif");
			}
		}
	}
}

/* img over */
function imgMenuOver(containderID) {
	var objwrap = document.getElementById(containderID);
	var imgMenu = objwrap.getElementsByTagName("a");

	for (i=0; i<imgMenu.length; i++) {
		if(imgMenu[i].getElementsByTagName("img").length == 0) continue;

		if (imgMenu[i].getElementsByTagName("img")[0].src.indexOf("_on.gif") != -1 ) {
			continue;
		}
		imgMenu[i].onmouseover = function() {
			subImage = this.getElementsByTagName("img")[0];
			if (subImage.src.indexOf("_on.gif") != -1) return false;
			subImage.src = subImage.src.replace("_off.gif","_on.gif");
		}
		imgMenu[i].onfocus = function() {
			subImage = this.getElementsByTagName("img")[0];
			if (subImage.src.indexOf("_over.gif") != -1) return false;
			subImage.src = subImage.src.replace("_off.gif","_on.gif");
		}
		imgMenu[i].onmouseout = function() {
			subImage = this.getElementsByTagName("img")[0];
			subImage.src = subImage.src.replace("_on.gif", "_off.gif");
		}
		imgMenu[i].onblur = function() {
			subImage = this.getElementsByTagName("img")[0];
			subImage.src = subImage.src.replace("_on.gif", "_off.gif");
		}
	}
}

function contView(obj) {
    var target = document.getElementById(obj);
    target.style.display = (target.style.display=='none' ? 'block':'none');
}

function minus_fun(){
	var size = $("body").css("font-size");
	var minusSize = "";
	if(size == "12px"){
	  alert("더 이상 줄일수 없습니다.");
	} else {
	   minusSize = parseInt(size.substring(0, size.length-2)) -2;
	   $("body").css("font-size", minusSize+"px");
	}
	}

	function plus_fun(){ 
	var size = $("body").css("font-size");
	var plusSize = "";
	  
	plusSize = parseInt(size.substring(0, size.length-2)) +2;
	$("body").css("font-size", plusSize+"px");
	}
