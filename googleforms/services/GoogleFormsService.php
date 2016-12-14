<?php
namespace Craft;

class GoogleFormsService extends BaseApplicationComponent
{
	public function getForm($formId)
	{
		$data = $this->_extractFormData($formId);

		
	}

	/**
	 * Extracts the raw form data from a Google form.
	 *
	 * @param $formId
	 * @return bool|mixed
	 */
	private function _extractFormData($formId)
	{
		$url = 'https://docs.google.com/forms/d/e/' . $formId . '/viewform';
		$html = $this->_readDataFromUrl($url);
		$data = false;

		if($html)
		{
			$doc = new \DOMDocument();
			$internalErrors = \libxml_use_internal_errors(true);
			$doc->loadHTML($html);
			\libxml_use_internal_errors($internalErrors);
			$xml = \simplexml_import_dom($doc);

			foreach($xml->xpath('//script[not(@src)]') as $node)
			{
				$js = \dom_import_simplexml($node)->nodeValue;
				preg_match('/^var FB_PUBLIC_LOAD_DATA_ = ((.|[\r\n])+);$/', $js, $matches);

				if(!empty($matches))
				{
					$json = $matches[1];
					$data = JsonHelper::decode($json);

					break;
				}
			}
		}

		return $data;
	}

	/**
	 * Reads in data from an external link.
	 *
	 * @param $url
	 * @return bool|mixed|string
	 */
	private function _readDataFromUrl($url)
	{
		if(function_exists('curl_init'))
		{
			GoogleFormsPlugin::log("Reading file with `curl`");

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			$data = curl_exec($ch);
			$error = curl_error($ch);

			if(!empty($error))
			{
				GoogleFormsPlugin::log("Error reading file (\"{$error}\")", LogLevel::Error);

				$data = false;
			}

			curl_close($ch);

			return $data;
		}

		$allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
		if($allowUrlFopen)
		{
			GoogleFormsPlugin::log("Reading file with `file_get_contents`");

			return @file_get_contents($url);
		}

		return false;
	}
}
