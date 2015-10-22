<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue opens period stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$openStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$openStat, StatisticsPage::$openPeriodStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$openPeriodStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Дата открытия', 'Открыто', 'Уникальные открытия']);
$custom->checkDataInFirstTableLine($table, ['24.04.2015 11:00', '2 382', '1 110']);

$I->see('0.49%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$I->see('0.23%', 'table tbody tr:nth-child(1) td:nth-child(3) div');

$I->seeElement(StatisticsPage::$highchartsContainer);
