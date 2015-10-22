<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 09.07.15
 * Time: 16:40
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report technology all OS');

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

$idXLSX = $I->exportTo('XLSX');
$idCSV = $I->exportTo('CSV');

$track = new \AcceptanceTester\TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXLSX)]]", 30);
$track->seeStatLinkById($idXLSX, "Скачать файл");
$track->seeStatLinkById($idCSV, "Скачать файл");
