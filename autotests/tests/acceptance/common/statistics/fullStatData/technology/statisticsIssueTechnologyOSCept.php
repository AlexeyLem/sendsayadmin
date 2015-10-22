<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 30.06.15
 * Time: 10:40
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full technology OS stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Тип операционной системы', 'Активность с ОС']);

$I->seeElement(StatisticsPage::$highchartsContainer);

$custom->checkDataInFirstTableLine($table, ['Все опер. системы', '3 120']);
$I->see('100.00%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Windows', '1 443'], 2);
$I->see('46.25%', 'table tbody tr:nth-child(2) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['iOS', '991'], 3);
$I->see('31.76%', 'table tbody tr:nth-child(3) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Android', '478'], 4);
$I->see('15.32%', 'table tbody tr:nth-child(4) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Mac', '152'], 5);
$I->see('4.87%', 'table tbody tr:nth-child(5) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Другие', '44'], 6);
$I->see('1.41%', 'table tbody tr:nth-child(6) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Linux', '11'], 7);
$I->see('0.35%', 'table tbody tr:nth-child(7) td:nth-child(2) div');
$custom->checkDataInFirstTableLine($table, ['Blackberry', '1'], 8);
$I->see('0.03%', 'table tbody tr:nth-child(8) td:nth-child(2) div');
