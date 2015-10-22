<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 09.07.15
 * Time: 15:47
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full technology all OS stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Все опер. системы']);
$I->waitForText(TitlePage::$technologyAllOSStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик', 'Опер. Система']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Windows']);
$I->waitForText(TitlePage::$technologyOSWinStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'iOS']);
$I->waitForText(TitlePage::$technologyiOSStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Android']);
$I->waitForText(TitlePage::$technologyOSAndroidStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Mac']);
$I->waitForText(TitlePage::$technologyOSXStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Другие']);
$I->waitForText(TitlePage::$technologyOtherOSStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Linux']);
$I->waitForText(TitlePage::$technologyOSLinuxStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyOSStat);
$I->waitForText(TitlePage::$technologyOSStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Blackberry']);
$I->waitForText(TitlePage::$technologyOSBlackberryStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);
