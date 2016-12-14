<?php
namespace Craft;

class GoogleFormsPlugin extends BasePlugin
{
	public function getName()
	{
		return "Google Forms";
	}

	public function getDescription()
	{
		return Craft::t("Integrate Google Forms in your templates");
	}

	public function getVersion()
	{
		return '0.0.1';
	}

	public function getSchemaVersion()
	{
		return '0.0.1';
	}

	public function getCraftMinimumVersion()
	{
		return '2.5';
	}

	public function getPHPMinimumVersion()
	{
		return '5.4';
	}

	public function getDeveloper()
	{
		return "Spicy Web";
	}

	public function getDeveloperUrl()
	{
		return 'http://spicyweb.com.au';
	}

	public function getDocumentationUrl()
	{
		return 'https://github.com/spicywebau/craft-google-forms';
	}

	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/spicywebau/craft-google-forms/master/releases.json';
	}

	public function isCompatible()
	{
		return (
			version_compare(craft()->getVersion(), $this->getCraftMinimumVersion(), '>=') &&
			version_compare(PHP_VERSION, $this->getPHPMinimumVersion(), '>=')
		);
	}

	public function onBeforeInstall()
	{
		return $this->isCompatible();
	}
}
