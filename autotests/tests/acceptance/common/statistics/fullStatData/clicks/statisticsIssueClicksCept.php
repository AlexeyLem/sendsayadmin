<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full clicks stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickPeriodStatTitle, 30, StatisticsPage::$title);

//Сортировка в таблице должна быть правильной
$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Дата перехода', 'Переходов', 'Уникальных переходов']);
$custom->checkDataInFirstTableLine($table, ['24.04.2015 11:00', '153', '102']);

$I->seeElement(StatisticsPage::$highchartsContainer);
