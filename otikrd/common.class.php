<?php

function msg($msg_message='รายละเอียด', $msg_type = 'danger')
{
	$tMsg = '
			<div class="alert alert-block alert-'.$msg_type.' fade in" id="success-msg">
				<button data-dismiss="alert" class="close" type="button">
				  ×
				</button>
				<p>
				  <i class="fa fa-times-circle fa-lg"></i> '.$msg_message.'
				</p>
			</div>	
	';
	return $tMsg;
}

?>