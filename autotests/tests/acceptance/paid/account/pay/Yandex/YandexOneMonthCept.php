<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 13.07.15
 * Time: 17:39
 */
use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check yandex pay one months');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->click('.form_pay__periodBox:nth-child(1) label');
$I->click('.form_pay__payment:nth-child(2) label');
$I->click('.button_pay');

try {
	$I->waitForText('ООО "ИНМАРСОФТ"', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой через Яндекс.Деньги', $e);
}
try {
	$I->waitForText((string)\Codeception\Module\TariffsHelper::calcPrice(1), 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой через Яндекс.Деньги', $e);
}
