<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check empty issue click map stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();
$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$clickMap);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement('.clickmap', 120);
$I->waitForText('Нет кликов', 30);

