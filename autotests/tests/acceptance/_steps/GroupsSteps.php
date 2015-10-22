<?php
namespace AcceptanceTester;

use Facebook\WebDriver\Exception\ExpectedException;

class GroupsSteps extends \AcceptanceTester
{

	/**
	 * @param      $name
	 * @param null $type
	 */
	public function createEmptyList($name, $type = null)
	{

		$I = $this;

		self::goToGroupsPage();
		$I->click(\GroupsPage::$listCreateLink);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForText('Создание списка', 30, \Page::$contentTitle);
		$I->seeInCurrentUrl(\GroupsPage::route('/list/create'));
		$I->submitForm('.form_createGroup', ['name' => $name,], \GroupsPage::$groupCreateButton);
		$I->waitForText($name, 30, \Page::$contentTitle);
		$I->waitForElementVisible(\GroupsPage::$groupDeleteButton, 120);
		$I->see('В списке нет ни одного подписчика.');
		$I->see('Добавить подписчиков');

	}

	public function goToGroupsPage()
	{

		$I = $this;

		$I->waitForElement(\Page::$pageLoaded, 90);
		$I->waitForElementVisible('.navigation_type_primary', 60);
		$I->waitForElementVisible('.header__account', 60);
		$I->waitForElementVisible(\MenuPage::$subscribers, 60);
		$I->click(\MenuPage::$subscribers);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForText('Подписчики', 30, \Page::$contentTitle);
		$I->seeInCurrentUrl(\GroupsPage::route('/lists'));
		$I->waitForElement('.table_loaded', 60);
	}

	/**
	 * @param $name
	 * @param null $type
	 */
	public function createSegment($name, $type = null)
	{

		$I = $this;

		self::goToGroupsPage();
		$I->click(\GroupsPage::$segmentCreateLink);
		$I->waitForText('Создание сегмента', 30, \Page::$contentTitle);
		$I->seeInCurrentUrl(\GroupsPage::route('/segment/create'));
		$I->submitForm('.form_createGroup', ['name' => $name,], \GroupsPage::$groupCreateButton);
		$I->waitForText($name, 30, \Page::$contentTitle);
		$I->waitForElementVisible(\GroupsPage::$groupDeleteButton, 120);
		$I->see('Нет подписчиков соответствующих условиям фильтрации');
		$I->see('Редактировать условия фильтрации');

	}

	/**
	 * @param      $group     string (group name)
	 * @param null $addrType  string (email or msisdn)
	 * @param      $members   string (JSON, CSV)
	 *
	 * @return string     $id
	 */
	public function createListWithMembers($group, $members, $addrType = null)
	{

		$I = $this;
		$custom = new CustomSteps($this->scenario);

		self::goToGroupsPage();
		$I->click(\GroupsPage::$listCreateLink);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->see('Создание списка', \Page::$contentTitle);
		$I->seeInCurrentUrl(\GroupsPage::route('/list/create'));
		$I->fillField('name', $group);
		$I->fillField('list', $members);
		$I->click(\GroupsPage::$groupCreateButton);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForText($group, 60, \Page::$contentTitle);
		$I->waitForElementVisible(\GroupsPage::$groupDeleteButton, 120);
		$custom->checkDataInHeadTableLine('.table_hover_disabled', ['ID', 'Задания', 'Дата постановки', 'Статус', 'Результат']);
		$id = $I->grabTextFrom("//tr[1]//td[1]");
		$I->waitForText('Выполнено', 180, "//tr[1]//td[4]");
		return $id;
	}

	/**
	 * @param $email
	 * @param $group
	 *
	 * @return mixed
	 */
	public function importMemberInExistList($email, $group)
	{

		$I = $this;
		$custom = new CustomSteps($this->scenario);

		self::goToGroupPage($group);
		$I->click(\GroupsPage::$memersAdd);
		$I->waitForElement(['class' => 'form'], 60);
		$I->submitForm('.form', [\GroupsPage::$addMembersField['name'] => $email], \GroupsPage::$groupCreateButton);
		$I->waitForText($group, 30, \Page::$contentTitle);
		$I->waitForElementVisible(\GroupsPage::$groupDeleteButton, 120);
		$custom->checkDataInHeadTableLine('.table_hover_disabled', ['ID', 'Задания', 'Дата постановки', 'Статус', 'Результат']);
		$id = $I->grabTextFrom("//tr[1]//td[1]");
		$I->waitForText('Выполнено', 120, "//tr[1]//td[4]");
		$I->see('Повторов: 0. Новых: 1.', "//tr[1]//td[last()]");
		$I->waitForElementVisible('.button_refresh', 30);
		$I->click('.button_refresh');
		$I->waitForText($email, 60);
		return $id;
	}

	/**
	 * @param null $name
	 */
	public function goToGroupPage($name = null)
	{
		$I = $this;
		$custom = new CustomSteps($this->scenario);

		if ($name == null) {
			$name = \GroupsPage::$defaultSegmentName;
		}
		self::goToGroupsPage();
		$custom->findElemUsePaginationAndClick($name, "//tr//td[1]");
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForText($name, 30, \Page::$contentTitle);
		$I->waitForElement('.button', 60);
	}

	/**
	 * @param $name
	 */
	public function deleteGroupByName($name)
	{

		$I = $this;
		$custom = new CustomSteps($this->scenario);
		$D = new \AcceptanceTester($this->scenario);

		self::goToGroupsPage();
		$custom->findElemUsePaginationAndClick($name, "//tr//td[1]");
		$I->waitForText($name, 30, \Page::$contentTitle);
		$D->clickLink('Список подписчиков');
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForElementVisible(\GroupsPage::$groupDeleteButton, 60);
		$I->click(\GroupsPage::$groupDeleteButton);
		$I->waitForText('Подписчики', 30, \Page::$contentTitle);
		$I->dontSee($name);
	}

	/**
	 * @param $conditions
	 * @param $path
	 */
	public function setSegmentConditionsGroup($conditions, $path)
	{
		$I = $this;
		$I->waitForElement('.select__box', 60);
		foreach ($conditions as $index => $condition) {

			if ($condition["type"] == 'group') {
				$I->addSegmentConditionGroup($condition["group"][0]["type"], $path, $index);
				$I->setSegmentConditionsGroup($condition["group"], $path . '[' . ($index * 2) . '].group');
			} else {

				if ($path == 'conditions' || ($path != 'conditions' && $index > 0)) {
					$I->addSegmentCondition($condition["type"], $path);
				}
				$I->setSegmentConditon($condition, $path, $index, $condition["type"]);
			}
		}
		$I->click(\GroupsPage::$groupCreateButton);
		$I->waitForElement(\Page::$pageLoaded, 60);
		$I->waitForElement('.select__box', 60);
	}

	/**
	 * @param $type
	 * @param $path
	 * @param $index
	 */
	public function addSegmentConditionGroup($type, $path, $index)
	{
		$this->addSegmentCondition($type, $path);

		$this->click('[data-path="' . $path . '[' . ($index * 2) . ']"] .button_add');
	}

	/**
	 * @param $type
	 * @param $conditionAdderPath
	 */
	public function addSegmentCondition($type, $conditionAdderPath)
	{
		if ($conditionAdderPath != 'conditions') {
			$conditionAdderPath = substr($conditionAdderPath, 0, -6);
		}

		$conditionAdderPath = '[data-add-path="' . $conditionAdderPath . '"] select[name="add"]';

		$this->selectOption($conditionAdderPath, $type);
	}

	/**
	 * @param $condition
	 * @param $path
	 * @param $index
	 * @param $type
	 *
	 * @throws ExpectedException
	 */
	public function setSegmentConditon($condition, $path, $index, $type)
	{
		$I = $this;
		$I->wait(1);
		$conditionPath = '[data-path="' . $path . '[' . ($index * 2) . ']"]';

		$I->click($conditionPath . ' .radioGroup .radioButton:nth-child(' . (intval($condition["resp"]) + 1) . ') span');

		if ($type === 'byList') {

			$I->selectOption($conditionPath . '  select[name="list"]', $condition["list"]);

		} elseif ($type === 'byIssueOpens') {

			$I->selectOption($conditionPath . '  select[name="issue"]', $condition["issue"]);
			if ($condition["issue"] === 'По всем выпускам') {
				$I->selectOption($conditionPath . '  select[name="list"]', $condition["list"]);
			}

		} elseif ($type === 'byIssueDelivery') {

			$I->selectOption($conditionPath . '  select[name="issue"]', $condition["issue"]);
			if ($condition["issue"] === 'По всем выпускам') {
				$I->selectOption($conditionPath . '  select[name="list"]', $condition["list"]);
			}

		} elseif ($type === 'byIssueClicks') {

			$I->selectOption($conditionPath . '  select[name="issue"]', $condition["issue"]);
			if ($condition["issue"] === 'По всем выпускам') {
				$I->selectOption($conditionPath . '  select[name="list"]', $condition["list"]);
			}
			$I->fillField($conditionPath . '  input[name="url"]', $condition["url"]);

		} else {
			ExpectedException::throwException(2, 'Неверный тип селекта!', 'condition=' . $condition . ' path=' . $path . ' indedx=' . $index . ' type=' . $type);
		}
	}

}
