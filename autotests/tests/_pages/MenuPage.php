<?php

class MenuPage
{
	// include url of current page
	public static $URL = '';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	//Основное меню
	public static $divPrimary = ['class' => 'navigation_type_primary'];
	public static $divSecondary = ['class' => 'navigation_type_secondary'];

	public static $review = ['link' => 'Обзор'];
	public static $subscribers = ['link' => 'Подписчики'];
	public static $mailings = ['link' => 'Рассылки'];
//	public static $campaigns = ['link' => 'Кампании'];
//	public static $ankets = ['link' => 'Анкеты'];
	public static $statistics = ['link' => 'Статистика'];
//	public static $convesions = ['link' => 'Конверсии'];
//	public static $system = ['link' => 'Система'];
	public static $account = '.dropdown_account .dropdown__toggle';
	public static $logout = ['link' => 'Выйти'];

	//Дополнительное меню
	public static $mailingsManage = ['link' => 'Управление рассылками'];
	public static $subscribersGroups = ['link' => 'Группы'];
	public static $stopList = ['link' => 'Стоп-лист'];
	public static $accountRates = ['link' => 'Тарифы'];
	public static $accountPay = ['link' => 'Оплата'];
	public static $mailingsFiles = ['link' => 'Файлы'];

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
