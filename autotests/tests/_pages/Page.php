<?php

class Page
{
	// include url of current page
	public static $URL = '/';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $pageLoaded = 'body.loaded';
	public static $tableLoaded = 'table.table_loaded';
	public static $contentTitle = '.header__section_title';
	public static $tableCaption = '.table__caption';
	public static $accontTitle = '.content__title';
	public static $breadcrumb = '.breadcrumb';
	public static $table = '.table';
	public static $actionButton = '.actionButton';
	public static $buttonCreateDirectory = '.button_createDirectory';

	public static $testSendsayAccountUrl = 'https://test.sendsay.ru/account';
	public static $testSendsayUrl = 'https://test.sendsay.ru';

	public static $signUp = ['link' => 'Зарегистрироваться'];
	public static $logIn = ['link' => 'Войти'];
	public static $modal = ['css' => '.modal'];
	public static $modalConfirm = '.modal__confirm';
	public static $modalCancel = '.modal__cancel';

	public static $visualEmpty = '  ';

	public static $individualLimit = 100000;

	/**
	 * Pagination buttons
	 */

	public static $paginationNext = ['class' => 'button_next'];
	public static $paginationPrev = ['class' => 'button_prev'];

	/**
	 * Notification
	 */
	public static $notificationButton = ['css' => '.notification__action a'];

	public static $notificationText = '.notification__text';

	public static $meatball = ['class' => 'icon_moreHoriz'];

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
