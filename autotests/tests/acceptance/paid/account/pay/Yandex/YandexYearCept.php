<?php

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check yandex pay year');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->click('.form_pay__payment:nth-child(2) label');
$I->click('.button_pay');
$I->waitForText('ООО "ИНМАРСОФТ"', 120);
$I->see((string)\Codeception\Module\TariffsHelper::calcPrice(12));
