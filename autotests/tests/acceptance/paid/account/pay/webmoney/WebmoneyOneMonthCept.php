<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 13.07.15
 * Time: 17:30
 */
use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check webmoney pay one month');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->click('.form_pay__periodBox:nth-child(1) label');
$I->click('.form_pay__payment:nth-child(3) label');
$I->click('.button_pay');
try {
	$I->waitForText('WebMoney', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с WebMoney', $e);
}
try {
	$I->waitForText('Оплата услуг ООО "ИНМАРСОФТ"', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с WebMoney', $e);
}
try {
	$I->waitForText((string)\Codeception\Module\TariffsHelper::calcPrice(1), 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с WebMoney', $e);
}