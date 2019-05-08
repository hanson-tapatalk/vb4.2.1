<?php

/* ======================================================================*\
  || #################################################################### ||
  || # vBulletin 4.2.1 Patch Level 1 - Licence Number VBF83FEF44
  || # ---------------------------------------------------------------- # ||
  || # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
  || # This file may not be redistributed in whole or significant part. # ||
  || # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
  || # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
  || #################################################################### ||
  \*====================================================================== */

/**
 * Class to populate the activity stream from existing content
 *
 * @package	vBulletin
 * @version	$Revision: 57655 $
 * @date		$Date: 2012-01-09 12:08:39 -0800 (Mon, 09 Jan 2012) $
 */
class vB_ActivityStream_Populate_Forum_Visitormessage extends vB_ActivityStream_Populate_Base
{
	/**
	 * Constructor - set Options
	 *
	 */
	public function __construct()
	{
		return parent::__construct();
	}

	/*
	 * Don't get: Deleted threads, redirect threads, CMS comment threads
	 *
	 */
	public function populate()
	{
		$typeid = vB::$vbulletin->activitystream['forum_visitormessage']['typeid'];
		$this->delete($typeid);

		if (!vB::$vbulletin->activitystream['forum_visitormessage']['enabled'])
		{
			return;
		}

		$timespan = TIMENOW - vB::$vbulletin->options['as_expire'] * 60 * 60 * 24;
		vB::$db->query_write("
			INSERT INTO " . TABLE_PREFIX . "activitystream
				(userid, dateline, contentid, typeid, action)
				(SELECT
					postuserid, dateline, vmid, '{$typeid}', 'create'
				FROM " . TABLE_PREFIX . "visitormessage
				WHERE
					dateline >= {$timespan}
				)
		");
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 05:04, Mon May 6th 2019
|| # CVS: $RCSfile$ - $Revision: 57655 $
|| ####################################################################
\*======================================================================*/