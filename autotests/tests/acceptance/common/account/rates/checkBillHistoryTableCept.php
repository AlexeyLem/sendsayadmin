<?php

$I = new \AcceptanceTester\AccountSteps($scenario);

$I->wantTo('Check bill history table');

$I->goToRatesPage();

$I->waitForText('История выписанных счетов', 30);
