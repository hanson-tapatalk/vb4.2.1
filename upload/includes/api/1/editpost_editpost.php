<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.1 Patch Level 1 - Licence Number VBF83FEF44
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
if (!VB_API) die;

define('VB_API_LOADLANG', true);

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'attachmentoption' => $VB_API_WHITELIST_COMMON['attachmentoption'],
		'disablesmiliesoption', 'emailchecked', 'folderbits',
		'explicitchecked', 'podcastauthor', 'podcastkeywords',
		'podcastsize', 'podcastsubtitle', 'podcasturl', 'posthash',
		'posticons',
		'postinfo' => array(
			'postid', 'username', 'userid', 'postdate', 'posttime'
		),
		'postpreview', 'poststarttime', 'prefix_options',
		'selectedicon',
		'threadinfo' => $VB_API_WHITELIST_COMMON['threadinfo'],
		'title', 'htmloption',
		'messagearea' => array(
			'newpost'
		)
	),
	'show' => array(
		'subscriptionfolders', 'empty_prefix_option', 'posticons', 'deletepostoption',
		'openclose', 'stickunstick', 'closethread', 'unstickthread', 'physicaldeleteoption',
		'keepattachmentsoption', 'firstpostnote', 'parseurl', 'misc_options', 'smiliebox', 'attach'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:04, Mon May 6th 2019
|| # CVS: $RCSfile$ - $Revision: 35584 $
|| ####################################################################
\*======================================================================*/