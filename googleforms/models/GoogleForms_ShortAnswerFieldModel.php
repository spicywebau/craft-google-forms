<?php
namespace Craft;

class GoogleForms_ShortAnswerFieldModel extends GoogleForms_BaseItemModel
{
	public function getType()
	{
		return 'shortAnswer';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
