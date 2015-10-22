<?php

class TrackPage extends \AcceptanceTester
{
	// include url of current page
	public static $URL = '/track';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $ring = ['class' => 'icon_notifications'];
	public static $downloadFileLink = ['link' => 'Скачать файл'];
}
