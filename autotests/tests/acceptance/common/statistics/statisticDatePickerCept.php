<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 02.07.15
 * Time: 16:28
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check date picker');
$I->goToStatisticsPage();

//проверка кнопочек
$today = date('d.m.Y');
//за все время
$I->checkDatePickerButtons(StatisticsPage::$rangeAllTime, 'all', '07.04.2014', $today);
//за месяц
$month = date('d.m.Y', mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
$I->checkDatePickerButtons(StatisticsPage::$rangeForMonth, 'month', $month, $today);
//за неделю
$week = date('d.m.Y', mktime(0, 0, 0, date("m"), date("d") - 6, date("Y")));
$I->checkDatePickerButtons(StatisticsPage::$rangeForWeek, 'week', $week, $today);
//вчера
$yesterday = date('d.m.Y', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
$I->checkDatePickerButtons(StatisticsPage::$rangeYesterday, 'yesterday', $yesterday, $yesterday);
//сегодня
$I->checkDatePickerButtons(StatisticsPage::$rangeToday, 'today', $today, $today);

//проверяем, что календарь открылся и закрылся при клике на селект фильтрации группы
$I->click(StatisticsPage::$dateRangePicker);
$I->waitForElement(StatisticsPage::$dateApply, 60);
$I->click(StatisticsPage::$statGroupFilterDiv);
$I->wait(2);
$I->dontSeeElement('.dateRangePicker_period .dropdown_opened');
//открываем календарь
$I->click(StatisticsPage::$dateRangePicker);
$I->waitForElementVisible(StatisticsPage::$dateApply, 60);
//проверяем действие кнопки "Отменить"
$I->see('Отменить', StatisticsPage::$dateCancel);
$I->click(['class' => 'cancelBtn']);
$I->wait(2);
$I->dontSeeElement('.dateRangePicker_period .dropdown_opened');
//открываем календарь
$I->click(StatisticsPage::$dateRangePicker);
$I->waitForElementVisible(StatisticsPage::$dateApply, 60);
//проверяем, что нельзя выбрать дату в обратном порядке
$I->click(StatisticsPage::$datePrevRight);
$I->dontSeeElement(StatisticsPage::$datePrevRight);
$left = $I->grabTextFrom(StatisticsPage::$titleMonthLeft);
$right = $I->grabTextFrom(StatisticsPage::$titleMonthRight);
if ($left != $right) throw new ErrorException('Нельзя выбирать дату в обратном порядке!');

//за все время
$I->checkDatePickerButtons(StatisticsPage::$rangeAllTime, 'all', '07.04.2014', $today);
//открываем календарь
$I->click(StatisticsPage::$dateRangePicker);
$I->waitForElement(StatisticsPage::$dateApply, 60);
//выбираем диапазон с 24.04.2015 по 24.04.2015
do {
	$I->click(StatisticsPage::$dateNextLeft);
} while (!($custom->checkTextElement('Апр 2015', StatisticsPage::$titleMonthLeft)));
$I->click('div.calendar.left div table tbody tr:nth-child(4) td:nth-child(5)');
$I->see('Пт', 'div.calendar.left div table thead tr:nth-child(2) th:nth-child(5)');
do {
	$I->click(StatisticsPage::$datePrevRight);
} while (!($custom->checkTextElement('Апр 2015', StatisticsPage::$titleMonthRight)));
$I->click('div.calendar.right div table tbody tr:nth-child(4) td:nth-child(5)');
$I->see('Пт', 'div.calendar.right div table thead tr:nth-child(2) th:nth-child(5)');
//проверяем что выпуск найден
$I->see('Применить', StatisticsPage::$dateApply);
$I->click(StatisticsPage::$dateApply);
$I->waitForText('Разбираем остатки по смешным ценам!', 60);
//за все время
$I->checkDatePickerButtons(StatisticsPage::$rangeAllTime, 'all', '07.04.2014', $today);
