<?php

class MailingsPage
{
    // include url of current page
    public static $URL = '/mailings';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    public static $_email = 'sendsaytester@gmail.com';

    public static $createMail = '.button_type_action';

    public static $fieldName = ['name' => 'name'];
    public static $fieldEmail = ['name' => 'email'];
    public static $fieldSubject = ['name' => 'subject'];
    public static $fieldSubjectEditor = '.textEditor_content';
    public static $aceEditor = ['class' => 'ace_text-input'];
    public static $aceEditorTextarea = ['name' => 'message'];

    public static $saveAsDraft = ['class' => 'button_saveDraft'];
    public static $editAsBlocks = ['link' => 'Блочный шаблон'];
    public static $editAsHtml = ['link' => 'Свой HTML'];
    public static $goToSelectTypeDraftPage = ['class' => 'button_toEditMailingContent'];
    public static $goToSend = '//button[@type="submit"]';
    public static $draftDelete = ['class' => 'button_destroy'];

    public static $buttonBack = ['class' => 'button_back'];
    public static $buttonSave = ['class' => 'button_save'];
    public static $buttonPreview = ['class' => 'button_preview'];
    public static $buttonSend = ['class' => 'button_send'];

    //validate fields
    public static $fieldNameInvalid = ['name' => 'name', 'class' => 'invalid'];
    public static $fieldEmailInvalid = ['name' => 'email', 'class' => 'invalid'];
    public static $fieldSubjectInvalid = ['name' => 'subject', 'class' => 'invalid'];

    public static $emptyMessage = ['name' => 'message', 'class' => 'invalid'];
    public static $wrongEmails = ['123', 'qwe', '123.ru', 'qwe@q', 'qwe@qwe.qwer'];


    //Send Message Page
    public static $singleMessageInput = ['name' => 'email'];

    //Email fields
    public static $fromName = 'Sendsay Codeception Test';
    public static $fromEmail = 'kurilov@iprojects.ru';
    public static $smallMessageText = 'This is text';
    public static $messageTextWithUrls = '<html><body><a href="https://google.com">Google';


    //Date delay
    public static $datePicker = 'div.datePicker div div.dropdown__toggle';


    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
    }


}
