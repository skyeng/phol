<?
function _mysql(){
	$args = func_get_args();
	$conn = null;
	if(is_resource($args[0]))
		$conn = array_shift($args);
	$tmpl =& $args[0];
	$tmpl = str_replace("%", "%%", $tmpl);
	$tmpl = str_replace("?", "%s", $tmpl);
	foreach ($args as $i=>$v) {
		if (!$i) continue;
		if (is_int($v)) continue;
		$args[$i] = "'".mysql_escape_string($v)."'";
	}
	$query = call_user_func_array("sprintf", $args);
	return $conn!==null?mysql_query($query, $conn):mysql_query($query);
}
?>