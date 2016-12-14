<?php
namespace Craft;

class GoogleForms_MultipleChoiceGridFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'multipleChoiceGrid';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
