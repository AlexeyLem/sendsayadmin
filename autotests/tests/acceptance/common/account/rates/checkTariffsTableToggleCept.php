<?php

$I = new \AcceptanceTester\AccountSteps($scenario);

$I->wantTo('Check tariffs table toggle');

$I->goToRatesPage();

$I->click(\AccountPage::$showRates);
$I->waitForText('активный тариф', 30);

$I->click(\AccountPage::$hideRates);
$I->waitForElementVisible(\AccountPage::$showRates, 60);
