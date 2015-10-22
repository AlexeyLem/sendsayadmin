<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 30.06.15
 * Time: 18:21
 */
use AcceptanceTester\CustomSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue clicks period filter by mounts stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$table = 'table.table_fixed';
$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickPeriodStatTitle, 30, StatisticsPage::$title);

$I->selectOption('groupBy', 'YM');
$I->waitForElement(Page::$pageLoaded, 60);
$I->wait('1');

$date = $I->grabTextFrom('table tbody tr:nth-child(1) td:nth-child(1)');
$I->validateDate($date, 'm.Y');

$custom = new CustomSteps($scenario);
$custom->checkDataInFirstTableLine('table', ['04.2015', '1 462', '797']);
$I->see('0.30%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$I->see('0.16%', 'table tbody tr:nth-child(1) td:nth-child(3) div');
