<?php

class StopListPage
{
	// include url of current page
	public static $URL = '/subscribers/stoplist';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	//table sorted fields
	public static $addToStopList = '.add-to-stoplist';
	public static $deleteFromStopList = '.button_delete-from-stoplist';

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
