<?
include('_common.php');
if (isUserAtLeastAdmin()) {

function ChangeSpecialCharsBack($s) {

	$myStr = $s;
	$myStr = str_replace("***nl***","\n",$myStr);
	$myStr = str_replace("***am***","&",$myStr);
	$myStr = str_replace("***eq***","=",$myStr);
	$myStr = str_replace("***pl***","+",$myStr);
	$myStr = str_replace("***qu***","?",$myStr);

	return $myStr;
}

$input_id = $_GET["id"];
$input_n = $_GET["n"];
$input_b = $_GET["b"];
$input_u = $_GET["u"];

if (trim($input_n) && trim($input_b)) {




	//mysql_connect() or die ("Problem connecting to DataBase");
	db_connect();


	$query = "SELECT * FROM t_sponsor WHERE id='".db_escape_string($input_id)."';";
	//$result = mysql_db_query("strstr", $query);
	$result = db_runQuery($query);

	//if record exists - UPDATE fields - else INSERT fields
	if ($result) {
		if ($r = mysql_fetch_array($result)) {
			//UPDATE
			$query2 = sprintf("UPDATE t_sponsor SET caption='%s',brief='%s',url='%s' WHERE id='%s';",
							db_escape_string($input_n), db_escape_string($input_b), db_escape_string($input_u), db_escape_string($input_id));

			//$result2 = mysql_db_query("strstr", $query2);
			$result2 = db_runQuery($query2);
			//mysql_free_result($result2);
			db_freeResult($result2);

		} else {
			//INSERT
			$query2 = sprintf("INSERT INTO t_sponsor VALUES ('','%s','%s','%s');",
							db_escape_string($input_n), db_escape_string($input_b), db_escape_string($input_u));
			//$result2 = mysql_db_query("strstr", $query2);
			$result2 = db_runQuery($query2);
			//mysql_free_result($result2);
			db_freeResult($result2);
		}
	}

	//mysql_free_result($result); 
	db_freeResult($result);

}
}
?>