<?php

class DraftsPage
{
	// include url of current page
	public static $URL = '/mailings/drafts';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	//table sorted fields
	public static $sortByName = '[data-sort-by="name"]';
	public static $sortByFormat = '[data-sort-by="format"]';
	public static $sortById = '[data-sort-by="id"]';


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
