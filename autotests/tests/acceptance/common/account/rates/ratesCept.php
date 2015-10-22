<?php

$I = new \AcceptanceTester\AccountSteps($scenario);

$I->wantTo('Check account/rates page');

$I->goToRatesPage();
$I->click(AccountPage::$showRates);
$I->waitForText('активный тариф', 60);
$I->dontSee('Купить');
