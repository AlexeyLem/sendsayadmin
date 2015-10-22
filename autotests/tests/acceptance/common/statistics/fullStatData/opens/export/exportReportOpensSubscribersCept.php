<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 07.07.15
 * Time: 18:07
 */
use AcceptanceTester\TrackSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report opens subscribers');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();
$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$openStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$openStat, StatisticsPage::$openSubscribersStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$openSubscribersStatTitle, 30, StatisticsPage::$title);

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
