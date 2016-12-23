String.prototype.cut = function(len) {
    var str = this;
    var l = 0;

    for (var i=0; i<str.length; i++) {
            l += (str.charCodeAt(i) > 128) ? 2 : 1;
            if (l > len) return str.substring(0,i);
    }
    return str;
}

String.prototype.bytes = function() {
        var str = this;
        var l = 0;
        for (var i=0; i<str.length; i++) l += (str.charCodeAt(i) > 128) ? 2 : 1;
        return l;
}
	
String.prototype.trim = function(){
	var str = this.replace(/(\s+$)/g,"");
	return str.replace(/(^\s*)/g,"");
}
	
String.prototype.replaceAll = function(string1,string2) {
	var string = "";

	if (this.trim() != "" && string1 != string2) {
		string = this.trim();

		while (string.indexOf(string1) > -1) {
			string = string.replace(string1,string2);
		}
	}
	
	return string;
}

function emailCheck(email)
{
	var email_exp = /^[a-z0-9]{2,}@[a-z0-9-]{2,}\.[a-z0-9]{2,}/i; 
	if(!email_exp.test(email))
	{
	    return false;
	}
	
	return true;
}


/**
 * 입력값이 NULL인지 체크
 */
function isNull(input) {
    if (input.value == null || input.value == "") {
        return true;
    }
    return false;
}

/**
 * 입력값에 스페이스 이외의 의미있는 값이 있는지 체크
 * ex) if (isEmpty(form.keyword)) {
 *         alert("검색조건을 입력하세요.");
 *     }
 */
function isEmpty(input) {
    if (input.value == null || input.value.replace(/ /gi,"") == "") {
        return true;
    }
    return false;
}

/**
 * 입력값에 특정 문자(chars)가 있는지 체크
 * 특정 문자를 허용하지 않으려 할 때 사용
 * ex) if (containsChars(form.name,"!,*&^%$#@~;")) {
 *         alert("이름 필드에는 특수 문자를 사용할 수 없습니다.");
 *     }
 */
function containsChars(input,chars) {
    for (var inx = 0; inx < input.value.length; inx++) {
       if (chars.indexOf(input.value.charAt(inx)) != -1)
           return true;
    }
    return false;
}

/**
 * 입력값이 특정 문자(chars)만으로 되어있는지 체크
 * 특정 문자만 허용하려 할 때 사용
 * ex) if (!containsCharsOnly(form.blood,"ABO")) {
 *         alert("혈액형 필드에는 A,B,O 문자만 사용할 수 있습니다.");
 *     }
 */
function containsCharsOnly(input,chars) {
    for (var inx = 0; inx < input.value.length; inx++) {
       if (chars.indexOf(input.value.charAt(inx)) == -1)
           return false;
    }
    return true;
}

/**
 * 입력값이 특정 문자(chars)만으로 되어있는지 체크
 * 특정 문자만 허용하려 할 때 사용
 * input 이 폼이 아닌 실제 value를 넣는 메소드!!!!!!!!!!!!!!!!
 * ex) if (!containsCharsOnly(input,"ABO")) {
 *         alert("혈액형 필드에는 A,B,O 문자만 사용할 수 있습니다.");
 *     }
 */
function containsCharsOnly2(input,chars) {
    for (var inx = 0; inx < input.length; inx++) {
       if (chars.indexOf(input.charAt(inx)) == -1)
           return false;
    }
    return true;
}

/**
 * 입력값이 알파벳인지 체크
 * 아래 isAlphabet() 부터 isNumComma()까지의 메소드가
 * 자주 쓰이는 경우에는 var chars 변수를 
 * global 변수로 선언하고 사용하도록 한다.
 * ex) var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
 *     var lowercase = "abcdefghijklmnopqrstuvwxyz"; 
 *     var number    = "0123456789";
 *     function isAlphaNum(input) {
 *         var chars = uppercase + lowercase + number;
 *         return containsCharsOnly(input,chars);
 *     }
 */
function isAlphabet(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 알파벳 대문자인지 체크
 */
function isUpperCase(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 알파벳 소문자인지 체크
 */
function isLowerCase(input) {
    var chars = "abcdefghijklmnopqrstuvwxyz";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값에 숫자만 있는지 체크
 */
function isNumber(input) {
    var chars = "-0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 알파벳,숫자로 되어있는지 체크
 */
function isAlphaNum(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 숫자,대시(-)로 되어있는지 체크
 */
function isNumDash(input) {
    var chars = "-0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 숫자,콤마(,)로 되어있는지 체크
 */
function isNumComma(input) {
    var chars = ",0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 숫자,콤마(.)로 되어있는지 체크
 */
function isNumCom(input) {
    var chars = ".0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * 입력값이 사용자가 정의한 포맷 형식인지 체크
 * 자세한 format 형식은 자바스크립트의 'regular expression'을 참조
 */
function isValidFormat(input,format) {
    if (input.value.search(format) != -1) {
        return true; //올바른 포맷 형식
    }
    return false;
}

/**
 * 입력값이 이메일 형식인지 체크
 * ex) if (!isValidEmail(form.email)) {
 *         alert("올바른 이메일 주소가 아닙니다.");
 *     }
 */
function isValidEmail(input) {
//    var format = /^(\S+)@(\S+)\.([A-Za-z]+)$/;
    var format = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
    return isValidFormat(input,format);
}

/**
 * 입력값이 전화번호 형식(숫자-숫자-숫자)인지 체크
 */
function isValidPhone(input) {
    var format = /^(\d+)-(\d+)-(\d+)$/;
    return isValidFormat(input,format);
}

function isValidDate2(input) {
    var format = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    return isValidFormat(input,format);
}

/**
 * 입력값의 바이트 길이를 리턴
 * ex) if (getByteLength(form.title) > 100) {
 *         alert("제목은 한글 50자(영문 100자) 이상 입력할 수 없습니다.");
 *     }
 * Author : Wonyoung Lee
 */
function getByteLength(input) {
    var byteLength = 0;
    for (var inx = 0; inx < input.value.length; inx++) {
        var oneChar = escape(input.value.charAt(inx));
        if ( oneChar.length == 1 ) {
            byteLength ++;
        } else if (oneChar.indexOf("%u") != -1) {
            byteLength += 2;
        } else if (oneChar.indexOf("%") != -1) {
            byteLength += oneChar.length/3;
        }
    }
    return byteLength;
}

/**
 * 입력값에서 콤마를 없앤다.
 */
function removeComma(input) {
    return input.value.replace(/,/gi,"");
}

/**
 * 선택된 라디오버튼이 있는지 체크
 */
function hasCheckedRadio(input) {
    if (input.length > 1) {
        for (var inx = 0; inx < input.length; inx++) {
            if (input[inx].checked) return true;
        }
    } else {
        if (input.checked) return true;
    }
    return false;
}

/**
 * 선택된 체크박스가 있는지 체크
 */
function hasCheckedBox(input) {
    return hasCheckedRadio(input);
}

/**
 * 폼상에 존재하는 특정 Object에 값을 설정
 */
function setObjectValue(control, value) 
{
  if (!control) return; 

  var objdesc = new String(control);
  var b_flg = false;
	
  if ( control.type == "button"   || control.type == "hidden"   ||
	    control.type == "password" || control.type == "reset"    ||
	    control.type == "submit"   || control.type == "text"     ||
	    control.type == "textarea" )  
  {
		control.value = value;

  } 
  else if (control.type == "select-one") 
  {
	for(j=0;j < control.options.length ; j++ ) 
    {
	  if(control.options[j].value == value ) 
      {
		control.options[j].selected = true;
        b_flg=true;
	  }
	}
    if (!b_flg)
    {
	  control.options[0].selected = true;
    }
  }
  else if (control.type == "checkbox") 
  {
	 if(control.value == value ) 
     {
				control.checked = true;
	 }
  }
  else // undefine : radio
  {
    for (var i=0;i<control.length;i++)
	{
	  if (control[i].value == value)
	  {
	    control[i].checked = true;
	    break;
	  }
	}  	
  }
}

/**
*뒤로 이동
*/
function goBack() 
{
   history.go(-1);
}
	

/*
* 입력값이 null인지 체크 한 후 최대허용 글자수 체크 : flag 자음있고없고...  by fruity
* 예) isValInput(frm.text, "제목", 100, "U")
*/
function isValInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // 아래자음이 있는경우 
		{
			alert(formNm + "을 입력하세요.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "를 입력하세요.");		  
		}
		formCd.focus();
		return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // 아래자음이 있는경우 
	    {
			alert(formNm + "은 최대 " + maxLen + "자까지 입력할 수 있습니다.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "는 최대 " + maxLen + "자까지 입력할 수 있습니다.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	

/*
* 입력값이 null인지, 숫자인지, 자릿수 체크: flag 자음있고없고...  by fruity
* 예) isValInput(frm.text, "제목", 100, "U")
*/
function isValidNumberInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // 아래자음이 있는경우 
		{
			alert(formNm + "을 입력하세요.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "를 입력하세요.");		  
		}
		formCd.focus();
		return false;
	}
		
	if (!isNumber(formCd))
	{
  	    if(falg == "U") // 아래자음이 있는경우 
	    {
			alert(formNm + "은 숫자로만 입력하세요.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "는 숫자로만 입력하세요.");
	    }
		
		formCd.focus();
		return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // 아래자음이 있는경우 
	    {
			alert(formNm + "은 최대 " + maxLen + "자리 숫자까지 입력할 수 있습니다.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "는 최대 " + maxLen + "자리 숫자까지 입력할 수 있습니다.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	

/*
* 입력값이 null인지 체크 : flag 자음있고없고...  by fruity
* 예) isValInput(frm.text, "제목", "U")
*/
function isValInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // 아래자음이 있는경우 
		{
			alert(formNm + "을 입력하세요.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "를 입력하세요.");		  
		}
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* 최대허용 글자수 체크후 메세지 처리  by fruity
* 예) getByteLenMsg(frm.text, "제목", 100)
*/
function getByteLenMsg(formCd, formNm, maxLen, falg)
{
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // 아래자음이 있는경우 
	    {
			alert(formNm + "은 최대 한글 " + maxLen/2 + "자, 영문 " + maxLen + "자까지 입력할 수 있습니다.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "는 최대 한글 " + maxLen/2 + "자, 영문 " + maxLen + "자까지 입력할 수 있습니다.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	
/*
* 입력값이 null인지 체크 한 후 최대허용 글자수 체크 : 아래 자음 있는 경우  by fruity
* 예) isValidInput(frm.text, "제목", 100)
*/
function isValidInput(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + "을 입력하세요.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "은 최대 한글 " + maxLen/2 + "자, 영문 " + maxLen + "자까지 입력할 수 있습니다.");
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* 입력값이 null인지 체크 한 후 최대허용 글자수 체크 : 아래 자음 있는 경우  by citycat
* 경고창에 ~을 빼고 제목과 함께 넣게 한다.
* 예) isValidInput(frm.text, "제목", 100)
*/
function isValidInputTit(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + " 입력하세요.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "은 최대 한글 " + maxLen/2 + "자, 영문 " + maxLen + "자까지 입력할 수 있습니다.");
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* 입력값이 null인지 체크 한 후 최대허용 글자수 체크 : 아래 자음 없는 경우 by fruity 
* 예) isValidInputU(frm.text, "나라", 40)	
*/
function isValidInputU(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + "를 입력하세요.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "는 최대 한글 " + maxLen/2 + "자, 영문 " + maxLen + "자까지 입력할 수 있습니다.");
		formCd.focus();
		return false;
	}			
	
	return true;		
}


/*
* 쿠키에서 data 읽어오기 
*/
function getCookie( name )
{
	var nameOfCookie = name + "=";
	var x = 0;
	if(document.cookie.length!=0)
	{       
	   while ( x <= document.cookie.length )
	   {
			var y = (x+nameOfCookie.length);
			if ( document.cookie.substring( x, y ) == nameOfCookie ) 
	        {
	        	if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
	                endOfCookie = document.cookie.length;
	            return unescape( document.cookie.substring( y, endOfCookie ) );
	         }
	      	 x = document.cookie.indexOf( " ", x ) + 1;
	         if ( x == 0 )
	              break;
	    	}
	    	return "";
		}
	else
	{
	  return "";
	}
}

/**
* 이미지 파일 일까요??
*/
function checkingImg(filename)
{
	if (!isEmpty(filename))
	{
		var file = filename.value;
		var ext = (file.substring(file.lastIndexOf('.'), file.length)).toLowerCase();
	
		if (!(ext==".jpg" || ext==".jpeg" || ext==".gif" || ext=="png"))
		{
			alert("이미지파일의 확장자로는 jpg, jpeg, gif, png 만이 가능합니다.");
			return false;
		}
	}
	return true;
}

/**
* 음성 파일 일까요??
*/
function checkingWav(filename)
{
	if (!isEmpty(filename))
	{
		var file = filename.value;
		var ext = (file.substring(file.lastIndexOf('.'), file.length)).toLowerCase();
	
		if (!(ext==".wav" || ext==".wma" || ext==".asf" || ext==".mp3" || ext==".asx"))
		{
			alert("멀티미디어파일의 확장자로는 wav, wma, mp3, asf, asx 만이 가능합니다.");
			return false;
		}
	}
	return true;
}


/**
* checkbox 여러개 있을때 같은 이름을 가진 checkbox 모두선택, 모두선택취소

function checkAll(masterBox, input)
{
	var how = true;

	if (masterBox.checked!=true)
	{
		how = false;
	}

	max = input.length-2;

	for (i=0; i<max; i++)
	{
		input[i].checked=how;
	}
}
*/

// 이미지 사이즈 조절
function imgResize(pWidth)
{
	for(i=0;i<document.iMg.length;i++)
	{
		if (document.iMg[i].width > pWidth)
			document.iMg[i].width = pWidth;
	}
}

//----------------------------------------
// 창 닫기
//----------------------------------------	
function winSelfClose()
{
	self.close();
}




//----------------------------------------
// window popup center align
//----------------------------------------
function ComPopWin(mypage,myname,w,h)
{
	var win = null;
	var scroll = 'yes';
	
	if(mypage == "")
	{
		alert("url을 입력하십시오.");
		return;
	}
	
	if(myname == "")
	{
		myname = "popwin";
	}

	if(w == "")
	{
		w = "400";
	}

	if(h == "")
	{
		h = "300";
	}
		
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';

	win = window.open(mypage,myname,settings)
	win.focus();

	return win;
}

//----------------------------------------
// window popup center align
//----------------------------------------
function ComPopWin2(mypage,myname,w,h)
{
	var win = null;
	var scroll = 'yes';
		
	if(myname == "")
	{
		myname = "popwin";
	}

	if(w == "")
	{
		w = "400";
	}

	if(h == "")
	{
		h = "300";
	}
		
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';

	win = window.open(mypage,myname,settings)
	
	return win;
}

function ComPopWin3(mypage,myname,w,h)
{
	var win = null;
	var scroll = 'no';
	
	if(mypage == "")
	{
		alert("url을 입력하십시오.");
		return;
	}
	
	if(myname == "")
	{
		myname = "popwin";
	}

	if(w == "")
	{
		w = "400";
	}

	if(h == "")
	{
		h = "300";
	}
		
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable=no';

	win = window.open(mypage,myname,settings)
	win.focus();

	return win;
}


//----------------------------------------
// window popup center align
//----------------------------------------
function ComPopWin10(mypage,myname,w,h,x_scroll)
{
	var win = null;
	var scroll = x_scroll;
		
	if(myname == "")
	{
		myname = "popwin";
	}

	if(w == "")
	{
		w = "400";
	}

	if(h == "")
	{
		h = "300";
	}
		
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;

	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';
	// , status=1

	win = window.open(mypage,myname,settings)
	return win;
}


//-------------------------------------------------------------
// iframe resize
//-------------------------------------------------------------		
function ComResizeIframe(iFramePage,iframeID) 
{
	var framePage = eval(iFramePage);
			
	/* Checks that page is in iframe. */
	if(self==parent) 
	{
		return false; 
	}
	else if(document.getElementById&&document.all)  /* Sniffs for IE5+.*/
	{			
		// framePage is the ID of the framed page's BODY tag. 
		//The added 10 pixels prevent an unnecessary scrollbar.			
		var FramePageHeight = framePage.scrollHeight + 10; 
		
		// "iframeID" is the ID of the inline frame in the parent page.			
		parent.document.getElementById(iframeID).style.height=FramePageHeight; 
	}
}

/**
* 문제될수있는 확장자의 첨부파일 첨부 막기
* ex) js, jsp, asp, vbs, htm, html, class
*/
function isSafeFile(input)
{
	if (!isEmpty(input))
	{
		var file = input.value;
		var ext = (file.substring(file.lastIndexOf('.'), file.length)).toLowerCase();
			
		if (ext==".js" || ext==".jsp" || ext==".asp" || ext==".vbs" || ext==".htm" || ext==".html" || ext==".class")
		{
			alert("확장자가 '"+ext+"'인 파일은 업로드를 지원하지 않습니다. 압축해서 올려주세요.");
			return false;
		}
	}
	return true;
}

//-------------------------------------------------------------
// trim
//-------------------------------------------------------------	
function trim(va)
{
	va=new String(va)
	temp1=0
	for(i=0;i<va.length;i++)
	{
		temp2=va.charAt(i)
		if(temp2!=" "){temp1=i;break}
	}
	va=va.substring(temp1,va.length)
	temp1=0
	for(i=va.length-1;i>=0;i--)
	{
		temp2=va.charAt(i)
		if(temp2!=" "){temp1=i+1;break}
	}
	va=va.substring(0,temp1)
	return va
}

//-------------------------------------------------------------
// 천원단위에서 세번째자리에 ','자동 생성하기 시작 
//-------------------------------------------------------------	
function numOnMask(me)
{
	if (event.keyCode<48||event.keyCode>57)
	{//숫자외금지
	     event.returnValue=false;
	}
	var tmpH;
			
	if(me.charAt(0)=="-"){//음수가 들어왔을때 '-'를 빼고적용되게..
		tmpH=me.substring(0,1);
		me=me.substring(1,me.length);
	}	//me.indexOf('-')
 	if(me.length > 3){
 		var c=0;
 		var myArray=new Array();
   		for(var i=me.length;i>0;i=i-3){
    			myArray[c++]=me.substring(i-3,i);
  	 	}
   		myArray.reverse();
  	 	me=myArray.join(",");
 	 }
 	 if(tmpH){
 	 	me=tmpH+me;
 	 }
	return me
}

function numOffMask(me)
{
	    var tmp=me.split(",");
 	    tmp=tmp.join("");
	    return tmp;
}

function check_value(me)
{
	var myStr=numOffMask(me.value);
	me.value=numOnMask(myStr);
}
//-------------------------------------------------------------
// 천원단위에서 세번째자리에 ','자동 생성하기 끝  
//-------------------------------------------------------------	

//-------------------------------------------------------------
// 원하는 문자 빼고..
//-------------------------------------------------------------
function specialChar(inputs,chars){
    var tmp=inputs.value.split(chars);
 	tmp=tmp.join("");
 	return tmp;
}


//-------------------------------------------------------------
// 공백 반환
//-------------------------------------------------------------
function nvlTurn(input){
		if(input.value == "" || input.value == null) {
			input.value = "&nbsp;";
		}
		return input.value
	}
	
	/**
	* 소수점 n번째 자리에서 자르기
	*/
	function cutPoint(number, n)
	{
		var start = 0;
		var count = 0;
		var result = "";
	    for (var i = 0; i < number.length; i++)
	    {
	    	if (start == 0)
	    	{
		    	if (number.charAt(i) == '.')
		    		start = 1;
		    }
		    else
		    {
		    	count++;
		    	if (count == n+1)
		    		break;
		    }
		    result += number.charAt(i);
	    }
	    
	    return result;
	}
	
//-------------------------------------------------------------
// 학점 입력 소수점 1번째자리에 '.'자동 생성하기 시작 
//-------------------------------------------------------------	
function numOnPoint(me)
{
	if (event.keyCode<48||event.keyCode>57)
	{//숫자외금지
	     event.returnValue=false;
	}
	var tmpH;
			
	if(me.charAt(0)=="-"){//음수가 들어왔을때 '-'를 빼고적용되게..
		tmpH=me.substring(0,1);
		me=me.substring(1,me.length);
	}	//me.indexOf('-')
 	if(me.length > 1){
 		var c=0;
 		var myArray=new Array();
   		for(var i=me.length;i>0;i=i-1){
    			myArray[c++] = me.substring(i-1,i);
  	 	}
   	 	 myArray.reverse();
  		 me=myArray.join(".");
 	 }
 	
 	
 	 if(tmpH){
 	 	me=tmpH+me;
 	 }
	return me
}	

function numOffPoint(me)
{
	    var tmp=me.split(".");
 	    tmp=tmp.join("");
	    return tmp;
}

function check_Point(me)
{
	
	var Str=numOffPoint(me.value);
	me.value=numOnPoint(Str);
}
//-------------------------------------------------------------
// 학점 입력 소수점 1번째자리에 '.'자동 생성하기는 여기 까지.
//-------------------------------------------------------------	

//--------------------------------------------
// 체크박스 전체선택
//--------------------------------------------	
var isChecked = false;	
function checkboxAllSelect(obj)
{
	var checkObj = eval(obj);
	
	if(checkObj != null)
	{
		if(checkObj.length > 1)
		{
			for(i=0; i < checkObj.length ; i++)
			{
				if(!isChecked) 
				{
					checkObj(i).checked = true;
				} 
				else 
				{
					checkObj(i).checked = false;
				}	
			}
		}
		else
		{
			if(!isChecked) 
			{
				checkObj.checked = true;
			} 
			else 
			{
				checkObj.checked = false;
			}	
		}
		
		if(isChecked) 
		{
			isChecked = false;		
		}
		else 
		{
			isChecked = true;
		}		
	}
	else
	{
		alert("선택된 항목이 없습니다.");
	}
}

	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	// 날짜 유효성체크 ('YYYYMMDD' 포맷)
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	
	/**
	 * 유효한(존재하는) 월(月)인지 체크
	 */
	function isValidMonth(mm)
	{
	    var m = parseInt(mm,10);
	    return (m >= 1 && m <= 12);
	}
	
	/**
	 * 유효한(존재하는) 일(日)인지 체크
	 */
	function isValidDay(yyyy, mm, dd)
	{
	    var m = parseInt(mm,10) - 1;
	    var d = parseInt(dd,10);
	
	    var end = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	    if ((yyyy % 4 == 0 && yyyy % 100 != 0) || yyyy % 400 == 0)
	    {
	        end[1] = 29;
	    }
	
	    return (d >= 1 && d <= end[m]);
	}



	function isValidDay8(yyyy, mm, dd)
	{
		if( yyyy.length != 4 ){
			return false;
		}
		if( mm.length != 2 ){
			return false;
		}
		if( dd.length != 2 ){
			return false;
		}

	    var m = parseInt(mm,10) - 1;
	    var d = parseInt(dd,10);
	
	    var end = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	    if ((yyyy % 4 == 0 && yyyy % 100 != 0) || yyyy % 400 == 0)
	    {
	        end[1] = 29;
	    }
	
	    return (d >= 1 && d <= end[m]);
	}	
	

	/**
	 * 유효한 날짜인지 체크(yyyymmdd 포맷)
	 */
	function isValidDate(time)
	{
		if(time.length != 8)
		{
			return false;
		}
		
		if (time == null || time.replace(/ /gi,"") == "")
			return true;
		
	    var year  = time.substring(0,4);
	    var month = time.substring(4,6);
	    var day   = time.substring(6,8);
	
	    if (parseInt(year,10) >= 1900  && isValidMonth(month) && isValidDay(year,month,day))
	    {
	        return true;
	    }
	    return false;
	}
	

	
	
	// =====================================
	//
	// ======================================
	function getToday(type){
		var todate = new Date();

		var yyyy = todate.getYear() ;
		var mm = todate.getMonth() +1;
		var dd = todate.getDate();
	
		if( mm < 10 )
			mm = "0"+mm;

		if( dd < 10 )
			dd = "0"+dd;


		if(type=='YYYYMMDD') {
			return ''+yyyy+mm+dd;
		} else  if(type=='YYYY-MM-DD') {
			return ''+yyyy+'-'+mm+'-'+dd;		
		} else  if(type=='YYYY/MM/DD') {
			return ''+yyyy+'/'+mm+'/'+dd;		
		} else  if(type=='YYYY.MM.DD') {
			return ''+yyyy+'. '+mm+'. '+dd;		
		} else {
			return ''+yyyy+mm+dd;
		}
		
		 return ''+yyyy+mm+dd;
	}
	


	function getCurrentTime() {
		var date = new Date();
		var year  = date.getFullYear() + "";
		var month = (date.getMonth() + 1) + ""; // 1월=0,12월=11이므로 1 더함
		var day   = date.getDate() + "";
		var hour  = date.getHours() + "";
		var min   = date.getMinutes() + "";
		var second = date.getSeconds() + "";
		var millisecond = date.getMilliseconds();

		if (month.length == 1) { month = "0" + month; }
		if (day.length   == 1) { day   = "0" + day;   }
		if (hour.length  == 1) { hour  = "0" + hour;  }
		if (min.length   == 1) { min   = "0" + min;   }
		if (second.length   == 1) { second   = "0" + second;   }
		millisecond = "" + millisecond;

		return year + month + day + hour + min + second ;
	}


	function getDateDiff( ymd1, ymd2 ){

		v1=ymd1.split("-");
		v2=ymd2.split("-");

		a1=new Date(v1[0],v1[1],v1[2]).getTime();
		a2=new Date(v2[0],v2[1],v2[2]).getTime();

		b=(a2-a1)/(1000*60*60*24);

		return b;

	}


	function addDay(ymd, pDay){
		v=ymd.split("-");
		a=new Date(v[0],parseInt(v[1])-1,parseInt(v[2])+pDay);


		var yyyy = a.getYear() ;
		var mm = a.getMonth() +1;
		var dd = a.getDate();
	
		if( mm < 10 )
			mm = "0"+mm;

		if( dd < 10 )
			dd = "0"+dd;

		return ''+yyyy+'-'+mm+'-'+dd;
	}




		
	//숫자만 입력확인
	//ex : <input type=text name=sum_objective size=5 style="ime-mode:disabled" onkeypress="onlyNumber();">
	function onlyNumber()
	{
		if(((event.keyCode<48)||(event.keyCode>57)) && event.keyCode !=13)
		{
			event.returnValue=false;
			alert("숫자만 입력할 수 있습니다.");
		}
	}
	//key event 숫자만 입력확인
	//숫자만 입력 ('.'포함)
	function onlyNumber2()
	{
		if(((event.keyCode<48)||(event.keyCode>57)) && 
			event.keyCode !=46 && event.keyCode !=13)
		{
			event.returnValue=false;
			alert("숫자와 소수점만 입력할 수 있습니다.");
		}
	}

//입력폼에 콤마추가
	function numberComma(_number) {
//		 onKeyUp="this.value=numberComma(this.value);"
		while(_number.indexOf(",") > 0)
			_number = _number.replace(",", "");
		if (isNaN(_number))
			return;
		var _regExp = new RegExp("(-?[0-9]+)([0-9]{3})");
		while (_regExp.test(_number)) {
			_number = _number.replace(_regExp, "$1,$2");
		}
		return _number;
	}

	function setComma(numStr){
		if( numStr == undefined ) numStr = "";
		numStr = numStr + "";
		var tmp = numStr.replace(/,/gi,"");
		var num1 = "";
		var num2 = "";
		if( tmp.indexOf(".") != -1 ){
			num1 = tmp.substring(0,tmp.indexOf("."));
			num2 = tmp.substring(tmp.indexOf(".")+1);
		}else{
			num1 = tmp;
			num2 = "";
		}
		//alert(num1)
		//alert(num2)

		var numComma = ""
		if( num1.charAt(0) == "-" ){ // '-'를 빼고적용되게..
			numComma = num1.substring(1,num1.length);
		}else{
			numComma = num1;
		}
		if( numComma.length > 3 ){
			var c=0;
			var myArray = new Array();
			for(var i= numComma.length ;i>0; i=i-3 ){
				myArray[c++] = numComma.substring(i-3,i);
			}
			myArray.reverse();
			numComma = myArray.join(",");
		}
		if( num1.charAt(0) == "-" ){
			numComma = "-" + numComma;
		}
		if( num2 != "" ){
			numComma = numComma + "." + num2;
		}
		return numComma;
	}

	
	//계약체결 코드 리스트
	var code_no = new Array();
	code_no[0] = "1:(주)하나로오토클럽";
	code_no[1] = "2:(주)하나로자동차관리";
	code_no[2] = "3:(주)하나로동양";
	code_no[3] = "4:강서울";
	code_no[4] = "5:카닉";
	code_no[5] = "6:드림";
	code_no[6] = "7:인슈넷";
	code_no[7] = "8:안미자";
	code_no[8] = "9:티코";
	code_no[9] = "10:기타";
	code_no[10] = "11:보험안전지대";
	code_no[11] = "12:굿프랜";
	code_no[12] = "13:파트너";
	code_no[13] = "15:보험테크";
	code_no[14] = "16:태일";
	code_no[15] = "17:아이리치";
	code_no[16] = "18:꽃동산(쌍용)";
	code_no[17] = "19:북부대리점";
	code_no[18] = "20:유진대리점";
	code_no[19] = "21:인스케어플러스";
	code_no[20] = "22:(주)그린하나로";
	code_no[21] = "23:보험콜(그린)";
	code_no[22] = "25:(주)하나로인스클럽";
	code_no[23] = "28:(주)하나로프로미인스";
	code_no[24] = "29:(주)하나로하이카인스";
	code_no[25] = "30:(주)하나로마이카인스";
	code_no[26] = "31:이성희";
	code_no[27] = "32:수이";
	code_no[28] = "33:서보험";
	code_no[29] = "34:위콘";
	code_no[30] = "35:(주)하나로마이카인스일산지점";
	code_no[31] = "36:(주)하나로마이카인스직할지점";
	code_no[32] = "37:(주)하나로매직카인스";
	code_no[33] = "38:(주)하나로레디카인스";
	code_no[34] = "39:보험콜(토탈인스)";
	
	function getCodeNoList()
	{
		var args = arguments;	
		if(args[0] == undefined) { return; } //form name
		if(args[1] == undefined) { return; } //add select box name
		
		if(args[2] == undefined) {  //default text
			args[2] = "";
		}
		if(args[3] == undefined) {  //default value
			args[3] = "";
		}
		if(args[4] == undefined) { //select value
			args[4] = "";
		}
	
		var form = args[0];
		var name = args[1];
		
		document.forms[form].elements[name].length = 1;
		document.forms[form].elements[name][0].text = args[2];
		document.forms[form].elements[name][0].value = args[3];
		
		for(i=0;i<code_no.length;i++){
			document.forms[form].elements[name].length += 1;
			document.forms[form].elements[name][i+1].text = code_no[i].split(":")[1];
			document.forms[form].elements[name][i+1].value = code_no[i];

			if(args[4] != "" && args[4] == code_no[i].split(":")[0])
			{	
				document.forms[form].elements[name].selectedIndex = i+1;
			}
		}


	}
	
	//카드사 리스트
	var card_company = new Array();
	card_company[0] = "비씨카드";
	card_company[1] = "국민카드";
	card_company[2] = "삼성카드";
	card_company[3] = "엘지카드";
	card_company[4] = "외환카드";
	card_company[5] = "현대카드";
	card_company[6] = "우리카드";
	card_company[7] = "신한카드";
	card_company[8] = "동양카드";
	card_company[9] = "제주카드";
	card_company[10] = "하나카드";
	card_company[11] = "한미카드";
	card_company[12] = "롯데카드";
	card_company[13] = "기타";
	
	function getCardCompanyList()
	{
		var args = arguments;	
		if(args[0] == undefined) { return; } //form name
		if(args[1] == undefined) { return; } //add select box name
		
		if(args[2] == undefined) {  //default text
			args[2] = "";
		}
		if(args[3] == undefined) {  //default value
			args[3] = "";
		}
		if(args[4] == undefined) { //select value
			args[4] = "";
		}
	
		var form = args[0];
		var name = args[1];
		
		document.forms[form].elements[name].length = 1;
		document.forms[form].elements[name][0].text = args[2];
		document.forms[form].elements[name][0].value = args[3];
	
		for(i=0;i<card_company.length;i++){
			document.forms[form].elements[name].length += 1;
			document.forms[form].elements[name][i+1].text = card_company[i];
			document.forms[form].elements[name][i+1].value = card_company[i];
			
			if(args[4] != "" && args[4] == card_company[i])
			{
				document.forms[form].elements[name].selectedIndex = i+1;
			}
		}
	}
	
	//은행 리스트
	var bank_company = new Array();
	bank_company[0] = "국민은행";
	bank_company[1] = "기업은행";
	bank_company[2] = "농협은행";
	bank_company[3] = "우리은행";
	bank_company[4] = "서울은행";
	bank_company[5] = "신한은행";
	bank_company[6] = "외환은행";
	bank_company[7] = "제일은행";
	bank_company[8] = "조흥은행";
	bank_company[9] = "하나은행";
	bank_company[10] = "한미은행";
	bank_company[11] = "우체국";
	bank_company[12] = "경남은행";
	bank_company[13] = "광주은행";
	bank_company[14] = "대구은행";
	bank_company[15] = "도이치은행";
	bank_company[16] = "부산은행";
	bank_company[17] = "산업은행";
	bank_company[18] = "수협은행";
	bank_company[19] = "씨티은행";
	bank_company[20] = "전북은행";
	bank_company[21] = "제주은행";
	bank_company[22] = "새마을금고";
	bank_company[23] = "신용협동조합";
	
	function getBankCompanyList()
	{
		var args = arguments;	
		if(args[0] == undefined) { return; } //form name
		if(args[1] == undefined) { return; } //add select box name
		
		if(args[2] == undefined) {  //default text
			args[2] = "";
		}
		if(args[3] == undefined) {  //default value
			args[3] = "";
		}
		if(args[4] == undefined) { //select value
			args[4] = "";
		}
	
		var form = args[0];
		var name = args[1];
		
		document.forms[form].elements[name].length = 1;
		document.forms[form].elements[name][0].text = args[2];
		document.forms[form].elements[name][0].value = args[3];
	
		for(i=0;i<bank_company.length;i++){
			document.forms[form].elements[name].length += 1;
			document.forms[form].elements[name][i+1].text = bank_company[i];
			document.forms[form].elements[name][i+1].value = bank_company[i];
			
			if(args[4] != "" && args[4] == bank_company[i])
			{
				document.forms[form].elements[name].selectedIndex = i+1;
			}
		}
	}
	
	
	//발송방법 리스트
	var post_delivery = new Array();
	post_delivery[0] = "250,일반우편(250원)";
	post_delivery[1] = "300,일반우편(300원)";
	post_delivery[2] = "0,빠른우편";
	post_delivery[3] = "0,일반등기";
	post_delivery[4] = "0,택배";
	post_delivery[5] = "0,기타";
	post_delivery[6] = "0,멤버에게전달";
	
	function getPostDelveryList()
	{
		var args = arguments;	
		if(args[0] == undefined) { return; } //form name
		if(args[1] == undefined) { return; } //add select box name
		
		if(args[2] == undefined) {  //default text
			args[2] = "";
		}
		if(args[3] == undefined) {  //default value
			args[3] = "";
		}
		if(args[4] == undefined) { //select value
			args[4] = "";
		}
	
		var form = args[0];
		var name = args[1];
		
		document.forms[form].elements[name].length = 1;
		document.forms[form].elements[name][0].text = args[2];
		document.forms[form].elements[name][0].value = args[3];
	
		for(i=0;i<post_delivery.length;i++){
			var parse = post_delivery[i].split(",");
			
			document.forms[form].elements[name].length += 1;
			document.forms[form].elements[name][i+1].text = parse[1];
			document.forms[form].elements[name][i+1].value = parse[0];
			
			if(args[4] != "" && args[4] == parse[0])
			{
				document.forms[form].elements[name].selectedIndex = i+1;
			}
		}
	}
	
	//지도책 리스트
	var map_book = new Array();
	map_book[0] = "2000:2,000 원";
	map_book[1] = "2500:2,500 원";
	map_book[2] = "3000:3,000 원";
	map_book[3] = "5000:5,000 원";
	map_book[4] = "10000:10,000 원";
	map_book[5] = "15000:15,000 원";
	map_book[6] = "20000:20,000 원";
	
	function getMapBookList()
	{
		var args = arguments;	
		if(args[0] == undefined) { return; } //form name
		if(args[1] == undefined) { return; } //add select box name
		
		if(args[2] == undefined) {  //default text
			args[2] = "";
		}
		if(args[3] == undefined) {  //default value
			args[3] = "";
		}
		if(args[4] == undefined) { //select value
			args[4] = "";
		}
	
		var form = args[0];
		var name = args[1];
		
		document.forms[form].elements[name].length = 1;
		document.forms[form].elements[name][0].text = args[2];
		document.forms[form].elements[name][0].value = args[3];
	
		for(i=0;i<map_book.length;i++){
			var parse = map_book[i].split(":");
			
			document.forms[form].elements[name].length += 1;
			document.forms[form].elements[name][i+1].text = parse[1];
			document.forms[form].elements[name][i+1].value = parse[0];
			
			if(args[4] != "" && args[4] == parse[0])
			{
				document.forms[form].elements[name].selectedIndex = i+1;
			}
		}
	}
	
	/**
	 * 날짜 하이픈 자동으로 입력
	 * @param {Object} obj
	 */
	function dayFormat(obj)
	{
		/*
		if( event.keyCode == 9 || event.keyCode == 16 ){
			return;
		}

		var chars = "0123456789-";
		var isValidChar = true;
		for (var i = 0; i < obj.value.length; i++) {
			if (chars.indexOf(obj.value.charAt(i)) == -1){
				isValidChar = false;
				break;
			}
		}

		if( !isValidChar ){
			obj.value = obj.value.substring(0, obj.value.length-1);
			return;
		}

		var temp_value = obj.value.replace(/[^0-9]/gi,"");
		var re = /([0-9]{4})([0-9]{2})([0-9]{2}$)/;
		if ( re.exec(temp_value) == null ){
			return;
		}
		temp_value = temp_value.replace(re,"$1-$2-$3"); 
		obj.value = temp_value; 

		//return autoTab( obj, 10, event );
		*/
		
		if(typeof(obj) == "object")
		{
			obj.value = obj.value.replace(/\-/g,"");
			obj.select();
			
			if(!obj.onblur)
			{
				obj.onblur = function()
				{
					this.value = this.value.replace(/\-/g, "");
					var str = this.value;
					var l = str.length;
					
					if(l == 8)
					{
						str = str.substr(0,4) + "-" + str.substr(4,2) + "-" + str.substr(6,2);
					}
					
					this.value = str;			
				}
			}
		}
		
		if(typeof(obj) == "string")
		{
			var str = obj;
			var l = str.length;
			
			if(l == 8)
			{
				str = str.substr(0,4) + "-" + str.substr(4,2) + "-" + str.substr(6,2);
			}
			
			return str;	
		}
	}
	
	/**
	 * 날짜 형식 및 유효성 체크
	 * @param {Object} obj
	 */
	function dayCheck(obj)
	{
		var is_check = true;
		var day = obj.value;
		
		if(day.match(/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/g) != day)
		{
			is_check = false;
		} else {
			var temp = day.replace(/\-/g,"");
			if(isValidDate(temp) == false)
			{
				is_check = false;
			}
		}
		
		return is_check;
	}
	
	/**
	 * 전화번호 하이픈 자동으로 입력
	 * @param {Object} obj
	 */
	function phoneFormat(obj) 
	{
		if(typeof(obj) == "object")
		{
			obj.value = obj.value.replace(/\-/g,"");
			obj.select();
			
			if(!obj.onblur)
			{
				obj.onblur = function()
				{
					this.value = this.value.replace(/\-/g, "");
					var str = this.value;
					var l = str.length;
					
					if (l == 9 || l == 10 || l == 11) 
					{
						str = str.substr(0,(k = (str.substr(0,2) == "02") ? 2 : 3)) + "-" + str.substr(k, l - 4 - k) + "-" + str.substr(l - 4);
						
						this.value = str;
					}
				}
			}
		}
		
		if(typeof(obj) == "string")
		{
			var str = obj;
			var l = str.length;
			
			if (l == 9 || l == 10 || l == 11) 
			{
				str = str.substr(0,(k = (str.substr(0,2) == "02") ? 2 : 3)) + "-" + str.substr(k, l - 4 - k) + "-" + str.substr(l - 4);
			}

			return str;
		}
	}
		
	/**
	 * 전화번호 형식 체크(02-1234-1234)
	 * @param {Object} obj
	 */
	function phoneCheck(obj)
	{
		var is_check = true;
		var phone = obj.value;
				
		if(phone.match(/[0-9]{2,3}\-[0-9]{3,4}\-[0-9]{4}/g)!= phone && phone.match(/[0-9]{2,3}[0-9]{3,4}[0-9]{4}/g)!= phone)
		{
			is_check = false;
		}
		
		return is_check;
	}
	
	function phoneCheck2(obj)
	{
		var is_check = true;
		var phone = obj.value;
		phone = phone.replace( /-/gi, "");

		var isNum = false;
		if( phone.length > 0 ){
			isNum = true;
			for (var inx = 0; inx < phone.length; inx++) {
			   if ("0123456789".indexOf(phone.charAt(inx)) == -1){
				   isNum = false;
			   }
			}
		}

		if( !isNum || phone.length < 8 ){
			is_check = false;
		}
		return is_check;
	}

	/**
	 * 주민번호/사업번호 자동으로 하이픈 입력
	 * @param {Object} obj
	 */
	function ssnFormat(obj) 
	{
		if(typeof(obj) == "object")
		{
			obj.value = obj.value.replace(/\-/g,"");
			obj.select();
			
			if(!obj.onblur)
			{
				obj.onblur = function()
				{
					this.value = this.value.replace(/\-/g,"");
					var str = this.value;
					var l = str.length;
					
					//주민번호
					if(l == 13)
					{
						str = str.substr(0,6) + "-" + str.substr(6,7);
					}
									
					//사업자번호
					if(l == 10)
					{
						str = str.substr(0,3) + "-" + str.substr(3,2) + "-" + str.substr(5,5);
					}
						
					this.value = str;
				}
			}
		}
		
		if(typeof(obj) == "string")
		{
			var str = obj;
			var l = str.length;
			
			//주민번호
			if(l == 13)
			{
				str = str.substr(0,6) + "-" + str.substr(6,7);
			}
							
			//사업자번호
			if(l == 10)
			{
				str = str.substr(0,3) + "-" + str.substr(3,2) + "-" + str.substr(5,5);
			}
			
			return str;		
		}
	}
	
	/**
	 * 주민번호/사업자번호 형식 체크
	 * @param {Object} obj
	 */
	function ssnCheck(obj)
	{
		var is_check = false;
		var ssn = obj.value;
				
		if(ssn.length == 14)
		{
			if(ssn.match(/[0-9]{6}\-[0-9]{7}/g) == ssn)
			{
				is_check = true;
			}
		}
		
		if(ssn.length == 12)
		{
			if(ssn.match(/[0-9]{3}\-[0-9]{2}\-[0-9]{5}/g) == ssn)
			{
				is_check = true;
			}
		}
		
		return is_check;
	}

	/**
	 * 우편번호 하이픈 자동으로 입력
	 * @param {Object} obj
	 */
	function zipFormat(obj) 
	{
		if(typeof(obj) == "object")
		{
			obj.value = obj.value.replace(/\-/g,"");
			obj.select();
			
			if(!obj.onblur)
			{
				obj.onblur = function()
				{
					this.value = this.value.replace(/\-/g,"");
					var str = this.value;
					var l = str.length;
					
					if(l == 6)
					{
						str = str.substr(0,3) + "-" + str.substr(3,3);	
					}
					
					this.value = str;
				}
			}
		}
		
		if(typeof(obj) == "string")
		{
			var str = obj;
			var l = str.length;
			
			if(l == 6)
			{
				str = str.substr(0,3) + "-" + str.substr(3,3);	
			}
			
			return str;	
		}
	}
	
	/**
	 * 우편번호 형식 체크
	 * @param {Object} obj
	 */
	function zipCheck(obj)
	{
		var is_check = true;
		var zip = obj.value;
		
		if(zip.match(/[0-9]{3}\-[0-9]{3}/g)!= zip)
		{
			is_check = false;
		}
		
		return is_check;
	}


	/**
	 * selct 박스 선택
	 */
	function findSelect(obj, strVal)
	{
		if (obj == undefined)
			return;
		if (obj.length == undefined)
			return;
		for (var i=0;i<obj.length;i++)
		{
			if (obj[i].value == strVal)
			{
				obj[i].selected = true;
				break;
			}
		}
		return i;
	}


	/**
	 * 숫자로 변환
	 * @param str
	 * @returns {Number}
	 */
	function toInt(str){
		var iValue = 0;
		if( str == undefined ) str = "";
		str = str + "";
		str = str.replace(/,/gi,"");
		iValue = parseInt(str,10);
		if( isNaN(iValue) ) iValue = 0;
		return iValue;
	}

	/**
	 * 숫자로 변환
	 * @param str
	 * @returns {Number}
	 */
	function toFloat(str){
		var iValue = 0;
		if( str == undefined ) str = "";
		str = str + "";
		str = str.replace(/,/gi,"");
		iValue = parseFloat(str);
		if( isNaN(iValue) ) iValue = 0;
		return iValue;
	}

	var area_code = new Array();
	area_code[0]="서울";
	area_code[1]="부산";
	area_code[2]="대구";
	area_code[3]="인천";
	area_code[4]="광주";
	area_code[5]="대전";
	area_code[6]="울산";
	area_code[7]="경기";
	area_code[8]="강원";
	area_code[9]="충북";
	area_code[10]="충남";
	area_code[11]="전북";
	area_code[12]="전남";
	area_code[13]="경북";
	area_code[14]="경남";
	area_code[15]="제주";


window.document.ondragstart = new Function("return false;");
//window.document.onselectstart = new Function("return false;");
//window.document.oncontextmenu = new Function("return false;");



	function get_round(retval)
	{
		retval = Math.floor(Math.round(retval)/10) * 10;
		return retval;
	}

// onload 2개 이상 선언 가능 함수
function addLoadEvent(func) {
    var oldonload = window.onload;
        if(typeof window.onload != 'function') {
            window.onload = func;
        } else {
            window.onload = function() {
                oldonload();
                func();
        }
    }
}
//데모 팝업
function alert_demo() {
	alert('정식 이용시 가능합니다.');
}
//권한 없음 (지사관리ID 사업장정보 수정, 취업규칙 열람 금지)
function alert_no_right() {
	alert('권한이 없습니다.');
}
