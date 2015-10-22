<?php

$I = new \AcceptanceTester\GroupsSteps($scenario);
$I->wantTo('Create and delete segment with filter');

$segmentName = strval(time());
$I->createSegment($segmentName);
$I->click(\GroupsPage::$editSeg);
$I->waitForElement(\Page::$pageLoaded, 60);
$I->waitForElement(['name' => 'add'], 30);

$url = 'http://www.gudiz.ru/catalog/goodies/detskie_tovary_Tovary_dlya_samyh_malenkih/shapochka_dlya_dusha_kupaemsya_bez_slez/&referer=gd_em240415&utm_source=gd_em&utm_medium=int_emailings&utm_term=gd_em240415&utm_campaign=gd_em240415';

$I->setSegmentConditionsGroup([
	[
		'type' => 'byIssueClicks',
		'resp' => '0',
		'issue' => 'По всем выпускам',
		'list' => 'По всем спискам',
		'url' => \GroupsPage::$defaultUrl
	],
	[
		'type' => 'byIssueClicks',
		'resp' => '0',
		'issue' => 'По всем выпускам',
		'list' => 'По всем спискам',
		'url' => \GroupsPage::$defaultUrl
	],
	[
		'type' => 'group',
		'group' => [
			[
				'type' => 'byList',
				'resp' => '1',
				'list' => 'active'
			],
			[
				'type' => 'group',
				'group' => [
					[
						'type' => 'byList',
						'resp' => '0',
						'list' => 'active'
					],
					[
						'type' => 'byList',
						'resp' => '1',
						'list' => 'active'
					]
				]
			],
			[
				'type' => 'byList',
				'resp' => '1',
				'list' => 'active'
			]
		]
	],
	[
		'type' => 'group',
		'group' => [
			[
				'type' => 'byList',
				'resp' => '1',
				'list' => 'active'
			],
			[
				'type' => 'group',
				'group' => [
					[
						'type' => 'byIssueOpens',
						'resp' => '0',
						'issue' => '3556'
					],
					[
						'type' => 'byIssueOpens',
						'resp' => '0',
						'issue' => 'По всем выпускам',
						'list' => 'active'
					],
					[
						'type' => 'group',
						'group' => [
							[
								'type' => 'byIssueDelivery',
								'resp' => '0',
								'issue' => '3556'
							],
							[
								'type' => 'byIssueDelivery',
								'resp' => '0',
								'issue' => 'По всем выпускам',
								'list' => 'active'
							],
							[
								'type' => 'byIssueClicks',
								'resp' => '1',
								'issue' => '3556',
								'url' => $url
							],
							[
								'type' => 'byIssueClicks',
								'resp' => '1',
								'issue' => 'По всем выпускам',
								'list' => 'active',
								'url' => $url
							]
						]
					]
				]
			]
		]
	]
], 'conditions'
);
//Переключаем в простой вид и проверяем модельное окно
$I->click('//div[1]/span[contains(text(), "Простое")]');
$I->seeElement(Page::$modal);
$I->see('Подтвердите действие', Page::$modal);
$I->see('Подтвердить', Page::$modalConfirm);
$I->see('Отменить', Page::$modalCancel);
//Закрываем модальное окно по Esc
$I->click(Page::$modalCancel);
$I->dontSeeElement(Page::$modal);
//Открываем снова модальное окно и соглашаемся
$I->click('//div[1]/span[contains(text(), "Простое")]');
$I->click(Page::$modalConfirm);
$I->dontSee($url);
$I->dontSeeElement('[data-path="conditions[4].group[2].group[0]"] .radioGroup .radioButton:nth-child(1) span');
$I->waitForElement(Page::$pageLoaded, 90);
$I->deleteGroupByName($segmentName);
