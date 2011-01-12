<?php

function print_r_html ($arr) {
        ?><pre><?
        print_r($arr);
        ?></pre><?
}

try {
	#$defined_vars = get_defined_vars();
	if ( isset($auth) and is_object($auth) ) {
		#print_r_html($defined_vars);
		$sTimestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : time();
		if ( isset($module->template->_tpl_vars['login']['id']) ) {
			$zuserid = $module->template->_tpl_vars['login']['id'];
			$zendeskurl = $module->userInfo($zuserid, $sTimestamp);
			if ( $zendeskurl != '' and substr($zendeskurl, 0, 4) != 'ERR-') {
					header('Location: ' . $zendeskurl);
					#$module->template->assign('zurl',$zendeskurl);
			} else {
				# Model generated the error message using errorMsg
				$module->template->assign('errmsg',substr($zendeskurl, 4));
			}
		} else {
			$module->template->assign('errmsg1',true);
			#$module->errorMsg("Impossible to get your user ID");
		}

	} else {
		$module->template->assign('errmsg2',true);
		#$module->errorMsg("You are not authorized to access help desk");
	}
} catch (Exception $e) {
	$module->template->assign('errmsg3',"System Error: " . $e->getMessage());
	#$module->errorMsg("System Error: " . $e->getMessage());
}

?>
