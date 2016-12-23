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
 * �Է°��� NULL���� üũ
 */
function isNull(input) {
    if (input.value == null || input.value == "") {
        return true;
    }
    return false;
}

/**
 * �Է°��� �����̽� �̿��� �ǹ��ִ� ���� �ִ��� üũ
 * ex) if (isEmpty(form.keyword)) {
 *         alert("�˻������� �Է��ϼ���.");
 *     }
 */
function isEmpty(input) {
    if (input.value == null || input.value.replace(/ /gi,"") == "") {
        return true;
    }
    return false;
}

/**
 * �Է°��� Ư�� ����(chars)�� �ִ��� üũ
 * Ư�� ���ڸ� ������� ������ �� �� ���
 * ex) if (containsChars(form.name,"!,*&^%$#@~;")) {
 *         alert("�̸� �ʵ忡�� Ư�� ���ڸ� ����� �� �����ϴ�.");
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
 * �Է°��� Ư�� ����(chars)������ �Ǿ��ִ��� üũ
 * Ư�� ���ڸ� ����Ϸ� �� �� ���
 * ex) if (!containsCharsOnly(form.blood,"ABO")) {
 *         alert("������ �ʵ忡�� A,B,O ���ڸ� ����� �� �ֽ��ϴ�.");
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
 * �Է°��� Ư�� ����(chars)������ �Ǿ��ִ��� üũ
 * Ư�� ���ڸ� ����Ϸ� �� �� ���
 * input �� ���� �ƴ� ���� value�� �ִ� �޼ҵ�!!!!!!!!!!!!!!!!
 * ex) if (!containsCharsOnly(input,"ABO")) {
 *         alert("������ �ʵ忡�� A,B,O ���ڸ� ����� �� �ֽ��ϴ�.");
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
 * �Է°��� ���ĺ����� üũ
 * �Ʒ� isAlphabet() ���� isNumComma()������ �޼ҵ尡
 * ���� ���̴� ��쿡�� var chars ������ 
 * global ������ �����ϰ� ����ϵ��� �Ѵ�.
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
 * �Է°��� ���ĺ� �빮������ üũ
 */
function isUpperCase(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ���ĺ� �ҹ������� üũ
 */
function isLowerCase(input) {
    var chars = "abcdefghijklmnopqrstuvwxyz";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ���ڸ� �ִ��� üũ
 */
function isNumber(input) {
    var chars = "-0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ���ĺ�,���ڷ� �Ǿ��ִ��� üũ
 */
function isAlphaNum(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ����,���(-)�� �Ǿ��ִ��� üũ
 */
function isNumDash(input) {
    var chars = "-0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ����,�޸�(,)�� �Ǿ��ִ��� üũ
 */
function isNumComma(input) {
    var chars = ",0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ����,�޸�(.)�� �Ǿ��ִ��� üũ
 */
function isNumCom(input) {
    var chars = ".0123456789";
    return containsCharsOnly(input,chars);
}

/**
 * �Է°��� ����ڰ� ������ ���� �������� üũ
 * �ڼ��� format ������ �ڹٽ�ũ��Ʈ�� 'regular expression'�� ����
 */
function isValidFormat(input,format) {
    if (input.value.search(format) != -1) {
        return true; //�ùٸ� ���� ����
    }
    return false;
}

/**
 * �Է°��� �̸��� �������� üũ
 * ex) if (!isValidEmail(form.email)) {
 *         alert("�ùٸ� �̸��� �ּҰ� �ƴմϴ�.");
 *     }
 */
function isValidEmail(input) {
//    var format = /^(\S+)@(\S+)\.([A-Za-z]+)$/;
    var format = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
    return isValidFormat(input,format);
}

/**
 * �Է°��� ��ȭ��ȣ ����(����-����-����)���� üũ
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
 * �Է°��� ����Ʈ ���̸� ����
 * ex) if (getByteLength(form.title) > 100) {
 *         alert("������ �ѱ� 50��(���� 100��) �̻� �Է��� �� �����ϴ�.");
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
 * �Է°����� �޸��� ���ش�.
 */
function removeComma(input) {
    return input.value.replace(/,/gi,"");
}

/**
 * ���õ� ������ư�� �ִ��� üũ
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
 * ���õ� üũ�ڽ��� �ִ��� üũ
 */
function hasCheckedBox(input) {
    return hasCheckedRadio(input);
}

/**
 * ���� �����ϴ� Ư�� Object�� ���� ����
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
*�ڷ� �̵�
*/
function goBack() 
{
   history.go(-1);
}
	

/*
* �Է°��� null���� üũ �� �� �ִ���� ���ڼ� üũ : flag �����ְ����...  by fruity
* ��) isValInput(frm.text, "����", 100, "U")
*/
function isValInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // �Ʒ������� �ִ°�� 
		{
			alert(formNm + "�� �Է��ϼ���.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "�� �Է��ϼ���.");		  
		}
		formCd.focus();
		return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // �Ʒ������� �ִ°�� 
	    {
			alert(formNm + "�� �ִ� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "�� �ִ� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	

/*
* �Է°��� null����, ��������, �ڸ��� üũ: flag �����ְ����...  by fruity
* ��) isValInput(frm.text, "����", 100, "U")
*/
function isValidNumberInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // �Ʒ������� �ִ°�� 
		{
			alert(formNm + "�� �Է��ϼ���.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "�� �Է��ϼ���.");		  
		}
		formCd.focus();
		return false;
	}
		
	if (!isNumber(formCd))
	{
  	    if(falg == "U") // �Ʒ������� �ִ°�� 
	    {
			alert(formNm + "�� ���ڷθ� �Է��ϼ���.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "�� ���ڷθ� �Է��ϼ���.");
	    }
		
		formCd.focus();
		return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // �Ʒ������� �ִ°�� 
	    {
			alert(formNm + "�� �ִ� " + maxLen + "�ڸ� ���ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "�� �ִ� " + maxLen + "�ڸ� ���ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	

/*
* �Է°��� null���� üũ : flag �����ְ����...  by fruity
* ��) isValInput(frm.text, "����", "U")
*/
function isValInput(formCd, formNm, maxLen, falg)
{
	if (isEmpty(formCd))
	{
		if(falg == "U") // �Ʒ������� �ִ°�� 
		{
			alert(formNm + "�� �Է��ϼ���.");	
		}
		else if(falg == "E")
		{
			alert(formNm + "�� �Է��ϼ���.");		  
		}
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* �ִ���� ���ڼ� üũ�� �޼��� ó��  by fruity
* ��) getByteLenMsg(frm.text, "����", 100)
*/
function getByteLenMsg(formCd, formNm, maxLen, falg)
{
	if (getByteLength(formCd) > maxLen)
	{
  	    if(falg == "U") // �Ʒ������� �ִ°�� 
	    {
			alert(formNm + "�� �ִ� �ѱ� " + maxLen/2 + "��, ���� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		else if(falg == "E")
	  	{
			alert(formNm + "�� �ִ� �ѱ� " + maxLen/2 + "��, ���� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
	    }
		
		formCd.focus();
		return false;
	}
	
	return true;			
}
	
/*
* �Է°��� null���� üũ �� �� �ִ���� ���ڼ� üũ : �Ʒ� ���� �ִ� ���  by fruity
* ��) isValidInput(frm.text, "����", 100)
*/
function isValidInput(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + "�� �Է��ϼ���.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "�� �ִ� �ѱ� " + maxLen/2 + "��, ���� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* �Է°��� null���� üũ �� �� �ִ���� ���ڼ� üũ : �Ʒ� ���� �ִ� ���  by citycat
* ���â�� ~�� ���� ����� �Բ� �ְ� �Ѵ�.
* ��) isValidInput(frm.text, "����", 100)
*/
function isValidInputTit(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + " �Է��ϼ���.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "�� �ִ� �ѱ� " + maxLen/2 + "��, ���� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
		formCd.focus();
		return false;
	}
	
	return true;			
}

/*
* �Է°��� null���� üũ �� �� �ִ���� ���ڼ� üũ : �Ʒ� ���� ���� ��� by fruity 
* ��) isValidInputU(frm.text, "����", 40)	
*/
function isValidInputU(formCd, formNm, maxLen)
{
	if (isEmpty(formCd))
	{
	  alert(formNm + "�� �Է��ϼ���.");
	  formCd.focus();
	  return false;
	}
		
	if (getByteLength(formCd) > maxLen)
	{
		alert(formNm + "�� �ִ� �ѱ� " + maxLen/2 + "��, ���� " + maxLen + "�ڱ��� �Է��� �� �ֽ��ϴ�.");
		formCd.focus();
		return false;
	}			
	
	return true;		
}


/*
* ��Ű���� data �о���� 
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
* �̹��� ���� �ϱ��??
*/
function checkingImg(filename)
{
	if (!isEmpty(filename))
	{
		var file = filename.value;
		var ext = (file.substring(file.lastIndexOf('.'), file.length)).toLowerCase();
	
		if (!(ext==".jpg" || ext==".jpeg" || ext==".gif" || ext=="png"))
		{
			alert("�̹��������� Ȯ���ڷδ� jpg, jpeg, gif, png ���� �����մϴ�.");
			return false;
		}
	}
	return true;
}

/**
* ���� ���� �ϱ��??
*/
function checkingWav(filename)
{
	if (!isEmpty(filename))
	{
		var file = filename.value;
		var ext = (file.substring(file.lastIndexOf('.'), file.length)).toLowerCase();
	
		if (!(ext==".wav" || ext==".wma" || ext==".asf" || ext==".mp3" || ext==".asx"))
		{
			alert("��Ƽ�̵�������� Ȯ���ڷδ� wav, wma, mp3, asf, asx ���� �����մϴ�.");
			return false;
		}
	}
	return true;
}


/**
* checkbox ������ ������ ���� �̸��� ���� checkbox ��μ���, ��μ������

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

// �̹��� ������ ����
function imgResize(pWidth)
{
	for(i=0;i<document.iMg.length;i++)
	{
		if (document.iMg[i].width > pWidth)
			document.iMg[i].width = pWidth;
	}
}

//----------------------------------------
// â �ݱ�
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
		alert("url�� �Է��Ͻʽÿ�.");
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
		alert("url�� �Է��Ͻʽÿ�.");
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
* �����ɼ��ִ� Ȯ������ ÷������ ÷�� ����
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
			alert("Ȯ���ڰ� '"+ext+"'�� ������ ���ε带 �������� �ʽ��ϴ�. �����ؼ� �÷��ּ���.");
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
// õ���������� ����°�ڸ��� ','�ڵ� �����ϱ� ���� 
//-------------------------------------------------------------	
function numOnMask(me)
{
	if (event.keyCode<48||event.keyCode>57)
	{//���ڿܱ���
	     event.returnValue=false;
	}
	var tmpH;
			
	if(me.charAt(0)=="-"){//������ �������� '-'�� ��������ǰ�..
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
// õ���������� ����°�ڸ��� ','�ڵ� �����ϱ� ��  
//-------------------------------------------------------------	

//-------------------------------------------------------------
// ���ϴ� ���� ����..
//-------------------------------------------------------------
function specialChar(inputs,chars){
    var tmp=inputs.value.split(chars);
 	tmp=tmp.join("");
 	return tmp;
}


//-------------------------------------------------------------
// ���� ��ȯ
//-------------------------------------------------------------
function nvlTurn(input){
		if(input.value == "" || input.value == null) {
			input.value = "&nbsp;";
		}
		return input.value
	}
	
	/**
	* �Ҽ��� n��° �ڸ����� �ڸ���
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
// ���� �Է� �Ҽ��� 1��°�ڸ��� '.'�ڵ� �����ϱ� ���� 
//-------------------------------------------------------------	
function numOnPoint(me)
{
	if (event.keyCode<48||event.keyCode>57)
	{//���ڿܱ���
	     event.returnValue=false;
	}
	var tmpH;
			
	if(me.charAt(0)=="-"){//������ �������� '-'�� ��������ǰ�..
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
// ���� �Է� �Ҽ��� 1��°�ڸ��� '.'�ڵ� �����ϱ�� ���� ����.
//-------------------------------------------------------------	

//--------------------------------------------
// üũ�ڽ� ��ü����
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
		alert("���õ� �׸��� �����ϴ�.");
	}
}

	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	// ��¥ ��ȿ��üũ ('YYYYMMDD' ����)
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	
	/**
	 * ��ȿ��(�����ϴ�) ��(��)���� üũ
	 */
	function isValidMonth(mm)
	{
	    var m = parseInt(mm,10);
	    return (m >= 1 && m <= 12);
	}
	
	/**
	 * ��ȿ��(�����ϴ�) ��(��)���� üũ
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
	 * ��ȿ�� ��¥���� üũ(yyyymmdd ����)
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
		var month = (date.getMonth() + 1) + ""; // 1��=0,12��=11�̹Ƿ� 1 ����
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




		
	//���ڸ� �Է�Ȯ��
	//ex : <input type=text name=sum_objective size=5 style="ime-mode:disabled" onkeypress="onlyNumber();">
	function onlyNumber()
	{
		if(((event.keyCode<48)||(event.keyCode>57)) && event.keyCode !=13)
		{
			event.returnValue=false;
			alert("���ڸ� �Է��� �� �ֽ��ϴ�.");
		}
	}
	//key event ���ڸ� �Է�Ȯ��
	//���ڸ� �Է� ('.'����)
	function onlyNumber2()
	{
		if(((event.keyCode<48)||(event.keyCode>57)) && 
			event.keyCode !=46 && event.keyCode !=13)
		{
			event.returnValue=false;
			alert("���ڿ� �Ҽ����� �Է��� �� �ֽ��ϴ�.");
		}
	}

//�Է����� �޸��߰�
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
		if( num1.charAt(0) == "-" ){ // '-'�� ��������ǰ�..
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

	
	//���ü�� �ڵ� ����Ʈ
	var code_no = new Array();
	code_no[0] = "1:(��)�ϳ��ο���Ŭ��";
	code_no[1] = "2:(��)�ϳ����ڵ�������";
	code_no[2] = "3:(��)�ϳ��ε���";
	code_no[3] = "4:������";
	code_no[4] = "5:ī��";
	code_no[5] = "6:�帲";
	code_no[6] = "7:�ν���";
	code_no[7] = "8:�ȹ���";
	code_no[8] = "9:Ƽ��";
	code_no[9] = "10:��Ÿ";
	code_no[10] = "11:�����������";
	code_no[11] = "12:������";
	code_no[12] = "13:��Ʈ��";
	code_no[13] = "15:������ũ";
	code_no[14] = "16:����";
	code_no[15] = "17:���̸�ġ";
	code_no[16] = "18:�ɵ���(�ֿ�)";
	code_no[17] = "19:�Ϻδ븮��";
	code_no[18] = "20:�����븮��";
	code_no[19] = "21:�ν��ɾ��÷���";
	code_no[20] = "22:(��)�׸��ϳ���";
	code_no[21] = "23:������(�׸�)";
	code_no[22] = "25:(��)�ϳ����ν�Ŭ��";
	code_no[23] = "28:(��)�ϳ������ι��ν�";
	code_no[24] = "29:(��)�ϳ�������ī�ν�";
	code_no[25] = "30:(��)�ϳ��θ���ī�ν�";
	code_no[26] = "31:�̼���";
	code_no[27] = "32:����";
	code_no[28] = "33:������";
	code_no[29] = "34:����";
	code_no[30] = "35:(��)�ϳ��θ���ī�ν��ϻ�����";
	code_no[31] = "36:(��)�ϳ��θ���ī�ν���������";
	code_no[32] = "37:(��)�ϳ��θ���ī�ν�";
	code_no[33] = "38:(��)�ϳ��η���ī�ν�";
	code_no[34] = "39:������(��Ż�ν�)";
	
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
	
	//ī��� ����Ʈ
	var card_company = new Array();
	card_company[0] = "��ī��";
	card_company[1] = "����ī��";
	card_company[2] = "�Ｚī��";
	card_company[3] = "����ī��";
	card_company[4] = "��ȯī��";
	card_company[5] = "����ī��";
	card_company[6] = "�츮ī��";
	card_company[7] = "����ī��";
	card_company[8] = "����ī��";
	card_company[9] = "����ī��";
	card_company[10] = "�ϳ�ī��";
	card_company[11] = "�ѹ�ī��";
	card_company[12] = "�Ե�ī��";
	card_company[13] = "��Ÿ";
	
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
	
	//���� ����Ʈ
	var bank_company = new Array();
	bank_company[0] = "��������";
	bank_company[1] = "�������";
	bank_company[2] = "��������";
	bank_company[3] = "�츮����";
	bank_company[4] = "��������";
	bank_company[5] = "��������";
	bank_company[6] = "��ȯ����";
	bank_company[7] = "��������";
	bank_company[8] = "��������";
	bank_company[9] = "�ϳ�����";
	bank_company[10] = "�ѹ�����";
	bank_company[11] = "��ü��";
	bank_company[12] = "�泲����";
	bank_company[13] = "��������";
	bank_company[14] = "�뱸����";
	bank_company[15] = "����ġ����";
	bank_company[16] = "�λ�����";
	bank_company[17] = "�������";
	bank_company[18] = "��������";
	bank_company[19] = "��Ƽ����";
	bank_company[20] = "��������";
	bank_company[21] = "��������";
	bank_company[22] = "�������ݰ�";
	bank_company[23] = "�ſ���������";
	
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
	
	
	//�߼۹�� ����Ʈ
	var post_delivery = new Array();
	post_delivery[0] = "250,�Ϲݿ���(250��)";
	post_delivery[1] = "300,�Ϲݿ���(300��)";
	post_delivery[2] = "0,��������";
	post_delivery[3] = "0,�Ϲݵ��";
	post_delivery[4] = "0,�ù�";
	post_delivery[5] = "0,��Ÿ";
	post_delivery[6] = "0,�����������";
	
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
	
	//����å ����Ʈ
	var map_book = new Array();
	map_book[0] = "2000:2,000 ��";
	map_book[1] = "2500:2,500 ��";
	map_book[2] = "3000:3,000 ��";
	map_book[3] = "5000:5,000 ��";
	map_book[4] = "10000:10,000 ��";
	map_book[5] = "15000:15,000 ��";
	map_book[6] = "20000:20,000 ��";
	
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
	 * ��¥ ������ �ڵ����� �Է�
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
	 * ��¥ ���� �� ��ȿ�� üũ
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
	 * ��ȭ��ȣ ������ �ڵ����� �Է�
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
	 * ��ȭ��ȣ ���� üũ(02-1234-1234)
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
	 * �ֹι�ȣ/�����ȣ �ڵ����� ������ �Է�
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
					
					//�ֹι�ȣ
					if(l == 13)
					{
						str = str.substr(0,6) + "-" + str.substr(6,7);
					}
									
					//����ڹ�ȣ
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
			
			//�ֹι�ȣ
			if(l == 13)
			{
				str = str.substr(0,6) + "-" + str.substr(6,7);
			}
							
			//����ڹ�ȣ
			if(l == 10)
			{
				str = str.substr(0,3) + "-" + str.substr(3,2) + "-" + str.substr(5,5);
			}
			
			return str;		
		}
	}
	
	/**
	 * �ֹι�ȣ/����ڹ�ȣ ���� üũ
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
	 * �����ȣ ������ �ڵ����� �Է�
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
	 * �����ȣ ���� üũ
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
	 * selct �ڽ� ����
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
	 * ���ڷ� ��ȯ
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
	 * ���ڷ� ��ȯ
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
	area_code[0]="����";
	area_code[1]="�λ�";
	area_code[2]="�뱸";
	area_code[3]="��õ";
	area_code[4]="����";
	area_code[5]="����";
	area_code[6]="���";
	area_code[7]="���";
	area_code[8]="����";
	area_code[9]="���";
	area_code[10]="�泲";
	area_code[11]="����";
	area_code[12]="����";
	area_code[13]="���";
	area_code[14]="�泲";
	area_code[15]="����";


window.document.ondragstart = new Function("return false;");
//window.document.onselectstart = new Function("return false;");
//window.document.oncontextmenu = new Function("return false;");



	function get_round(retval)
	{
		retval = Math.floor(Math.round(retval)/10) * 10;
		return retval;
	}

// onload 2�� �̻� ���� ���� �Լ�
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
//���� �˾�
function alert_demo() {
	alert('���� �̿�� �����մϴ�.');
}
//���� ���� (�������ID ��������� ����, �����Ģ ���� ����)
function alert_no_right() {
	alert('������ �����ϴ�.');
}
