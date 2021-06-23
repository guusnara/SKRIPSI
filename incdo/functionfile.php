<?php
function formatfile($format) {
    if(($format) == 'zip' || ($format) == 'rar' || ($format) == '7z')	{
		$v = '<i class="fa fa-file-archive-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	} elseif(($format) == 'doc' || ($format) == 'docx')	{
		$v = '<i class="fa fa-file-word-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	} elseif(($format) == 'xls' || ($format) == 'xlsx')	{
		$v = '<i class="fa fa-file-excel-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	} elseif(($format) == 'pdf')	{
		$v = '<i class="fa fa-file-pdf-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	} elseif(($format) == 'jpg' || ($format) == 'jpeg'  || ($format) == 'png' || ($format) == 'gif')	{
		$v = '<i class="fa fa-file-image-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	} else	{
		$v = '<i class="fa fa-file-o fa-3x mr-2 mt-1" aria-hidden="true"></i>';
	}
	return $v;
}
?>