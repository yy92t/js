<?php
//�s��MySQL�ο��course_sc��Ʈw
function db_connect() {
	$connect_result = @mysql_pconnect('localhost', 'root','rootpass'); 
	if (!$connect_result)
	{
		return false;
	}
	if (!@mysql_select_db('course_sc')) 
	{
		return false;
	}
	return $connect_result;
}

//���o�ǤJ��SQL���,�x�s��}�C�æ^��
function db_result_to_array($in_result) {
    $return_array = array();
    for ($count=0; $row = mysql_fetch_array($in_result); $count++) {
        $return_array[$count] = $row;
    }
    return $return_array;
}
?>