<?php

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue deliv stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$deliveryStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$deliveryDomainsStatTitle, 30, StatisticsPage::$title);

$custom = new \AcceptanceTester\CustomSteps($scenario);
$custom->checkDataInFirstTableLine('table', ['mail.ru', '225 999', '225 998', '1']);

$I->see('100.00%', 'table tbody tr:nth-child(1) td:nth-child(3) div');
$I->see('0.00%', 'table tbody tr:nth-child(1) td:nth-child(4) div');
