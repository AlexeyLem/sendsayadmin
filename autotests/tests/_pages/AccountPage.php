<?php


class AccountPage extends \AcceptanceTester
{
	// include url of current page
	public static $URL = '';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $subscribersInfo = '.progress_subscribersInfo .progress__info';
	public static $lettersInfo = '.progress_lettersInfo .progress__info';
	public static $showRates = ['class' => 'button_ratesShow'];
	public static $hideRates = '.button_ratesHide';
	public static $activeRateRow = '.table_rates__activeRow';

	/**
	 * signup
	 */
	public static $fieldEmail = ".create__form [name='email']";
	public static $fieldCampaign = ".create__form [name='campaign']";
	public static $fieldName = ".create__form [name='name']";
	public static $fieldSite = ".create__form [name='site']";
	public static $fieldPhone = ".create__form [name='phone']";
	public static $signUpButton = '.js-create-free-account';

	/**
	 * pay
	 */
	public static $cardPayYandexTextEn = 'Payment by bank card';
	public static $YandexMoneyPayYandexTextEn = 'Payment';

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
