var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;
var _DEBUG = true; // Debug mode.
var pHwpCtrl;
//custom Toolbar ���� �⺻ �׼ǿ��� ���θ����, ����, �ٸ��̸����� ����, ����, �� ���µ� ��ü �׼��� ���� ���
//html�� onstart()�� ������ ���� �ְ� ����ϸ� �ȴ�. ��ܿ� �Լ��� onstart�ִ�.
function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
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
function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // ���̺� ���� Ŀ���� �ִ°�?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
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
// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}
function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}
function TableColumnContents2(ColumnArray){
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
function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}
function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;
	if(!_VerifyVersion()){
		location.href='<?=$PHP_SELF?>';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.
	InitToolBarJS();
	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();
	var pay_count = frm.pay_count.value;
	if(pay_count > 13 && pay_count <39) pay_table = 'total_pay_health_2page.hwp';
	else if(pay_count > 38) pay_table = 'total_pay_healt_3page.hwp';
	else pay_table = 'total_pay_health.hwp';
	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("������", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("������2", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����������ȣ", true, true, false)){set.SetItem("Text",frm.t_no.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��ȭ��ȣ", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ѽ���ȣ", true, true, false)){set.SetItem("Text",frm.fax.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.ceo.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ó�¥", true, true, false)){set.SetItem("Text",frm.today.value);act.Execute(set);}

		if(pay_count > 13 && pay_count < 38) tr_count = '37';
		else if(pay_count > 37 && pay_count < 46) tr_count = 46;
		else tr_count = 13;
		for(i=0;i<=tr_count;i++){
			if (pHwpCtrl.MoveToField("no"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹε�Ϲ�ȣ"+i, true, true, false)){set.SetItem("Text",frm.ssnb[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.sdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.ypay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ٹ�"+i, true, true, false)){set.SetItem("Text",frm.month[i].value);act.Execute(set);}
		}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent=='ie' || myagent=='ns') {
		OnStart();
	} 
else {
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='index.php';
	}		
});