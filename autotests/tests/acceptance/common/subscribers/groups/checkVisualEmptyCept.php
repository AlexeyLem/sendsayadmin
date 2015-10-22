<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 10.06.15
 * Time: 17:51
 */
$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Check group create form on visual empty');
$I->goToGroupsPage();
$I->click(\GroupsPage::$listCreateLink);
$I->waitForText('Создание списка', 30, \Page::$contentTitle);
$I->seeInCurrentUrl(\GroupsPage::route('/list/create'));
$I->submitForm('.form_createGroup', ['name' => Page::$visualEmpty,], \GroupsPage::$groupCreateButton);
$I->waitForText('Обязательное поле', 30);
$I->seeInCurrentUrl(\GroupsPage::route('/list/create'));

$I->goToGroupsPage();
$I->click(\GroupsPage::$segmentCreateLink);
$I->waitForText('Создание сегмента', 30, \Page::$contentTitle);
$I->seeInCurrentUrl(\GroupsPage::route('/segment/create'));
$I->submitForm('.form_createGroup', ['name' => Page::$visualEmpty,], \GroupsPage::$groupCreateButton);
$I->waitForText('Обязательное поле', 30);
$I->seeInCurrentUrl(\GroupsPage::route('/segment/create'));
