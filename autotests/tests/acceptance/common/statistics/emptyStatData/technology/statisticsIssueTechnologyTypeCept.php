<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 30.06.15
 * Time: 10:39
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check issue empty technology type stat');

$I->goToEmptyIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$I = new AcceptanceTester($scenario);
$I->clickLink(StatisticsPage::$technologyStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForText('Нет данных', 60);
$I->dontSeeElement(StatisticsPage::$highchartsContainer);
