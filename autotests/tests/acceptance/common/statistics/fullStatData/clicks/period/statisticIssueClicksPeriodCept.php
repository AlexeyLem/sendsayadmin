<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 25.06.15
 * Time: 12:45
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full clicks period stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickPeriodStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickPeriodStatTitle, 30, StatisticsPage::$title);

//с учетом сортировки
$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Дата перехода', 'Переходов', 'Уникальных переходов']);
$custom->checkDataInFirstTableLine($table, ['24.04.2015 11', '153', '102']);

$I->see('0.03%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$I->see('0.02%', 'table tbody tr:nth-child(1) td:nth-child(3) div');

$I->seeElement(StatisticsPage::$highchartsContainer);
