<?php
require('course_sc_fns.php');

$get_courseid = $_GET['courseid'];
$get_catid = $_GET['catid'];

check_enrolprocess();

$get_cat_list = get_categories();
$get_course_detail = get_course_detail($get_courseid,$get_catid);
@ extract($get_course_detail,EXTR_PREFIX_ALL,'chkout');
?>
