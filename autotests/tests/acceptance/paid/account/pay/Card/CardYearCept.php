<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 13.07.15
 * Time: 17:05
 */
use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\AccountSteps($scenario);
$I->wantTo('Check card pay year');

$Login = new \AcceptanceTester\LoginSteps($scenario);
$Login->Login();

$I->goToPayPage();

$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement(MenuPage::$account, 60);
$I->click('.button_pay');

try {
	$I->waitForText('ООО "ИНМАРСОФТ"', 120);
} catch (Exception $e) {
	ExpectedException::throwException('2', 'Проблема у Яндекса с оплатой по карте', $e);
}
$I->waitForText(number_format((string)\Codeception\Module\TariffsHelper::calcPrice(12), 0, " ", " "), 120);
