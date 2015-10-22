<?php

class LoginPage
{
	// include url of current page
	public static $URL = '/login';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $loginInput = '[name="login"]';
	public static $passwordInput = '[name="password"]';
	public static $submitButton = '.form_login [type="submit"]';
	public static $registerLink = ['link' => 'Зарегистрируйтесь'];

	public static $loginError = '.form__errorMessage[for="login"]';
	public static $passwordError = '.form__errorMessage[for="password"]';

	public static $showPass = 'span.inputText__showPassLink';
	public static $hidePass = 'span.inputText__hidePassLink';


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
