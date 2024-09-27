<?php
require ('course_sc_fns.php');

$return_code = $_GET['successcode'];
$ref_num = $_GET['Ref'];

echo 'OK';

if ($return_code == 0) {
	$code=insert_enrolment($ref_num));
	if(!is_bool($code)) mail('andylam@systematic.com.hk','Error Code',$code);
	if(!is_bool($code=remove_enrolprocess($ref_num))) mail('andylam@systematic.com.hk','Error Code',$code);
	confirm_mail($ref_num);
} 
else 
{
	remove_enrolprocess($ref_num);
}
?>