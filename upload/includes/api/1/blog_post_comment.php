<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.1 Patch Level 1 - Licence Number VBF83FEF44
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
if (!VB_API) die;

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'content' => array(
			'attachmentoption' => $VB_API_WHITELIST_COMMON['attachmentoption'],
			'disablesmiliesoption',
			'bloginfo' => $VB_API_WHITELIST_COMMON['bloginfo'],
			'blogtextinfo' => array('blogtextid'),
			'messagearea' => array(
				'newpost'
			),
			'notification', 'posthash', 'postpreview','reason',
			'title',
			'human_verify' => $VB_API_WHITELIST_COMMON['humanverify']
		)
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:04, Mon May 6th 2019
|| # CVS: $RCSfile$ - $Revision: 35584 $
|| ####################################################################
\*======================================================================*/