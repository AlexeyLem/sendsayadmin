<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 02.09.15
 * Time: 15:35
 * .templateEditorWorkspaceBlock img[data-block-image]:eq(27)
 */
use AcceptanceTester\CustomSteps;
use AcceptanceTester\DraftsSteps;
use AcceptanceTester\MailingsSteps;
use AcceptanceTester\BlockEditorSteps;
use AcceptanceTester\StatisticsSteps;
use AcceptanceTester\TrackSteps;

$subject = strval(time());
codecept_debug($subject);

$I = new MailingsSteps($scenario);
$track = new TrackSteps($scenario);
$custom = new CustomSteps($scenario);
$I->wantTo('Send message creating in block editor, delete draft and check Message');

$I->amOnPage('/mailings/mailing/edit');
$login = new \AcceptanceTester\LoginSteps($scenario);
$login->loginAfterResetCookie();
$I->fillDraftFields($subject, \MailingsPage::$editAsBlocks);

$I->waitForElement('.templateEditorBlocks', 30);
$I->waitForElement('.templateEditorWorkspace', 30);
$I->waitForElementVisible('tr:nth-child(2)[class=templateEditorWorkspaceBlock] img', 30);

$I->seeElement('.button_save.button_disabled');
$I->seeNumberOfElements('.templateEditorWorkspaceBlock', 19);

$I = new BlockEditorSteps($scenario);
$I->checkAllImg('test.jpg');

$I->seeElement(MailingsPage::$buttonSave);
$I->click(MailingsPage::$buttonSave);
$I->waitForText('Изменения успешно сохранены', 30);
$I->click(MailingsPage::$buttonPreview);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Предпросмотр выпуска', 60, Page::$contentTitle);
$I->waitForElement(Page::$pageLoaded, 60);
$draft = new DraftsSteps($scenario);
$draft->deleteAutosave($subject);
