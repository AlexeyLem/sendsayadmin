<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check empty issue deliv stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$deliveryStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Нет данных', 60);
