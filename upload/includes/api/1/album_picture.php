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

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'albuminfo' => array(
			'albumid', 'title', 'description'
		),
		'picturecomment_commentarea' => array(
			'messagestats',
			'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
			'picturecommentbits' => array(
				'*' => array(
					'message' => array(
						'commentid', 'userid', 'username', 'avatarurl',
						'date', 'time', 'message'
					),
					'show' => array(
						'edit', 'inlinemod', 'delete', 'undelete', 'approve',
						'pagenav', ''
					)
				)
			)
		),
		'pictureinfo' => array(
			'attachmentid', 'albumid', 'groupid', 'dateline', 'caption_censored',
			'pictureurl', 'caption_html', 'adddate', 'addtime'
		),
		'pic_location',
		'userinfo' => array(
			'userid', 'username'
		)
	),
	'show' => array(
		'picture_owner', 'edit_picture_option', 'add_group_link', 'reportlink',
		'picture_nav', 'moderation', 'picturecomment_options'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:04, Mon May 6th 2019
|| # CVS: $RCSfile$ - $Revision: 35584 $
|| ####################################################################
\*======================================================================*/