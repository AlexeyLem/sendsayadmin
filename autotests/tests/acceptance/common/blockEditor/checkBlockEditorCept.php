<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 18.08.15
 * Time: 11:40
 */
$subject = strval(time());
codecept_debug($subject);

$I = new AcceptanceTester\MailingsSteps($scenario);
$I->wantTo('Check function block editor and delete draft');

$I->goToCreateMailPage();
$I->fillDraftFields($subject, \MailingsPage::$editAsBlocks);

$I->waitForElement('.templateEditorBlocks', 30);
$I->waitForElement('.templateEditorWorkspace', 30);
$I->waitForElementVisible('tr:nth-child(2)[class=templateEditorWorkspaceBlock] img', 30);

$I->seeElement('.button_save.button_disabled');
$I->seeNumberOfElements('.templateEditorWorkspaceBlock', 19);

$I = new AcceptanceTester\BlockEditorSteps($scenario);
$I->copyBlock(2, 20);
$I->deleteBlock(2, 19);
$I->dragAndDropBlock(2, 5);
$I->see('Душа моя озарена неземной радостью', "//tr[@class='templateEditorWorkspaceBlock'][3]");
$I->addBlock('block_13', 3, 20);

$I->seeElement(MailingsPage::$buttonSave);
$I->click(MailingsPage::$buttonSave);
$I->waitForText('Изменения успешно сохранены', 30);

$I->see('Я так счастлив, мой друг, так упоен ощущением покоя, что искусство мое страдает от этого.', "//tr[@class='templateEditorWorkspaceBlock'][3]");
$I->deleteBlock(3, 19);

$I->seeElement(MailingsPage::$buttonSave);
$I->click(MailingsPage::$buttonSave);
$I->waitForText('Изменения успешно сохранены', 30);
$I->click(MailingsPage::$buttonPreview);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForText('Предпросмотр выпуска', 60, Page::$contentTitle);
$I->waitForElement(Page::$pageLoaded, 60);

$I = new AcceptanceTester\DraftsSteps($scenario);
$I->deleteAutosave($subject);
