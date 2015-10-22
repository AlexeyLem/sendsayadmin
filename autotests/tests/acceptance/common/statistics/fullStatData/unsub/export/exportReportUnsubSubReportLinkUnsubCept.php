<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 08.07.15
 * Time: 13:49
 */
use AcceptanceTester\TrackSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report unsub subreport link unsub');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$unsubStat);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$unsubStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Из письма по ссылке "Отписаться"']);
$I->waitForText(TitlePage::$unsubLinkMailStatTitle, 60, StatisticsPage::$title);

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
