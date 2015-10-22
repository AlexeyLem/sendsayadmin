<?php
/**
 * Created by PhpStorm.
 * User: anastasya
 * Date: 18.08.15
 * Time: 15:58
 */

namespace AcceptanceTester;


use Codeception\Module\WebDriver;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class BlockEditorSteps extends \AcceptanceTester
{
    /**
     * @param $idBlock //ID добавляемого блока
     * - 'block_13'
     * @param $pos //номер позиции
     * integer
     * @param $quantity //количество блоков по завершению
     * integer
     *
     * функция добавления блока
     */
    public function addBlock($idBlock, $pos, $quantity)
    {
        $I = $this;

        $I->dragAndDrop("div[data-id=$idBlock]", "//tr[@class='templateEditorWorkspaceBlock'][$pos]");
        $I->seeNumberOfElements('.templateEditorWorkspaceBlock', $quantity);
    }

    /**
     * integer
     * @param $from //номер позиции
     * @param $to //номер позиции
     *
     * функция перемещения блока
     */
    public function dragAndDropBlock($from, $to)
    {
        $I = $this;

        $I->moveMouseOver("//tr[@class='templateEditorWorkspaceBlock'][$from]", 20, 50);
        $I->waitForElementVisible("//tr[$from]//span[contains(@class, 'button_handle')]", 30);
        $I->dragAndDrop("//tr[$from]//span[contains(@class, 'button_handle')]", "//tr[@class='templateEditorWorkspaceBlock'][$to]");
    }

    /**
     * integer
     * @param $num //номер позиции блока
     * @param $quantity //количество блоков по завершению
     *
     * функция копирования блока
     *
     */
    public function copyBlock($num, $quantity)
    {
        $I = $this;

        $I->moveMouseOver("//tr[@class='templateEditorWorkspaceBlock'][$num]", 20, 50);
        $I->waitForElementVisible("//tr[$num]//span[contains(@class, 'button_copy')]", 30);
        $I->click("//tr[$num]//span[contains(@class, 'button_copy')]");
        $I->seeNumberOfElements('.templateEditorWorkspaceBlock', $quantity);
    }

    /**
     * integer
     * @param $num //номер позиции блока
     * @param $quantity //количество блоков по завершению
     *
     * функция удаления блока
     */
    public function deleteBlock($num, $quantity)
    {
        $I = $this;

        $I->moveMouseOver("//tr[@class='templateEditorWorkspaceBlock'][$num]", 20, 50);
        $I->waitForElementVisible("//tr[$num]//span[contains(@class, 'button_delete')]", 30);
        $I->click("//tr[$num]//span[contains(@class, 'button_delete')]");
        $I->seeNumberOfElements('.templateEditorWorkspaceBlock', $quantity);
    }

    /**
     * удалить все блоки из редактора
     */
    public function deleteAllBlocks()
    {
        $I = $this;
        $custom = new CustomSteps($this->scenario);

        do {
            $I->moveMouseOver("//tr[@class='templateEditorWorkspaceBlock'][1]", 20, 50);
            $I->waitForElementVisible("//tr[1]//span[contains(@class, 'button_delete')]", 30);
            $I->click("//tr[1]//span[contains(@class, 'button_delete')]");
        } while (!($custom->checkElement('.templateEditorWorkspace__placeholder')));
    }

    /**
     * добавить все блоки в пустой редактор
     */
    public function addAllBlocks()
    {
        $I = $this;

        $I->dragAndDrop("div[data-id=block_1]", ".templateEditorWorkspace__placeholder");
        $I->seeNumberOfElements('.templateEditorWorkspaceBlock', 1);
        $I->dragAndDrop("div[data-id=block_2]", "//tr[@class='templateEditorWorkspaceBlock'][1]");
        $I->seeNumberOfElements('.templateEditorWorkspaceBlock', 2);
        for ($i = 1; $i <= 17; $i++) {
            $j = $i + 2;
            $I->addBlock("block_$j", 1, $j);
        }
    }

    public function checkAllImg($nameImg)
    {
        $I = $this;

        for ($i = 1; $i < 29; $i++){
            $I->click("(//img[@data-block-image])[$i]");
            $I->waitForElement('.button_loadImage', 10);
            $I->attachFile("(//*[contains(@class,'button__fileInput')])[$i]", $nameImg);
            $I->waitForElement(\Page::$pageLoaded, 60);
            $I->wait(2);
            codecept_debug($src = $I->grabAttributeFrom("(//img[@data-block-image])[$i]", 'src'));
            if(!stripos($src, $nameImg)) throw new \ErrorException('Картинка не добавлена!');
        }
    }
}
