<?
//PHP URL ÀÚµ¿ ¸µÅ© ´Þ±â : »õÃ¢¿­±â $popup=true / $popup=false
function url_auto_link($str='', $popup=true) {
	if (empty($str)) {
		return false;
	}
	$target = $popup ? 'target="_blank"' : '';
	$str = str_replace(
		array("&lt;", "&gt;", "&amp;", "&quot;", "&nbsp;", "&#039;"),
		array("\t_lt_\t", "\t_gt_\t", "&", "\"", "\t_nbsp_\t", "'"),
		$str
	);
	$str = preg_replace(
		"/([^(href=\"?'?)|(src=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[°¡-ÆR\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i",
		"\\1<a href=\"\\2\" {$target}>\\2</A>",
		$str
	);
	$str = preg_replace(
		"/(^|[\"'\s(])(www\.[^\"'\s()]+)/i",
		"\\1<a href=\"http://\\2\" {$target}>\\2</A>",
		$str
	);
	$str = preg_replace(
		"/[0-9a-z_-]+@[a-z0-9._-]{4,}/i",
		"<a href=\"mailto:\\0\">\\0</a>",
		$str
	);
	$str = str_replace(
		array("\t_nbsp_\t", "\t_lt_\t", "\t_gt_\t", "'"),
		array("&nbsp;", "&lt;", "&gt;", "&#039;"),
		$str
	);
	return $str;
}
?>