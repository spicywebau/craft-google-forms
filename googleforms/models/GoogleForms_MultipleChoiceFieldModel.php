<?php
namespace Craft;

class GoogleForms_MultipleChoiceFieldModel extends GoogleForms_BaseItemModel
{
	public function getType()
	{
		return 'multipleChoice';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
