<?php

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check active rate');

$I->goToRatesPage();

$subscribersLimit = $I->formatNumber(\Page::$individualLimit);

$I->click(\AccountPage::$showRates);
$I->waitForElementVisible('.icon-rouble', 30);
$I->see((string)$subscribersLimit, \AccountPage::$activeRateRow);
