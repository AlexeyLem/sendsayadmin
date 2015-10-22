<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue empty technology stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$technologyStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Нет данных', 60);
$I->dontSeeElement(StatisticsPage::$highchartsContainer);
