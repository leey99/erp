					</td>
				</tr>
			</table>			
		</div>
	</div>
</div>
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/copy_bg.gif);margin-top:30px;">
		<tr>
			<td height="65">
				<div align="center" style="margin-right:<?=$margin_right?>px">
					<table width="<?=$top_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td><div align="center"><img src="images/copy_txt.gif" /></div></td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
<?
if($is_admin != "super") {
	if($member['mb_level'] != 5) {
?>
	<?
	if($mode != "popup") {
	?>
	<style type="text/css">
	#gotop {
		position: absolute;
		top: 90px;
		left:1200px;
		height: 452px;
		display:none;
	}
	.quick{position:;width:137px;left:;}
	#quick_link{}
	#quick_link p{}
	#quick_link span{display:block;margin-bottom:11px;}
	</style>
	<div id="gotop">
		<div class="quick">
			<div style="width:137px;height:297px;background:url('./images/quick_bg.gif') no-repeat;">
				<div style="padding:84px 0 0 8px;" id="quick_link">
					<span><a href="./com_list.php">기본정보(사업장관리)</a></span>
					<span><a href="./staff_list.php">사원등록(사원관리)</a></span>
					<span><a href="./attendance.php">근태등록(근태관리)</a></span>
					<span><a href="./pay_list.php">급여반영(급여관리)</a></span>
					<span><a href="./retirement.php">퇴직관리(노무관리)</a></span>
					<span><a href="./form_4insure.php">4대보험관련서식</a></span>
					<span><a href="./form_inspect.php">노동부자율점검서식</a></span>
					<span><a href="./list_notice.php?bo_table=oc_event">일정등록(커뮤니티)</a></span>
				</div>
			</div>
			<div>
				<a href="#"><img src="./images/quick_top.gif" alt="top" border="0" /></a>
			</div>
			<div style="margin:10px 0 0 0;background:url('./images/cal_bg.gif') no-repeat;width:136px;height:161px;">
				<div style="padding:31px 0 0 0;"><a href="./calculator/support_fund.html" onmouseover='cal1.src="./images/cal_01_on.gif";' onmouseout='cal1.src="./images/cal_01_off.gif";' onclick="cal_open(this.href,'support_fund',860,861);return false;"><img src="./images/cal_01_off.gif" border="0" name="cal1" id="cal1"></a></div>
				<div style="padding:0 0 0 0;"><a href="./calculator/s2.html" onmouseover='cal2.src="./images/cal_02_on.gif";' onmouseout='cal2.src="./images/cal_02_off.gif";' onclick="cal_open(this.href,'s2',960,680);return false;"><img src="./images/cal_02_off.gif" border="0" name="cal2" id="cal2"></a></div>
				<div style="padding:0 0 0 0;"><a href="http://www.nts.go.kr/cal/cal_06.asp" target="_blank" onmouseover='cal3.src="./images/cal_03_on.gif";' onmouseout='cal3.src="./images/cal_03_off.gif";'><img src="./images/cal_03_off.gif" border="0" name="cal3" id="cal3"></a></div>
				<div style="padding:0 0 0 0;"><a href="http://www.nps.or.kr/jsppage/business/insure_cal.jsp" onmouseover='cal4.src="./images/cal_04_on.gif";' onmouseout='cal4.src="./images/cal_04_off.gif";' onclick="cal_open(this.href,'insure_cal',630,540);return false;"><img src="./images/cal_04_off.gif" border="0" name="cal4" id="cal4"></a></div>
				<div style="padding:0 0 0 0;"><a href="./calculator/retire_cal.html" onmouseover='cal5.src="./images/cal_05_on.gif";' onmouseout='cal5.src="./images/cal_05_off.gif";' onclick="cal_open(this.href,'retire_cal',974,831);return false;"><img src="./images/cal_05_off.gif" border="0" name="cal5" id="cal5"></a></div>
			</div>
			<div style="margin:10px 0 0 0;width:136px;height:161px;">
				<table border="0" cellspacing="0" cellpadding="0" style="">
					<tr>
						<td>
							<a href="http://e-consulting.kr" target="_blank"><img src="./images/s_banner01.gif" border="0"></a>
							<a href="http://cafe.naver.com/kcmcceo" target="_blank"><img src="./images/s_banner02.gif" border="0"></a>
							<a href="http://blog.naver.com/kcmc4519" target="_blank"><img src="./images/s_banner03.gif" border="0"></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
//<![CDATA[
function initMoving(target, position, topLimit, btmLimit) {
	target = document.getElementById("gotop");
	position = 90;
	topLimit = 30;
	btmLimit = 100;
	//alert(target.id);
	if (!target)
		return false;
	var obj = target;
	var initTop = position;
	var bottomLimit = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight) - btmLimit - obj.offsetHeight;
	var top = initTop;
	obj.style.position = 'absolute';
	if (typeof(window.pageYOffset) == 'number') {	//WebKit
		var getTop = function() {
			return window.pageYOffset;
		}
	} else if (typeof(document.documentElement.scrollTop) == 'number') {
		var getTop = function() {
			return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
		}
	} else {
		var getTop = function() {
			return 0;
		}
	}
	if (self.innerHeight) {	//WebKit
		var getHeight = function() {
			return self.innerHeight;
		}
	} else if(document.documentElement.clientHeight) {
		var getHeight = function() {
			return document.documentElement.clientHeight;
		}
	} else {
		var getHeight = function() {
			return 800;
		}
	}
	function move() {
		if (initTop > 0) {
			pos = getTop() + initTop;
		} else {
			pos = getTop() + getHeight() + initTop;
		}
		if (pos > bottomLimit)
			pos = bottomLimit;
		if (pos < topLimit)
			pos = topLimit;
		interval = top - pos;
		top = top - interval / 3;
		obj.style.top = top + 'px';
		//alert(obj.id);
		window.setTimeout(function () {
			move();
		}, 25);
	}
	function addEvent(obj, type, fn) {
		if (obj.addEventListener) {
			obj.addEventListener(type, fn, false);
		} else if (obj.attachEvent) {
			obj['e' + type + fn] = fn;
			obj[type + fn] = function() {
				obj['e' + type + fn](window.event);
			}
			obj.attachEvent('on' + type, obj[type + fn]);
		}
	}
	addEvent(window, 'load', function () {
		move();
	});
	move();
}
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	jQuery( "#quick_btn" ).toggle(
		function() {
			jQuery( ".quick" ).animate({right: 0}, 500 );				
		},
		function() {
			jQuery( ".quick" ).animate({right: '-211px'}, 500 );				
		}
	);
});
function noticediv() {
	var xMax = document.body.clientWidth;
	var left_var = 1070;
	var left_var_limit = 1348;
	var xOffset = (xMax+left_var)/2;
	var divMenu = document.getElementById('gotop').style;
	divMenu.display='block';
	if(xMax>left_var_limit) {
	  divMenu.left = xOffset+"px";
	} else {
		divMenu.left = (left_var+135)+"px";
	}
	//alert(xMax);
}
window.onresize = function() { 
	noticediv();
}

addLoadEvent(noticediv);
addLoadEvent(initMoving);

function cal_open(url,id,w,h) {
	window.open(url, id, 'width='+w+',height='+h+',toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');
}

//]]>
</script>
<?
}
?>
<?
//지사/영업사원 전용 ID 접속시 표시안함
	}
?>
</div>
<div style="display:none;">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>
			</td>
		</tr>
	</table>			
</div>
<?
}
?>

