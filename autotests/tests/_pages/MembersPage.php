<?php

class MembersPage
{
	// include url of current page
	public static $URL = '';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	/**
	 * Menu
	 */

	public static $summary = 'Сводка';
	public static $data = 'Данные';


	public static $systemAnketFirstCol = ['ID подписчика', 'Адрес подписчика', 'Количество ошибок доставки', 'Дата последней ошибки доставки', 'Текст последней ошибки доставки', 'Дата создания', 'Источник создания', 'Дата импортирования', 'Дата изменения', 'Источник изменения', 'Подписка не подтверждена', 'Подписка удалена', 'Мобильный телефон'];
	public static $systemAnketLastCol = ['строка', 'строка', 'строка', 'дата', 'строка', 'дата', 'строка', 'дата', 'дата', 'строка', 'строка', 'дата', 'строка'];

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
