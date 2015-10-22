<?php

use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check tariffs');

$I->goToRatesPage();

$I->click(\AccountPage::$showRates);
$I->waitForElementVisible('.icon-rouble', 30);
$I->see('активный тариф');
$I->dontSee('Купить', 'a');
$I->click(\AccountPage::$hideRates);
$I->waitForElementVisible(\AccountPage::$showRates, 60);
