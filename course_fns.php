<?php
//列出所有課程類別,並以陣列回傳
function get_categories() {
    $db_link = db_connect();
    $query = 'select * from categories';
    $query_result = mysql_query($query);
    if (!$query_result) 
	{
        return false;
    }
	$num_cats = mysql_num_rows($query_result);
	if ($num_cats ==0) 
	{
        return false;
    }
	
    $return_result = db_result_to_array($query_result);
    return $return_result; 
}

//根據輸入的課程類別,顯示類別中所有課程
function get_courses($in_catid) {
    if (!$in_catid || $in_catid=='') 
	{
        return false;
    }
	$db_link = db_connect();
    $query = "select course_id,course_name,cat_id from courses where cat_id='$in_catid' group by course_name";
    $query_result = mysql_query($query);
    if (!$query_result) 
	{
        return false;
    }
    $num_course = mysql_num_rows($query_result);
    if ($num_course ==0) 
	{
        return false;
    }
	$return_result = db_result_to_array($query_result);
    return $return_result;
}

//根據輸入的課程編號,搜尋課程詳細內容
function get_course_detail($in_courseid,$in_catid) {
	if (!$in_courseid || $in_courseid=='' || !$in_catid || $in_catid=='')  
	{
		return false;
	}
	$db_link = db_connect();
	$query = "select * from courses where course_id like '%$in_courseid' and cat_id = $in_catid group by course_id";
	$query_result = mysql_query($query);
	if (!$query_result) 
	{
		return false;
	}
	$return_result = mysql_fetch_array($query_result);
	return $return_result;
}

//根據輸入的課程編號, 搜尋有空位的課程
function get_available_courses($in_courseid,$in_catid) {
	if (!$in_courseid || $in_courseid=='' || !$in_catid || $in_catid =='')
	{
		return false;
	}
	$db_link = db_connect();
	$query = "select * from courses where course_id like '%$in_courseid' and cat_id=$in_catid and course_remain > 0";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}
	$return_result = db_result_to_array($query_result);
	return $return_result;
}
?>