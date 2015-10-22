<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 08.07.15
 * Time: 13:49
 */
use AcceptanceTester\StatisticsSteps;
use AcceptanceTester\TrackSteps;
use AcceptanceTester\LoginSteps;

$I = new StatisticsSteps($scenario);
$I->wantTo('Export report unsub subreport all unsub');

$I->goToFullIssueStat();

$login = new LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Все отписки']);
$I->waitForText(TitlePage::$unsubAllStatTitle, 60, StatisticsPage::$title);

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
