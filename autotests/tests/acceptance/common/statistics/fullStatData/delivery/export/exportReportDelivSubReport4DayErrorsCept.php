<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 07.07.15
 * Time: 17:11
 */
use AcceptanceTester\TrackSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Export report deliv subreport error "4day"');

$I->goToFullIssueStat();

$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();

$I->waitLoadingStatPage();

$D = new AcceptanceTester($scenario);
$D->clickLink(StatisticsPage::$deliveryStat);
$D->waitForElement(Page::$pageLoaded, 60);
$D->clickDropdown(StatisticsPage::$deliveryStat, StatisticsPage::$deliveryErrorsStat);
$I->waitForText(StatisticsPage::$fullStatIssueName, 30, Page::$contentTitle);
$I->waitForText(TitlePage::$deliveryErrorsStatTitle, 30, StatisticsPage::$title);

$I->click(['link' => 'Не доставлено за 4 дня']);
$I->waitForText(TitlePage::$delivery4dayErrorsStatTitle, 60, StatisticsPage::$title);

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
