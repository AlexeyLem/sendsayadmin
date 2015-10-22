<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 09.07.15
 * Time: 15:25
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check issue full technology type all stat');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Все устройства']);
$I->waitForText(TitlePage::$technologyAllTypeStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик', 'Тип устройства']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Персональные компьютеры']);
$I->waitForText(TitlePage::$technologyTypePCStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Смартфоны']);
$I->waitForText(TitlePage::$technologyTypeSmartphoneStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Планшеты']);
$I->waitForText(TitlePage::$technologyTypeTabletStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Другие']);
$I->waitForText(TitlePage::$technologyTypeOtherStatTitle, 60, StatisticsPage::$title);
$custom->checkDataInHeadTableLine('table', ['Подписчик']);

$D->clickLink(StatisticsPage::$technologyStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$technologyStat, StatisticsPage::$technologyTypeStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(TitlePage::$technologyTypeStatTitle, 30, StatisticsPage::$title);
