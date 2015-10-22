<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 02.06.15
 * Time: 13:28
 */
$mail = strval(time()) . "@test.ru";
$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Import Member in exist group');
$groupName = strval(time());
$I->createEmptyList($groupName);
$idImport = $I->importMemberInExistList($mail, $groupName);
$track = new \AcceptanceTester\TrackSteps($scenario);
$track->goToTrackPage();
$track->checkResult($idImport, 'Выполнено', 'Повторов: 0. Новых: 1.');
$I->deleteGroupByName($groupName);
