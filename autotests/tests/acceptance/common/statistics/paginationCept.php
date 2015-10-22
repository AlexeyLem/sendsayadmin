<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 23.06.15
 * Time: 16:07
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check pagination');
$I->goToStatisticsPage();

$I = new \AcceptanceTester\CustomSteps($scenario);

/*
 * Проверяем, что, если пользователь находится не на первой странице пагинации статистики
 * и выбирает дату, то его перенаправляет на первую страницу пагинации
 */
//Переходим на следующую страницу статистики
$I->click(\Page::$paginationNext);
$I->waitForElement(\Page::$pageLoaded, 60);
//открываем календарь
$I->click(StatisticsPage::$dateRangePicker);
$I->waitForElement(StatisticsPage::$dateApply, 60);
$I->click('div.calendar.left div table tbody tr:nth-child(3) td:nth-child(1)');
$I->click('div.calendar.right div table tbody tr:nth-child(3) td:nth-child(7)');
$I->click(StatisticsPage::$dateApply);
$I->waitForElementNotVisible(StatisticsPage::$dateApply, 60);

/**
 * Проверяем пагинацию
 */
$I->click(StatisticsPage::$rangeForWeek);
$I->waitForElement(Page::$pageLoaded, 60);
$I->paginationCheck();
