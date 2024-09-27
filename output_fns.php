<?php
//顯示課程種類
function display_categories($out_cat_array) {
	if ($out_cat_array) 
	{
		echo '<br />';
		echo '<p><div align="center"><strong>Course Categories :</strong></div></p>';	
		echo '<ul>';
		$cat_num = count($out_cat_array);
		for ($i=0; $i<$cat_num; $i++)
		{
    		$url = 'show_cat.php?catid='.($out_cat_array[$i]['cat_id']);
	    	$title = $out_cat_array[$i]['cat_name']; 
    		echo '<li>';
			echo "<a href='$url'>$title</a>";
			echo '<p>';
		}
		echo '</ul>';
		echo '<hr />';
	}
	else
	{
		echo 'There is no categories available.<br />';
	}
}

//顯示可選擇的課程
function display_courses($out_course_array) {
	if ($out_course_array) 
	{
		echo '<table width="567" border="0">';
		$course_num = count($out_course_array);
		for ($i=0; $i<$course_num; $i++)
		{
			$url = 'show_course.php?catid='.$out_course_array[$i]['cat_id'].'&courseid='.(substr($out_course_array[$i]['course_id'],-2));
      		echo '<tr><td width="50">&nbsp;</td><td>';
			$course_name =  $out_course_array[$i]['course_name'];
			echo "<a href='$url'>$course_name</a>";
?>
			</td></tr>
			<tr><td height="50">&nbsp;</td>
			    <td>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </td>
			</tr>
<?php
    	}
		echo '</table>';
  	}
	else
	{
		echo '<br><h3>There is no course available.</h3><br>';
	} 
}

//顯示課程內容
function display_course_details($out_course) {
	if ($out_course)
	{
	?>
		<table width=567 border=0>
			<tr>
				<td align="left"><br>
					<b>&#149; Course Name: </b><?php echo $out_course['course_name']; ?> <br>
					<b>&#149; Course Price: </b>$<?php echo number_format($out_course['course_price'],2); ?> <br>
					<b>&#149; Description: </b><p><?php echo $out_course['course_content']; ?> </p>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
	<?php
	} 
	else 
	{
		echo 'The details of this course cannot be displayed at this time.';
	}
	echo '<br><hr>';
}

//顯示仍有空位的課程
function display_available_course($out_available_course) {
	echo '<table width="193" border="0">';
	if ($out_available_course) 
	{
		$num_course = count($out_available_course);
		for ($i=0;$i<$num_course;$i++)
		{
			$url = 'checkout.php?catid='.$out_available_course[$i]['cat_id'].'&courseid='.$out_available_course[$i]['course_id'];
			?>
			<tr>
				<td><br><b>Course ID :</b></td>
				<td><br><?php echo $out_available_course[$i]['course_id']; ?></td>
			</tr>
			<tr>
				<td><b>Date :</b></td>
				<td><?php echo $out_available_course[$i]['course_date']; ?></td>
			</tr>
			<tr>
				<td><b>Time :</b></td>
				<td><?php echo $out_available_course[$i]['course_start'].'~'.$out_available_course[$i]['course_end']; ?></td>
			</tr>
			<tr>
				<td><b>Price :</b></td>
				<td><?php echo $out_available_course[$i]['course_price']; ?></td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2><?php echo "<a href='$url'>Enrol Now</a>"; ?></td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2>- - - - - - - - - - - - - - -</td>
			</tr>

			<?php
		}
		echo '</table>';
	}
	else
	{
	?>
			<tr>
				<td>&nbsp;</td>
			</tr>
	<?php
	}
	echo '</table>';
}
?>
