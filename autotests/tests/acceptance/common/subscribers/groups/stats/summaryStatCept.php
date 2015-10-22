<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 30.06.15
 * Time: 14:41
 */

use Facebook\WebDriver\Exception\ExpectedException;

$I = new \AcceptanceTester\GroupsSteps($scenario);
$custom = new \AcceptanceTester\CustomSteps($scenario);
$I->wantTo('Check group create form on visual empty');

$I->goToGroupPage();
$D = new AcceptanceTester($scenario);
$D->clickLink('Список подписчиков');
$I->waitForElement(Page::$pageLoaded, 60);
$I->see('@test.ru');

$I->click(GroupsPage::$groupStat);
$I->waitForText('Отправлено писем', 60, 'table tbody tr:nth-child(2) td:nth-child(1)');

//Проверяем таблицу со статистикой
$custom->checkDataInLinesTable('table', ['Всего выпусков email-рассылок', 'Отправлено писем', 'Уникальных получателей', 'Кликов', 'Уникальных кликов', 'Достижений целевых страниц', 'Уникальных достижений целевых страниц', 'Чтений', 'Уникальный чтений', 'Отписок из писем выпусков', 'Уникальных отписок из писем выпусков']);

for ($i = 1; $i <= 11; $i++) {
	$text = $I->grabTextFrom("table tbody tr:nth-child({$i}) td:nth-child(2)");
	if (intval($text) < 0) {
		ExpectedException::throwException(2, 'Неверные данные в поле. ' . $text, $text);
	}
}
