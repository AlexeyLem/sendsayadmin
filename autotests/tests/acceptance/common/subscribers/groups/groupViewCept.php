<?php

$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Check group view');
$I->goToGroupPage();