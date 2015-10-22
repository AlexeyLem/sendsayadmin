<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 04.06.15
 * Time: 13:57
 */
$I = new AcceptanceTester($scenario);
$D = new AcceptanceTester($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$group = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Check member page');
$groupName = "checkMemStatDontDelete";
$email = 'test@test.ru';

$group->goToGroupPage($groupName);
$D->clickLink('Список подписчиков');
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElementVisible(GroupsPage::$groupDeleteButton, 60);
$I->see($email);

$member = new \AcceptanceTester\MembersSteps($scenario);
$member->goToMemberPage($email);
$table = 'div:nth-child(2) table';
$custom->checkDataInLinesTable($table, ['Отправлено (всего):', 'Получено:', 'Ошибок:', 'Открыто:', 'Переходов всего:', 'Достигнуто целевых страниц:']);
$table = 'div:nth-child(4) table';
$custom->checkDataInLinesTable($table, ['Последний выпуск:', 'Дата и время:', 'Результат', 'Открыто:', 'Переходов:']);

$I->validateDate($I->grabTextFrom('h1 span:nth-child(2)'));
$I->validateDate($I->grabTextFrom('div:nth-child(4) table tbody tr:nth-child(2) td:nth-child(2)'));

$I->clickLink(MembersPage::$data);
$member->waitForElement(Page::$pageLoaded, 60);
$table = 'table';
$I->waitForText('ID подписчика', 10);
$custom->checkDataInLinesTable($table, MembersPage::$systemAnketFirstCol);
$custom->checkDataInLinesTable($table, MembersPage::$systemAnketLastCol, 3);
$I->see($email, 'table tbody tr:nth-child(2) td:nth-child(2)');
$I->validateDate($I->grabTextFrom('table tbody tr:nth-child(4) td:nth-child(2)'));
$I->validateDate($I->grabTextFrom('table tbody tr:nth-child(6) td:nth-child(2)'));
