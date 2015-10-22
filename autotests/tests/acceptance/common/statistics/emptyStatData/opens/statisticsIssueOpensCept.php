<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue opens stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$openStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Нет данных', 60);
