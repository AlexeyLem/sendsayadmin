<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 30.06.15
 * Time: 18:21
 */
use AcceptanceTester\CustomSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue opens period filter by day stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$openStat);
$D->clickLink(StatisticsPage::$openStat);
$D->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$openPeriodStatTitle, 30, StatisticsPage::$title);

$I->selectOption('groupBy', 'YD');
$I->waitForElement(Page::$pageLoaded, 60);
$I->wait('1');

$date = $I->grabTextFrom('table tbody tr:nth-child(1) td:nth-child(1)');
$I->validateDate($date, 'd.m.Y');

$custom = new CustomSteps($scenario);
$custom->checkDataInFirstTableLine('table', ['24.04.2015', '15 272', '6 966']);
$I->see('3.12%', 'table tbody tr:nth-child(1) td:nth-child(2) div');
$I->see('1.42%', 'table tbody tr:nth-child(1) td:nth-child(3) div');
