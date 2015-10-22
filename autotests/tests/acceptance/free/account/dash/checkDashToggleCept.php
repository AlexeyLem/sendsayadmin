<?php
/**
 * Created by PhpStorm.
 * User: kurilov
 * Date: 22.07.15
 * Time: 18:44
 */

use AcceptanceTester\AccountSteps;
use AcceptanceTester\CustomSteps;
use AcceptanceTester\LoginSteps;
use AcceptanceTester\MailingsSteps;
use Codeception\Module\AcceptanceHelper;
use Facebook\WebDriver\Exception\ExpectedException;

$I = new AcceptanceTester($scenario);
$mail = new MailingsSteps($scenario);
$custom = new CustomSteps($scenario);
$account = new AccountSteps($scenario);
$login = new LoginSteps($scenario);
$subject = strval(time());

//Создаем фейковый аккаунт
$account->getNewFakeAcount();
$freeAccount = AcceptanceHelper::configGet();

//Логинимся
$I->amOnUrl('http://localhost:8080' . \LoginPage::$URL);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElement(\LoginPage::$loginInput, 60);
$I->fillField(\LoginPage::$loginInput, $freeAccount['login']);
$I->fillField(\LoginPage::$passwordInput, $freeAccount['pass']);
$I->click(\LoginPage::$submitButton);
$I->click(\LoginPage::$submitButton);
$I->waitForElement(Page::$pageLoaded, 60);
try {
    $I->waitForElement(\MenuPage::$account, 120);
} catch (\Exception $e) {
    ExpectedException::throwException('2', 'Не смогли залогиниться', $e);
}
$I->see('Отлично!', 'h1');
$I->see('Создайте выпуск рассылки');
$I->see('Создать рассылку', '.button');

//Отправляем пробную рассылку
$mail->goToCreateMailPage();
$mail->fillDraftFields($subject, \MailingsPage::$editAsHtml);
$mail->fillHTML();

$I->click(\MailingsPage::$buttonSend);
$I->waitForElement(Page::$pageLoaded, 60);

$I->waitForText('Отправка выпуска', 60, Page::$contentTitle);
$I->see('Создать список', '.form__field a');
$I->see(MailingsPage::$fromEmail);
$I->see(MailingsPage::$fromName);
$I->see($subject);

$I->fillField(\MailingsPage::$singleMessageInput, MailingsPage::$_email);
$I->click(\MailingsPage::$goToSend);
$I->waitForElement(Page::$pageLoaded, 60);
$I->click(TrackPage::$ring);
$I->waitForText('Журнал заданий', 120);
$I->waitForText('Выполнено', 360);

//Проверяем, что дэшборд сменился
$I->click(MenuPage::$review);
$I->waitForElement(Page::$pageLoaded, 60);
$I->waitForElement('.widget', 60);
$I->dontSee('Отлично!');
