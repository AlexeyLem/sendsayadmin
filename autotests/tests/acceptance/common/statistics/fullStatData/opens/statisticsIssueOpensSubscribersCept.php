<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue opens subscribers stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$openStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$openStat, StatisticsPage::$openSubscribersStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$openSubscribersStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Подписчик', 'Дата первого открытия', 'Всего открытий']);
$date = $I->grabTextFrom('table tbody tr:nth-child(1) td:nth-child(2)');
$I->validateDate($date, 'd.m.Y H:i');
$custom->checkDataInFirstTableLine($table, ['540670@chebnet.com', '24.04.2015 11:48', '2']);
