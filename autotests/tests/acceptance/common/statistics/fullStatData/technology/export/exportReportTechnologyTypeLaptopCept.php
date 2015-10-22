<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 09.07.15
 * Time: 16:41
 */
$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report technology type laptop');

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

$I->click(['link' => 'Персональные компьютеры']);
$I->waitForText(TitlePage::$technologyTypePCStatTitle, 60, StatisticsPage::$title);

$idXLSX = $I->exportTo('XLSX');
$idCSV = $I->exportTo('CSV');

$track = new \AcceptanceTester\TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXLSX)]]", 30);
$track->seeStatLinkById($idXLSX, "Скачать файл");
$track->seeStatLinkById($idCSV, "Скачать файл");
