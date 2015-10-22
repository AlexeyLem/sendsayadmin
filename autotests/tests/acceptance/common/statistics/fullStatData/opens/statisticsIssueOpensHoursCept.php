<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue opens hours stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$openStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$openStat, StatisticsPage::$openHoursStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$openHoursStatTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Время открытия', 'Открыто']);
$custom->checkDataInFirstTableLine($table, ['00:00 — 00:59', '344']);
$I->see('1.42%', 'table tbody tr:nth-child(1) td:nth-child(2) div');

$I->seeElement(StatisticsPage::$highchartsContainer);
