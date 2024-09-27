<?php
//整理需要的資料
function prepare_data($in_form_vars) {
	if ($in_form_vars)
	{
		while(list($key,$value)=each($in_form_vars))
		{
			$edit_value[$key] = nl2br(addslashes(trim($value)));
		}
	}
	else
	{
		return false;
	}
	return $edit_value;
}
?>
