<?php
//發出確認郵件
function confirm_mail($in_enrolid) {
	$db_link = db_connect();
	//搜尋已報讀的學生ID
	$query = "select student_id from enrolstudents where enrol_id=$in_enrolid";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)==0)
	{
		return false;
	}
	list($studentid) = mysql_fetch_array($query_result);
	$query = "select course_id from enrolcourses where enrol_id=$in_enrolid";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)==0)
	{
		return false;
	}
	list($courseid) = mysql_fetch_array($query_result);
	//搜尋己報讀的學生電郵
	$query = "select eng_name,email from students where student_id=$studentid";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)==0)
	{
		return false;
	}
	list($studentname,$confirm_to) = mysql_fetch_array($query_result);
	$confirm_from = 'enrolment@computer_science.edu.hk';
	$confirm_subject = 'Your enrollment complete';
	$confirm_message = "Dear $studentname,\n\n Thank you for your enrollment. This is your enrollment code: $enrolid.\n\n";
	$confirm_message .= 'If you have any queries, please feel free to contact us at info@computer_science.edu.hk';
	$confirm_headers = "From: $confirm_from";
	mail($confirm_to,$confirm_subject,$confirm_message,$confirm_headers);
	
	$notify_to = '';
	$notify_from = 'enrolment@computer_science.edu.hk';
	$notify_subject = 'New enrolment.';
	$notify_message = "Student $studentname enrol the course $courseid. \n The enrollment number is $enrolid.";
	$notify_headers = "From: $notify_from";
	mail($notify_to,$notify_subject,$notify_message,$notify_headers);
}

//新增Process Item
function insert_enrolprocess($in_process_info) {
	$clear_data = prepare_data($in_process_info);
	$db_link = db_connect();
	
	// 搜尋是否已有此學生資料,如沒有此學生之資, 便加入新的資料, 否則更新資料
	$query = "select student_id from students where id_num = '".$clear_data['idnum']."'";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)>0)
	{
		$student_id = mysql_result($query_result, 0, 'student_id');
		$query = "update students set eng_name = '".$clear_data['engname'].
									"', tel1 = '".$clear_data['phone1'].
									"', tel2 = '".$clear_data['phone2'].
									"', tel3 = '".$clear_data['phone3'].
									"', email = '".$clear_data['email'].
									"', address = '".$clear_data['address'].
									"' where student_id = $student_id";
									
		$query_result = mysql_query($query);
		if (!$query_result)
		{
			return false;
		}		
	}
	else
	{
		$query = "insert into students values ('', '".$clear_data['engname'].
										"','".$clear_data['gender'].
										"','".$clear_data['idnum'].
										"','".$clear_data['phone1'].
										"','".$clear_data['phone2'].
										"','".$clear_data['phone3'].
										"','".$clear_data['email'].
										"','".$clear_data['address'].
										"')";
					
		$query_result = mysql_query($query);
		if (!$query_result)
		{
			return false;
		}
	}
	
	//搜尋已登記的學生號碼
	$query = "select student_id from students where id_num = '".$clear_data['idnum']."'";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)>0)
	{
		$student_id = mysql_result($query_result, 0, 'student_id');
	}
	else
	{
		return false;
	}
	
	//尋找課程價錢
	$course_id = $clear_data['courseid'];
	$query = "select course_price from courses where course_id = '$course_id'";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result))
	{
		$course_price = mysql_result($query_result,0);
	}
	else
	{
		return false;
	}

	//根據輸入的課程編號, 計算有多少人同時選擇此課程
	$query = "select count(course_id) as num_enrol, course_id from tempcourses where course_id = '$course_id' group by course_id";
	$query_result = mysql_query($query);
	if (!$query_result) 
	{
		return false;
	}
	
	//根據輸入的課程編號, 尋找是否有足夠住置
	$getdata = mysql_fetch_array($query_result);
	$query = "select course_id from courses where course_remain > ".$getdata['num_enrol']." and course_id = '$course_id'";
	$query_result = mysql_query($query);
	if ($query_result)
	{
		echo '<p><h3>This course does not available at this stage</h3></p>';
		return false;
	} 
	
	//加入預訂的學生資料
	$enrolcode = $clear_data['enrolcode'];
	$enroltime = time()+900;
	$query = "insert into tempstudents values ('','$student_id','$enrolcode','$enroltime')";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}
	
	//搜尋已加入的ref_no
	$query = "select ref_no from tempstudents where enrol_code = '$enrolcode'";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}
	$enrolid = mysql_result($query_result,0,'ref_no');
	
	//加入預訂的課程資料
	$query = "insert into tempcourses values ('$enrolid','$course_id','1','$course_price','$enroltime')";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}

	return $enrolid;
}

//從temp資料表中移除處理中的資料
function remove_enrolprocess($in_ref_no) {
	$db_link = db_connect();
	$query = "delete from tempstudents where ref_no = $in_ref_no limit 1";
	if (!mysql_query($query)) 
	{
		return 166;
	}
	$query = "delete from tempcourses where ref_no = $in_ref_no";
	if (!mysql_query($query))
	{
		return 171;
	}
	return true;
}

//刪除已過時的temp資料
function check_enrolprocess() {
	$db_link = db_connect();
	$checktime = time();
	$query = "delete from tempstudents where enrol_time <= $checktime";
	mysql_query($query);
	$query = "delete from tempcourses where enrol_time <= $checktime";
	mysql_query($query);	
}

//加入報名資料
function insert_enrolment($in_enrol_num) {
	$db_link = db_connect();

	//搜尋曾在tempstudents資料表登記的資料
	$query = "select ref_no,student_id from tempstudents where ref_no = $in_enrol_num";
	$query_result = mysql_query($query);
	
	if(mysql_num_rows($query_result)>0)
	{
		list($refnum,$studentid) = mysql_fetch_array($query_result);
	}
	else
	{
		return 193;
	}
	
	//加入新報名到tempstudents資料表
	$query = "insert into enrolstudents values ('$refnum','$studentid',CURDATE())";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return 201;
	}
	
	//搜尋曾在tempcourses資料表登記的資料
	$query = "select * from tempcourses where ref_no = $in_enrol_num";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)>0)
	{
		$order_array = db_result_to_array($query_result);
	}
	
	$num_order = count($order_array);
	for ($i=0; $i<$num_order; $i++)
	{
		$enrol_no = $order_array[$i]['ref_no'];
		$enrol_course_id = $order_array[$i]['course_id'];
		$enrol_quantity = $order_array[$i]['quantity'];
		$enrol_amount = $order_array[$i]['amount'];
		$query = "insert into enrolcourses values ('$enrol_no','$enrol_course_id','$enrol_quantity','$enrol_amount')";
		$query_result = mysql_query($query);
		if(!$query_result)
		{
			return 223;
		}
	
		//更新courses資料內的課程數量
		$query = "update courses set course_remain=course_remain-1 where course_id='$enrol_course_id'";
		$result = mysql_query($query);
		if(!$result)
		{
			return 231;
		}
	}
	return true;
}
?>

