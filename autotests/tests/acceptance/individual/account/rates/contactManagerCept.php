<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 10.06.15
 * Time: 16:06
 */
$I = new \AcceptanceTester\AccountSteps($scenario);

$I->goToPayPage();
$I->see('Оплата', 'h1');
$I->see('Вы на индивидуальном тарифе', 'strong');
$I->see('Для оплаты тарифа свяжитесь с менеджером.', 'p');
