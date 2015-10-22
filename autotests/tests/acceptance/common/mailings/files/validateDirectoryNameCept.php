<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 01.09.15
 * Time: 13:17
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\FilesSteps;

$I = new AcceptanceTester($scenario);
$I->wantTo('Validate Directory Name');
$custom = new CustomSteps($scenario);
$name = 'testDirectory';
$symbols = ['/', ':', '*', '?', '"', '<', '>', '|', '..'];

$files = new FilesSteps($scenario);
$files->goToFilesPage();

$files->createDirectory($files->generateName(), true);
$I->see('Имя папки содержит более 255 символов', '.form__errorMessage_visible');
$I->click(Page::$modalCancel);

foreach ($symbols as $key => $value) {
	$files->createDirectory($value, true);
	$I->see('Имя папки содержит запрещенные символы (/:*?"<>|..)', '.form__errorMessage_visible');
	$I->click(Page::$modalCancel);
}

$files->createDirectory('  ', true);
$I->see('Недопустимое название папки', '.form__errorMessage_visible');
$I->click(Page::$modalCancel);

$files->createDirectory('.', true);
$I->see('Недопустимое название папки', '.form__errorMessage_visible');
$I->click(Page::$modalCancel);
