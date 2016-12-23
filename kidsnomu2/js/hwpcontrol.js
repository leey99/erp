var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function OnStart(){

	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()) {
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
			var act = pHwpCtrl.CreateAction("InsertText");
			var set = act.CreateSet();
			set.SetItem("Text",document.HwpControl.mb_name.value );
			act.Execute(set);
		}
	}

	if(document.HwpControl.bohum.value != '') {
		pageLoad(document.HwpControl.bohum.value);
	}

}

function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
//	HwpControl.HwpCtrl.SetToolBar(3, "FileNew, FileSave, FileSaveAs, FileOpen");
	/*
	HwpControl.HwpCtrl.SetToolBar(0, "FileNew, FileSave, FileSaveAs, FileOpen, Separator, FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	*/
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	/*
	HwpControl.HwpCtrl.SetToolBar(1, "DrawObjCreatorLine, DrawObjCreatorRectangle, DrawObjCreatorEllipse,"
	+"DrawObjCreatorArc, DrawObjCreatorPolygon, DrawObjCreatorCurve, DrawObjTemplateLoad,"
	+"Separator, ShapeObjSelect, ShapeObjGroup, ShapeObjUngroup, Separator, ShapeObjBringToFront,"
	+"ShapeObjSendToBack, ShapeObjDialog, ShapeObjAttrDialog");

	HwpControl.HwpCtrl.SetToolBar(2, "StyleCombo, CharShapeLanguage, CharShapeTypeFace, CharShapeHeight,"
	+"CharShapeBold, CharShapeItalic, CharShapeUnderline, ParagraphShapeAlignJustify, ParagraphShapeAlignLeft,"
	+"ParagraphShapeAlignCenter, ParagraphShapeAlignRight, Separator, ParaShapeLineSpacing,"
	+"ParagraphShapeDecreaseLeftMargin, ParagraphShapeIncreaseLeftMargin");
	*/
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
	}
}



// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("���ʵ�(" + FirstCellName +")�� �������� �ʽ��ϴ�.");
		return false;
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
}

function pageLoad(pName){

	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' ��  '+ mm + ' ��  ' + dd + ' ��';
	//alert(mm);
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	switch(pName){
		case 'bohum1': // �ڰ����Ű�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_1.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�޴���ȭ]", true, true, false)){set.SetItem("Text",frm.comp_cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ѽ�]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ۼ���]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��ǥ����]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}

				for(i=0;i<4;i++){
				if (pHwpCtrl.MoveToField("[�������"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ֹι�ȣ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ӱ�A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ӱ�B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ӱ�C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ð���"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jogun[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum2': // �ڰݻ�ǽŰ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_2.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ѽ�]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�Ű�����]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				
				for(i=0;i<7;i++){
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_no[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ֹι�ȣ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�޴���ȭ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cel[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����C"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ش�⵵�����Ѿ�A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cnt1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���⵵�����Ѿ�"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap2[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_cnt2[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_sayu[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ش�⵵�����Ѿ�B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap1[i].value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[3��������ӱ�"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_pay[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum3': // �Ǻξ��ڰݽŰ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_3.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ȣ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�Ű�����]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������]", true, true, false)){set.SetItem("Text",frm.emp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ֹι�ȣ]", true, true, false)){set.SetItem("Text",frm.emp_jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�����ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.emp_cel.value);act.Execute(set);}
				for(i=0;i<9;i++){
					if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.relation[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[����"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_name[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[�ֹε�Ϲ�ȣ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_jumin_no[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[���/�����"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_get_loss_date[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[���/��Ǻ�ȣ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.fy_apply_txt[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum4': // �����Ѿ׽Ű�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_4.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�����������]", true, true, false)){set.SetItem("Text",frm.yoyul.value+'%');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ǥ��]", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)){set.SetItem("Text",frm.comp_addr1.value+' '+frm.comp_addr2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�������ȭ��ȣ]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������ѽ���ȣ]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)){set.SetItem("Text",frm.comp_jongmok.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�Ű�����]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				
				for(i=0;i<9;i++){
					if (pHwpCtrl.MoveToField("[�������"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_name[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[����ֹε�Ϲ�ȣ"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jumin[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[�Ի���A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[������A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[�����Ѿ�A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[��պ���A"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_avg[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[�Ի���B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_jdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[������B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_rdate[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[�����Ѿ�B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_hap[i].value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("[��պ���B"+(i+1)+"]", true, true, false)){set.SetItem("Text",frm.emp_avg[i].value);act.Execute(set);}
				}
			}
			break;
		case 'bohum5': // 4�뺸���������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bohum_5.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[�ش���]", true, true, false)){set.SetItem("Text",frm.year.value+'�� '+frm.month.value+'�� ');act.Execute(set);}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				this.setAppendRow();
			}
			break;
		default:
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
					var act = pHwpCtrl.CreateAction("InsertText");
					var set = act.CreateSet();
					set.SetItem("Text",frm.mb_name.value );
					act.Execute(set);
				}
			}
	}
	pHwpCtrl.MovePos(2);
}

function toggleLayer(id,name){
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
	}else{
		document.getElementById(id).style.display='block';
	}

	document.HwpControl.bohum.value = name;
}

function checkSubmit(name,min,max){
	var cnt=0;
	var frm = document.HwpControl;
	var item = document.getElementsByName('employee[]');
	for(i=0;i<item.length;i++){
		if(item[i].checked==true) cnt++;
	}
	if(cnt<min){ alert('�ּ� '+min+'���� ������ �����ؾ��մϴ�.'); return;}
	if(cnt>max){ alert('�ִ� '+max+'���� ������ �Է��� �� �ֽ��ϴ�.'); return;}

	document.HwpControl.bohum.value = name;
	frm.submit();
}

function goSubmit(name){

	document.HwpControl.bohum.value = name;
	document.HwpControl.submit();
}


$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='./';
	}
});