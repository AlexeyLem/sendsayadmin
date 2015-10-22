<?php

class GroupsPage extends \AcceptanceTester
{
	// include url of current page
	public static $URL = '/subscribers';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $listCreateLink = ['class' => 'icon_addList'];
	public static $segmentCreateLink = ['class' => 'icon_addSegment'];
	public static $groupCreateButton = 'button[type="submit"]';
	public static $groupDeleteButton = ['class' => 'button_destroy'];
	public static $groupViewLink = ['link' => 'Просмотр группы'];

	public static $defaultSegmentName = 'Доступные для рассылки';
	public static $defaultListId = 'p294';
	public static $defaultMember = 'sendsaytester@gmail.com';
	public static $defaultIssueId = '3556';
	public static $defaultUrl = 'https://google.com';

	public static $memersAdd = ['class' => 'icon_addSubs'];
	public static $addMembersField = ['name' => 'list'];

	public static $editSeg = ['class' => 'icon_edit'];

	//table sorted fields
	public static $sortByName = '.table thead th:nth-child(1)';
	public static $sortByType = '.table thead th:nth-child(2)';
	public static $sortByAddrType = '.table thead th:nth-child(3)';
	public static $sortById = '.table thead th:nth-child(4)';

	//menu ib group

	public static $groupMemberList = "//*[contains(text(), 'Список подписчиков')]";
	public static $groupStat = "//*[contains(text(), 'Сводка')]";

	/**
	 * Basic route example for your current URL
	 * You can append any additional parameter to URL
	 * and use it in tests like: EditPage::route('/123-post');
	 */
	public static function route($param)
	{
		return static::$URL . $param;
	}


}
