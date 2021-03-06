<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Functions
 *
 */

function checkFcgidPhpFpm($fieldname, $fielddata, $newfieldvalue, $allnewfieldvalues) {

	$returnvalue = array(FORMFIELDS_PLAUSIBILITY_CHECK_OK);

	// check whether fcgid should be enabled but php-fpm is
	if($fieldname == 'system_mod_fcgid_enabled'
		&& (int)$newfieldvalue == 1
		&& (int)Settings::Get('phpfpm.enabled') == 1
	) {
		$returnvalue = array(FORMFIELDS_PLAUSIBILITY_CHECK_ERROR, 'phpfpmstillenabled');
	}
	// check whether php-fpm should be enabled but fcgid is
	elseif($fieldname == 'system_phpfpm_enabled'
		&& (int)$newfieldvalue == 1
		&& (int)Settings::Get('system.mod_fcgid') == 1
	) {
		$returnvalue = array(FORMFIELDS_PLAUSIBILITY_CHECK_ERROR, 'fcgidstillenabled');
	}

	return $returnvalue;
}
