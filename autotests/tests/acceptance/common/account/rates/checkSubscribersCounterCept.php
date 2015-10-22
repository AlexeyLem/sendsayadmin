<?php
$email = strval(time()) . "@test.ru";
$I = new \AcceptanceTester\AccountSteps($scenario);

$I->wantTo('Check subscribers counter on account/rates page');

$I->goToRatesPage();

$subscribersCount = $I->getSubscibersCountFromRatesPage();

$temp = new \AcceptanceTester\GroupsSteps($scenario);
$groupName = strval(time());
$temp->createListWithMembers($groupName, $email);
$I->see('Повторов: 0. Новых: 1.', "//tr[1]//td[last()]");
$I->waitForElementVisible('.button_refresh', 30);
$I->click('.button_refresh');
$I->waitForElement(Page::$pageLoaded, 60);
$I->see($email);

$I->goToRatesPage();
$I->waitForText((string)($subscribersCount + 1), 120, AccountPage::$subscribersInfo);

$temp->deleteGroupByName($groupName);
