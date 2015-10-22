<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check empty issue deliv errors stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$deliveryStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForText('Нет данных', 60);
