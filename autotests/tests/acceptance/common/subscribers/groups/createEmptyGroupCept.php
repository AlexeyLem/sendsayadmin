<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 02.06.15
 * Time: 13:28
 */
$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Create and delete empty group');
$groupName = strval(time());
$I->createEmptyList($groupName);
$I->deleteGroupByName($groupName);
