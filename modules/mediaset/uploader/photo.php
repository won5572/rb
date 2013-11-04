<?php include_once $g['dir_module_skin'].'_cal.php'?>

<div id="photobox">
	
	<div class="wrap">

		<div class="bar">
			
			<div class="xl">

				<?php if($cupload):?>
				<div class="cupload">
				<form name="cform" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return upCheck(this);" />
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="m" value="<?php echo $m?>" />
				<input type="hidden" name="a" value="upload" />
				<input type="hidden" name="sess_Code" value="<?php echo $sescode?>_<?php echo $my['uid']?>_1_" />
				<input type="hidden" name="upType" value="normal" />
				<input type="hidden" name="mod" value="<?php echo $mod?>" />
				<input type="hidden" name="cupload" value="<?php echo $cupload?>" />
				<input type="file" name="Filedata" class="file" size="10" />
				<input type="submit" value="첨부" class="btngray" />
				<input type="button" value="취소" class="btngray" onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&mod=<?php echo $mod?>&album=<?php echo urlencode($album)?>');" />
				</form>
				</div>
				<?php else:?>
				<div class="dupload">
				<span class="dragstr">
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;mod=<?php echo $mod?>&amp;album=<?php echo urlencode($album)?>&amp;cupload=Y">업로드가 안될경우</a> &nbsp;|&nbsp;
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;mod=photo_link&amp;album=<?php echo urlencode($album)?>">외부사진 링크하기</a>
				</span>
				</div>
				<?php endif?>

			</div>
			<div class="xr">
				
				<span class="info">
				용량 : <span class="b"><?php echo getSizeFormat($S,0)?></span> / <?php echo str_replace('M','',ini_get('upload_max_filesize'))?>Mb
				개수 : <span class="b"><?php echo $N?>개</span> / 20개
				</span>

				<script type="text/javascript" src="<?php echo $g['s']?>/_core/lib/kimsqSwfuploader.js" charset="utf-8"></script>
				<script type="text/javascript">
				var object_Id = 'kimsqSwfuploader';
				var limitFile = '20';
				var limitSize = '<?php echo (str_replace('M','',ini_get('upload_max_filesize')) * 1024 * 1024)?>';
				var flash_Src = '<?php echo $g['s']?>/_core/lib/kimsqSwfuploaderPhoto.swf';
				var quploader = '../../index.php';
				var qupload_m = '<?php echo $m?>';
				var qupload_a = 'upload';
				var sess_Code = '<?php echo $sescode?>_<?php echo $my['uid']?>_1_';
				var save_Path = '';
				var Permision = 'true';
				var Overwrite = 'false';
				var ftypeName = '사진파일';
				var ftypeExt1 = '*.jpg *.jpeg *.gif *.png';
				var ftypeExt2 = '';
				var swbgcolor = '#F4F4F4';
				var swf_width = '82';
				var swfheight = '26';
				makeKimsqSwfuploader();
				</script>
				<a href="#." onclick="filesAlldelete('<?php echo $N?>','<?php echo $m?>');"><img src="<?php echo $g['img_module_skin']?>/btn_delete_all.gif" alt="전체삭제" /></a>
			</div>

		</div>


		<div class="body">
			<div class="viewer scrollbar01">

				
				<?php if($N):?>

				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/core.js"></script>
				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/events.js"></script>
				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/css.js"></script>
				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/coordinates.js"></script>
				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/drag.js"></script>
				<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/dragsort.js"></script>

				<script type="text/javascript">
				//<![CDATA[
				var dragsort = ToolMan.dragsort();
				function slideshowOpen()
				{
					dragsort.makeListSortable(getId("photoorder"));
				}
				window.onload = slideshowOpen;
				//]]>
				</script>

				<ul id="photoorder">
					<?php foreach($P as $val):?>
					<li>
						<input type="checkbox" name="photomembers[]" value="<?php echo $val['uid']?>|<?php echo $val['url'].$val['folder'].'/'.$val['tmpname']?>|<?php echo $val['width']?>" checked="checked" />
						<span id="finfo_name_<?php echo $val['uid']?>" class="hide"><?php echo htmlspecialchars(str_replace('.'.getExt($val['name']),'',$val['name']))?></span>
						<span id="finfo_caption_<?php echo $val['uid']?>" class="hide"><?php echo htmlspecialchars($val['caption'])?></span>
						<span id="finfo_tmpcode_<?php echo $val['uid']?>" class="hide"><?php echo $val['tmpcode']?></span>
						<div title="<?php echo $val['name']?> (<?php echo getSizeFormat($val['size'],1)?>/<?php echo $val['width']?>*<?php echo $val['height']?>px)" class="photo" style="background:url('<?php echo $val['width'] ? $val['url'].$val['category'].'/thumb2_'.$val['name'] : $val['link']?>') center center no-repeat;" onclick="captionCheck('<?php echo $val['uid']?>');"></div>
					</li>
					<?php endforeach?>
				</ul>
				<?php else:?>
				<div class="none">
				<div class="ment"><span><?php echo str_replace('M','',ini_get('upload_max_filesize'))?>Mb,20개</span>까지 올릴 수 있습니다.</div>
				</div>
				<?php endif?>
				
			</div>
		</div>
		<div class="clear"></div>

		<div id="captionDiv" class="caption">
			<form name="captionForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return captionRegis(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="a" value="caption_regis" />
			<input type="hidden" name="tmpcode" value="" />
			<input type="hidden" name="uid" value="" />
			파일명 <input type="text" name="name" value="" class="input c1" />
			캡션 <input type="text" name="caption" value="" class="input c2" />
			<input type="submit" value="등록" class="btnblue" />
			<input type="button" value="취소" class="btngray" onclick="captionClose();" />
			</form>
		</div>

		<div class="footer">
			<img src="<?php echo $g['img_module_skin']?>/btn_regis.gif" alt="등록" class="hand" onclick="insertPhoto();" />
			<img src="<?php echo $g['img_module_skin']?>/btn_cancel.gif" alt="취소" class="hand" onclick="closePhoto();" />
		</div>

		</div>

	</div>

</div>



<div id="progress">
	
	<table>
		<tr>
		<td class="td1">전체크기 : </td>
		<td class="td2"><span id="totalsize"></span></td>
		<td class="td3"></td>
		</tr>
		<tr>
		<td class="td1">파일갯수 : </td>
		<td class="td2"><span id="totalnum">0</span>개</td>
		<td class="td3"></td>
		</tr>
		<tr>
		<td class="td1">남은파일 : </td>
		<td class="td2"><span id="remainnum">0</span>개</td>
		<td class="td3"></td>
		</tr>
		<tr>
		<td class="td1">진행파일 : </td>
		<td class="td2"><span id="filename"></span></td>
		<td class="td3"></td>
		</tr>
		<tr>
		<td class="td1">전송상태 : </td>
		<td class="td2"><span class="bggrap"><span id="filegrap" class="grap"></span></span></td>
		<td class="td3">(<span id="filepers">0%</span>)</td>
		</tr>
	</table>

</div>


<script type="text/javascript">
//<![CDATA[
function captionClose()
{
	getId('captionDiv').style.visibility = 'hidden';
	pRset2();
}
function captionRegis(f)
{
	if (f.uid.value == '')
	{
		return false;
	}
	if (f.name.value == '')
	{
		alert('파일명을 입력해 주세요. ');
		f.name.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?  ');
}
function captionCheck(xuid)
{
	var f = document.captionForm;
	var xname = getId('finfo_name_'+xuid).innerHTML;
	var xcaption = getId('finfo_caption_'+xuid).innerHTML;
	var xtmpcode = getId('finfo_tmpcode_'+xuid).innerHTML;
	getId('captionDiv').style.visibility = 'visible';
	f.uid.value = xuid;
	f.name.value = xname;
	f.caption.value = xcaption;
	f.tmpcode.value = xtmpcode;
	f.caption.focus();
	pRset1();
}
function upCheck(f)
{
	<?php if(20 < $N+1 || (str_replace('M','',ini_get('upload_max_filesize'))*1024*1024) <= $S):?>
	alert('더 이상 첨부할 수 없습니다.');
	return false;
	<?php endif?>

	if (f.Filedata.value == '')
	{
		alert('사진파일을 선택해 주세요.');
		f.Filedata.focus();
		return false;
	}
	var extarr = f.Filedata.value.split('.');
	var filext = extarr[extarr.length-1].toLowerCase();
	var permxt = '[gif][jpg][jpeg][png]';
	var notext = '[html][php3][inc][cgi][pl][jsp]';

	if (notext.indexOf(filext) != -1)
	{
		alert('php,cgi,jsp 파일은 등록할 수 없습니다.    ');
		f.Filedata.focus();
		return false;
	}

	if (permxt.indexOf(filext) == -1)
	{
		alert('gif/jpg/png 파일만 등록할 수 있습니다.    ');
		f.Filedata.focus();
		return false;
	}
	return true;
}
function filesAlldelete(n,m)
{
	if (n == '0')
	{
		alert('첨부된 사진이 없습니다.    ');
		return false;
	}
	if (confirm('정말로 모두 삭제하시겠습니까?   '))
	{
		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=' + m + '&a=files_delete&dtype=photo';
	}
}
function sizeTypeSelect(n)
{
	getId('sizetype' + n).checked = true;
	if (n == 1) getId('wsize2').value = getId('wsize2').defaultValue;
}
function sizeFocus(obj)
{
	getId('sizetype2').checked = true;
	if (obj.value == obj.defaultValue) obj.value = '';
}
function sizeBlur(obj)
{
	if (obj.value == '')
	{
		sizeTypeSelect(1);
		obj.value = obj.defaultValue;
	}
	else {
		numFormat(obj);
	}
}
function insertPhoto()
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=sess_delete';
}
function closePhoto()
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=files_delete&dtype=photo&close=Y';
}
function pRset1()
{
	parent.getId('_modal_on_').style.height = (parseInt(document.body.scrollHeight)+40)+'px';
	parent.getId('_modal_iframe_').style.height = (parseInt(document.body.scrollHeight)+40)+'px';
}
function pRset2()
{
	parent.getId('_modal_on_').style.height = (parseInt(document.body.scrollHeight)-13)+'px';
	parent.getId('_modal_iframe_').style.height = (parseInt(document.body.scrollHeight)-13)+'px';
}
window.onload = function()
{
	document.body.style.overflow = 'hidden';
	pRset2();
}
//]]>
</script>



