<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue click map stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$clickMap);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickMapTitle, 30, StatisticsPage::$title);

$table = 'table';
$custom->checkDataInHeadTableLine($table, ['Ссылка', 'Переходов']);
$custom->checkDataInFirstTableLine($table, ['http://www.gudiz.ru/?referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415', '280']);

$I->seeElement(StatisticsPage::$clickMapContainer);
