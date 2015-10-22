<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 07.07.15
 * Time: 12:26
 */
use AcceptanceTester\TrackSteps;

$I = new \AcceptanceTester\StatisticsSteps($scenario);
$I->wantTo('Check export');
$I->goToStatisticsPage();

$idXlsx = $I->exportTo('XLSX');
$idCsv = $I->exportTo('CSV');

$track = new TrackSteps($scenario);
$track->goToTrackPage();

$I->waitForElement("//td[text()[contains(.,$idXlsx)]]", 30);
$track->seeStatLinkById($idXlsx, "Скачать файл");
$track->seeStatLinkById($idCsv, "Скачать файл");
