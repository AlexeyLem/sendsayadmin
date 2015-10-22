<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 08.07.15
 * Time: 14:50
 */
use AcceptanceTester\TrackSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report clicks sub report first links');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$clickStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$clickStat, StatisticsPage::$clickLinksStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$clickLinksStatTitle, 30, StatisticsPage::$title);
$link = 'http://www.gudiz.ru/?referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415';
$I->click(['link' => $link]);
$I->waitForElement("//div[contains(@class,'table__caption')]//span[contains(@title,'$link')]", 60);

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
