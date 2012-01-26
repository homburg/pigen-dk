<?php

/**
 * Force facebook to update opengraph information from the url
 *
 * @param string $url Url address to be updated
 * @return string Response body, should be json
 */
class Facebook
{
	/**
	 * Notify facebook of a new page and force reading of
	 * open graph tags
	 */
	public static function lint ($url)
	{
		$url = filter_var($url, FILTER_SANITIZE_URL);

		// $lintUrl = 'http://developers.facebook.com/tools/lint/?url='.urlencode($url).'&format=json';
		$lintUrl = 'http://developers.facebook.com/tools/debug/og/object?q='.urlencode($url).'&format=json';
		$ch = curl_init($lintUrl);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$data = curl_exec($ch);

		curl_close($ch);

		return $data;
	}
		
}

?>
