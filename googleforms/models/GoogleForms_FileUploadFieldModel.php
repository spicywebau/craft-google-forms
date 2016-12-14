<?php
namespace Craft;

class GoogleForms_FileUploadFieldModel extends GoogleForms_BaseFieldModel
{
	public function getType()
	{
		return 'fileUpload';
	}

	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), [

		]);
	}
}
