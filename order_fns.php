<?php
//�o�X�T�{�l��
function confirm_mail($in_enrolid) {
	$db_link = db_connect();
	//�j�M�w��Ū���ǥ�ID
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
	//�j�M�v��Ū���ǥ͹q�l
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

//�s�WProcess Item
function insert_enrolprocess($in_process_info) {
	$clear_data = prepare_data($in_process_info);
	$db_link = db_connect();
	
	// �j�M�O�_�w�����ǥ͸��,�p�S�����ǥͤ���, �K�[�J�s�����, �_�h��s���
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
	
	//�j�M�w�n�O���ǥ͸��X
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
	
	//�M��ҵ{����
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

	//�ھڿ�J���ҵ{�s��, �p�⦳�h�֤H�P�ɿ�ܦ��ҵ{
	$query = "select count(course_id) as num_enrol, course_id from tempcourses where course_id = '$course_id' group by course_id";
	$query_result = mysql_query($query);
	if (!$query_result) 
	{
		return false;
	}
	
	//�ھڿ�J���ҵ{�s��, �M��O�_��������m
	$getdata = mysql_fetch_array($query_result);
	$query = "select course_id from courses where course_remain > ".$getdata['num_enrol']." and course_id = '$course_id'";
	$query_result = mysql_query($query);
	if ($query_result)
	{
		echo '<p><h3>This course does not available at this stage</h3></p>';
		return false;
	} 
	
	//�[�J�w�q���ǥ͸��
	$enrolcode = $clear_data['enrolcode'];
	$enroltime = time()+900;
	$query = "insert into tempstudents values ('','$student_id','$enrolcode','$enroltime')";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}
	
	//�j�M�w�[�J��ref_no
	$query = "select ref_no from tempstudents where enrol_code = '$enrolcode'";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}
	$enrolid = mysql_result($query_result,0,'ref_no');
	
	//�[�J�w�q���ҵ{���
	$query = "insert into tempcourses values ('$enrolid','$course_id','1','$course_price','$enroltime')";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return false;
	}

	return $enrolid;
}

//�qtemp��ƪ������B�z�������
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

//�R���w�L�ɪ�temp���
function check_enrolprocess() {
	$db_link = db_connect();
	$checktime = time();
	$query = "delete from tempstudents where enrol_time <= $checktime";
	mysql_query($query);
	$query = "delete from tempcourses where enrol_time <= $checktime";
	mysql_query($query);	
}

//�[�J���W���
function insert_enrolment($in_enrol_num) {
	$db_link = db_connect();

	//�j�M���btempstudents��ƪ�n�O�����
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
	
	//�[�J�s���W��tempstudents��ƪ�
	$query = "insert into enrolstudents values ('$refnum','$studentid',CURDATE())";
	$query_result = mysql_query($query);
	if(!$query_result)
	{
		return 201;
	}
	
	//�j�M���btempcourses��ƪ�n�O�����
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
	
		//��scourses��Ƥ����ҵ{�ƶq
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

