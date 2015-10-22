<?php
use AcceptanceTester\LoginSteps;
use AcceptanceTester\AccountSteps;
use Codeception\Module\TariffsHelper;

$I = new AccountSteps($scenario);
$I->wantTo('Check prices in pay form');

$Login = new LoginSteps($scenario);
$Login->Login();

$I->goToRatesPageForPaid();
$I->click(\AccountPage::$showRates);
$I->see('активный тариф', '//table/tbody/tr[4]/td[3]');

$index = 1;
$tariffs = TariffsHelper::$tariffs;
unset($tariffs['B10']);

foreach (array_slice($tariffs, 1) as $tariff) {
	if ($index == 4) { //Если это B10
		$index++;
	}
	$I->goToRatesPageForPaid();
	$I->click(\AccountPage::$showRates);
	$I->click(['css' => '.table_rates tr:nth-child(' . $index . ') .button']);
	$I->waitForText('Оплата тарифа ' . $tariff['subscribers'] . ' подписчиков', 120);
	$I->see($tariff['price']);
	$index++;
}
