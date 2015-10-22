<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 30.06.15
 * Time: 10:39
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full technology type stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Тип устройства', 'Активность с устройства']);

$I->seeElement(StatisticsPage::$highchartsContainer);

$custom->checkDataInFirstTableLine($table, ['Все устройства', '3 120']);
$I->see('100.00%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Персональные компьютеры', '1 591'], 2);
$I->see('50.99%', 'table tbody tr:nth-child(2) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Смартфоны', '803'], 3);
$I->see('25.74%', 'table tbody tr:nth-child(3) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Планшеты', '684'], 4);
$I->see('21.92%', 'table tbody tr:nth-child(4) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Другие', '42'], 5);
$I->see('1.35%', 'table tbody tr:nth-child(5) td:nth-child(2) div');
