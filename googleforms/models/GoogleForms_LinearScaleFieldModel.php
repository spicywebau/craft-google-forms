<?php
namespace Craft;

class GoogleForms_LinearScaleFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'linearScale';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
