<?php
/**
 * Created by PhpStorm.
 * User: nastya
 * Date: 08.07.15
 * Time: 15:43
 */
$I = new \AcceptanceTester\TrackSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check track page');

$I->goToTrackPage();

$custom->checkDataInHeadTableLine('table', ['ID', 'Задания', 'Группа', 'Дата постановки', 'Статус', 'Результат']);

$custom->checkPaginationButton();
