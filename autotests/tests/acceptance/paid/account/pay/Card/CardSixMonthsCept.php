<?php

use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check card pay six months');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->waitForElement('.form_pay__periodBox:nth-child(4) label', 60);

$I->waitForElement('.form_pay__periodBox:nth-child(1) label', 60);
$I->click('.form_pay__periodBox:nth-child(3) label');
$I->click('.button_pay');

try {
	$I->waitForText('ООО "ИНМАРСОФТ"', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой по карте', $e);
}
$I->see(number_format((string)\Codeception\Module\TariffsHelper::calcPrice(6), 0, " ", " "));
