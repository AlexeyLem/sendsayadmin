<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 30.07.15
 * Time: 14:37
 */
$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Create and delete segment');
$groupName = strval(time());
$I->createSegment($groupName);
$I->deleteGroupByName($groupName);
