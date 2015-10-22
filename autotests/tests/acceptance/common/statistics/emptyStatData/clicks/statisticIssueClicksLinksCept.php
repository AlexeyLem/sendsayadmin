<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue empty clicks links stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$clickStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickLinksStat);
$I->waitForText('Нет данных', 60);
$I->dontSeeElement(StatisticsPage::$highchartsContainer);
