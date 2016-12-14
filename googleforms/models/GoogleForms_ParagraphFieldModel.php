<?php
namespace Craft;

class GoogleForms_ParagraphFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'paragraph';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
