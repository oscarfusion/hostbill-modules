<?php
/*
 * Wrap needed because zendesk change the order of parameters when calling module zendesksso
 */


if ( isset($_GET['timestamp']) and isset($_GET['return_to']) ) 
{
	$query_string = 'timestamp=' . urlencode($_GET['timestamp']) . '&return_to=' . urlencode($_GET['return_to']);
	#header("Location: http://" . $_SERVER['HTTP_HOST'] . "/?cmd=module&module=zendesksso&timestamp=" . $_GET['timestamp'] . "&return_to=" . $_GET['return_to']);
	header("Location: http://" . $_SERVER['HTTP_HOST'] . "/?cmd=module&module=zendesksso&" . $query_string);
} else { 
	header("Location: http://" . $_SERVER['HTTP_HOST'] . "/?cmd=module&module=zendesksso");
}

?>
