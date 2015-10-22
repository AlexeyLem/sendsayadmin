<?php

class StatisticsPage
{
	// include url of current page
	public static $URL = '/statistics';

	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	public static $fullStatId = '3556';
	public static $emptyStatId = '1';

	public static $highchartsContainer = ['class' => 'highcharts-container'];
	public static $clickMapContainer = ['class' => 'clickmap'];

	public static $fullStatIssueName = 'Разбираем остатки по смешным ценам!';
	/**
	 * Date Picker
	 */
	public static $dateRangePicker = 'div.dateRangePicker.dateRangePicker_period div div.dropdown__toggle';
	public static $dateApply = ['class' => 'applyBtn'];
	public static $dateCancel = ['class' => 'cancelBtn'];
	public static $dateFrom = 'div.dateRangePicker__from';
	public static $dateTo = 'div.dateRangePicker__to';

	/**Left*/
	public static $datePrevLeft = 'div.calendar.left th.prev.available';
	public static $dateNextLeft = 'div.calendar.left th.next.available';
	public static $titleMonthLeft = 'div.calendar.left th.month';

	/**Right*/
	public static $datePrevRight = 'div.calendar.right th.prev.available';
	public static $dateNextRight = 'div.calendar.right th.next.available';
	public static $titleMonthRight = 'div.calendar.right th.month';

	/**Radiobuttons*/
	public static $rangeAllTime = 'div.radioGroup.clearfix div:nth-child(5) label span';
	public static $rangeForMonth = 'div.radioGroup.clearfix div:nth-child(4) label span';
	public static $rangeForWeek = 'div.radioGroup.clearfix div:nth-child(3) label span';
	public static $rangeYesterday = 'div.radioGroup.clearfix div:nth-child(2) label span';
	public static $rangeToday = 'div.radioGroup.clearfix div:nth-child(1) label span';

	/**
	 * Export
	 */
	public static $exportXLSX = ['class' => 'table__exportAsXLSX'];
	public static $exportCSV = ['class' => 'table__exportAsCSV'];

	public static $texstExportToXLSX = 'Данные экспортируются в XLSX-файл';
	public static $texstExportToCSV = 'Данные экспортируются в CSV-файл';

	/**
	 * Statistics Menu
	 */
	public static $commonStat = ['link' => 'Сводка'];
	//Доставка
	public static $deliveryStat = ['link' => 'Доставка'];
	public static $deliveryDomainsStat = ['link' => 'По доменам'];
	public static $deliverySubscribersStat = ['link' => 'По подписчикам'];
	public static $deliveryErrorsStat = ['link' => 'Ошибки доставки'];
	//Открытия
	public static $openStat = ['link' => 'Открытия'];
	public static $openPeriodStat = ['link' => 'За период'];
	public static $openHoursStat = ['link' => 'По часам'];
	public static $openSubscribersStat = ['link' => 'По подписчикам'];
	//Переходы
	public static $clickStat = ['link' => 'Переходы'];
	public static $clickPeriodStat = ['link' => 'За период'];
	public static $clickLinksStat = ['link' => 'По ссылкам'];
	public static $clickSubscribersStat = ['link' => 'По подписчикам'];
	//Карта кликов
	public static $clickMap = ['link' => 'Карта кликов'];
	//Отписки
	public static $unsubStat = ['link' => 'Отписки'];
	//Технологии
	public static $technologyStat = ['link' => 'Технологии'];
	public static $technologyTypeStat = ['link' => 'Устройства'];
	public static $technologyOSStat = ['link' => 'Операционные системы'];
	//Название таблицы
	public static $title = ['class' => 'table__caption'];

	/**
	 * Таблица "Статистика по выпускам"
	 * Описаны первые 2 строки с данными
	 */
	public static $statName = 'table tbody tr:nth-child(1) td:nth-child(1) div.table_issues__primaryData a strong';
	public static $statName1 = 'table tbody tr:nth-child(2) td:nth-child(1) div.table_issues__primaryData a strong';

	public static $statGroupName = 'table tbody tr:nth-child(1) td:nth-child(1) div:nth-child(2) span:nth-child(1)';
	public static $statGroupName1 = 'table tbody tr:nth-child(2) td:nth-child(1) div:nth-child(2) span:nth-child(1)';

	public static $statDt = 'table tbody tr:nth-child(1) td:nth-child(1) div:nth-child(2) span:nth-child(2)';
	public static $statDt1 = 'table tbody tr:nth-child(2) td:nth-child(1) div:nth-child(2) span:nth-child(2)';

	public static $statMembers = 'table tbody tr:nth-child(1) td:nth-child(2) div.table_issues__primaryData strong';
	public static $statMembers1 = 'table tbody tr:nth-child(2) td:nth-child(2) div.table_issues__primaryData strong';

	public static $statDelivOk = 'table tbody tr:nth-child(1) td:nth-child(2) div.table_issues__secondaryData span.table_issues__absoluteValue';
	public static $statDelivOk1 = 'table tbody tr:nth-child(2) td:nth-child(2) div.table_issues__secondaryData span.table_issues__absoluteValue';

	public static $statReaded = 'table tbody tr:nth-child(1) td:nth-child(4) div.table_issues__primaryData strong span.table_issues__absoluteValue';
	public static $statReaded1 = 'table tbody tr:nth-child(2) td:nth-child(4) div.table_issues__primaryData strong span.table_issues__absoluteValue';

	public static $statUReaded = 'table tbody tr:nth-child(1) td:nth-child(4) div.table_issues__secondaryData span.table_issues__absoluteValue';
	public static $statUReaded1 = 'table tbody tr:nth-child(2) td:nth-child(4) div.table_issues__secondaryData span.table_issues__absoluteValue';

	public static $statClicked = 'table tbody tr:nth-child(1) td:nth-child(6) div.table_issues__primaryData strong span.table_issues__absoluteValue';
	public static $statClicked1 = 'table tbody tr:nth-child(2) td:nth-child(6) div.table_issues__primaryData strong span.table_issues__absoluteValue';

	public static $statUClicked = 'table tbody tr:nth-child(1) td:nth-child(6) div.table_issues__secondaryData span.table_issues__absoluteValue';
	public static $statUClicked1 = 'table tbody tr:nth-child(2) td:nth-child(6) div.table_issues__secondaryData span.table_issues__absoluteValue';

	public static $statUnsubed = 'table tbody tr:nth-child(1) td:nth-child(8) div.table_issues__primaryData strong span.table_issues__absoluteValue';
	public static $statUnsubed1 = 'table tbody tr:nth-child(2) td:nth-child(8) div.table_issues__primaryData strong span.table_issues__absoluteValue';

	public static $statDelivBad = 'table tbody tr:nth-child(1) td:nth-child(8) div.table_issues__secondaryData span.table_issues__absoluteValue';
	public static $statDelivBad1 = 'table tbody tr:nth-child(2) td:nth-child(8) div.table_issues__secondaryData span.table_issues__absoluteValue';

	public static $statGroupFilter = ['name' => 'group'];
	public static $statGroupFilterDiv = '.select';
	public static $statGroupFilterOption = 'select[name="group"] option:nth-child(2)';

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
