<?php
namespace andrewdanilov\gridtools;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Use this action column class in action grid components
 * instead of standard \yii\grid\ActionColumn
 * for replace bootstrap icons to fontawesome.
 */
class FontawesomeActionColumn extends \yii\grid\ActionColumn
{
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$contentOptionsClass = ArrayHelper::getValue($this->contentOptions, 'class');
		if ($contentOptionsClass) {
			$contentOptionsClass = explode(' ', $contentOptionsClass);
		} else {
			$contentOptionsClass = [];
		}
		if (!in_array('action-buttons', $contentOptionsClass)) {
			$contentOptionsClass[] = 'action-buttons';
		}
		$this->contentOptions['class'] = implode(' ', $contentOptionsClass);

		parent::init();
	}

	/**
	 * Initializes the default button rendering callbacks.
	 */
	protected function initDefaultButtons()
	{
		$this->initDefaultButton('view', 'eye');
		$this->initDefaultButton('update', 'pen');
		$this->initDefaultButton('delete', 'trash', [
			'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
			'data-method' => 'post',
		]);
	}

	protected function initDefaultButton($name, $iconName, $additionalOptions = [])
	{
		if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
			$this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
				switch ($name) {
					case 'view':
						$title = Yii::t('yii', 'View');
						break;
					case 'update':
						$title = Yii::t('yii', 'Update');
						break;
					case 'delete':
						$title = Yii::t('yii', 'Delete');
						break;
					default:
						$title = ucfirst($name);
				}
				$options = array_merge([
					'title' => $title,
					'aria-label' => $title,
					'data-pjax' => '0',
				], $additionalOptions, $this->buttonOptions);
				$icon = Html::tag('span', '', ['class' => "fa fa-$iconName"]);
				return Html::a($icon, $url, $options);
			};
		}
	}
}