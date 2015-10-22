<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 13.07.15
 * Time: 17:01
 */
use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check card pay one months');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->waitForElement('.form_pay__periodBox:nth-child(1) label', 60);
$I->click('.form_pay__periodBox:nth-child(1) label');
$I->click('.button_pay');

try {
	$I->waitForText('ООО "ИНМАРСОФТ"', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой по карте', $e);
}
try {
	$I->see(number_format((string)\Codeception\Module\TariffsHelper::calcPrice(1), 0, " ", " "));
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой по карте', $e);
}
