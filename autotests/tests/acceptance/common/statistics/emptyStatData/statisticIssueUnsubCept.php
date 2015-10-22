<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue empty unsub stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Нет данных', 60);
$I->dontSeeElement(StatisticsPage::$highchartsContainer);
