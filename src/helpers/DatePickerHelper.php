<?php
namespace andrewdanilov\gridtools\helpers;

use Yii;

class DatePickerHelper
{
	public static function defaultOptions()
	{
		return [
			'language' => Yii::$app->language,
			'template' => '{input}{addon}',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd.mm.yyyy',
				'clearBtn' => true,
				'todayBtn' => 'linked',
			],
			'clientEvents' => [
				'clearDate' => 'function (e) {$(e.target).find("input").change();}',
			],
		];
	}
}