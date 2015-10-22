<?php

$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Check groups list');
$I->goToGroupsPage();
$I->see('Название', GroupsPage::$sortByName);
$I->see('Тип', GroupsPage::$sortByType);
$I->see('Тип подписчиков', GroupsPage::$sortByAddrType);
$I->see('ID', GroupsPage::$sortById);