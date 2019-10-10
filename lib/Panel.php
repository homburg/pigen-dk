<?php

use \Symfony\Component\Yaml\Parser;
use \Symfony\Component\Yaml\Exception\ParseException;

class Panel
{

	const BASENAME = '/panels/';
	const BASENAME_MOBILE = '/panels/m/';
	const FILETYPE_IMAGE_JPEG = 'image/jpeg';

	const ORDER_ASC = 'asc';
	const ORDER_DESC = 'desc';

	const MODE_DESKTOP = 1;
	const MODE_MOBILE = 2;

	/**
	 * @var string $id Unique name, matches (part of) filename
	 */
	protected $id;
	protected $filetype = 'image/jpeg';

	protected $caption = '';
	protected $title = '';

	protected $nextPanel;
	protected $prevPanel;

	protected static $list;
	protected static $descList;
	protected static $panels;

	/**
	 * @param string $id
	 */
	private function __construct ($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get title
	 *
	 * @return string $title
	 */
	public function getTitle ($includeSiteName = false)
	{
		if ('' == $this->title)
			return "Pigen uden ordforråd";
		else
			$str = $this->title;

		if ($includeSiteName)
			return $str . " - Pigen uden ordforråd";
		else
			return $str;
	}

	/**
	 * Get thumbnail url
	 *
	 * @return string Thumnail url
	 */
	public function getThumbnailUri ()
	{
		return self::BASENAME.'thumbnails/'.$this->getId().'.jpg';
	}

	/**
	 * @param self::ORDER_* $order
	 * @return int[]
	 */
	public static function getList ($order = self::ORDER_ASC)
	{
		if (!is_array(self::$list))
		{
			$filenames = glob(Server::getDocumentRoot().self::BASENAME.'*.jpg');
			self::$list = array_map(function ($file) {
				$matches = array();
				preg_match('#\/(?<id>[^/]+)\.jpg#', $file, $matches);
				return $matches['id'];
			}, $filenames);

			natcasesort(self::$list);
		}

		if ($order === self::ORDER_DESC)
		{
			if (!is_array(self::$descList))
				self::$descList = array_reverse(self::$list);

			return self::$descList;
		}
		else
			return self::$list;
	}

	/**
	 * Get all panels or an interval
	 *
	 * @param int $start Index of first panel
	 * @param int $end Number of panels
	 * @param self::ORDER_* $asc Order
	 */
	public static function getAll($start = 0, $number = 0, $order = self::ORDER_ASC)
	{
		$panelIds = self::getList($order);
		if ($number > 0)
			$panelIds = array_slice($panelIds, $start, $number);
		else
			$panelIds = $panelIds;

		return array_map(function ($item) {
				return Panel::getById($item);
		}, $panelIds);
	}

	/**
	 * @return 
	 */
	private function getAdjacent ()
	{
		if ($this->nextPanel === null)
		{
			self::getList();
			$thisIndex = array_search($this->id, self::$list);
			if ($thisIndex === 0)
				$this->prevPanel = false;
			else
				$this->prevPanel = self::getById(self::$list[$thisIndex-1]);

			$nextIndex = $thisIndex+1;
			if (!isset(self::$list[$nextIndex]))
				$this->nextPanel = false;
			else
				$this->nextPanel = self::getById(self::$list[$nextIndex]);
		}
	}

	/**
	 * Get next panel
	 *
	 * @return Panel|false
	 */
	public function getNext ()
	{
		$this->getAdjacent();
		return $this->nextPanel;
	}

	/**
	 * Get previous panel
	 *
	 * @return Panel|false
	 */
	public function getPrevious ()
	{
		$this->getAdjacent();
		return $this->prevPanel;
	}

	/**
	 * Get newest panel
	 *
	 * @return Panel
	 */
	public static function getNewest ()
	{
		$list = self::getList();
		return self::getById($list[count($list)-1]);
	}

	/**
	 * @return Panel|false
	 */
	public static function getById ($id)
	{
		$panel = new Panel($id);
		$filename = Server::getDocumentRoot().$panel->getUri();
		if (!is_file($filename))
		{
			Debug::log('No image with id: '.$id);
			return false;
		}

		$data = $panel->getData();
		$panel->caption = @$data['caption'];
		$panel->title = @$data['title'];
		return $panel;
	}

	/**
	 * @return array('caption' => 'fisk', 'title' => 'fugl')|false
	 */
	private function getData()
	{

		$dataFilename = Server::getDocumentRoot().self::BASENAME.$this->getId().'.yaml';
		if (!is_file($dataFilename))
			return false;

		$yaml = new Parser();

		try {
			$fileData = file_get_contents($dataFilename);
			$fileData = str_replace("\xEF\xBB\xBF", "", $fileData);
			$data = $yaml->parse($fileData);
		} catch (ParseException $pe) {
			Debug::log(sprintf(
				'Error parsing image data from file: "%s": %s',
				$dataFilename,
				$pe->getMessage()
			));
			return false;;
		}

		if (!is_array($data))
		{
			Debug::log($data, 'Invalid image data');
			return false;
		}

		return $data;
	}

	/**
	 * @param bool $includePeriod Include period before extension
	 * @return Get filename extension, depends on filetype
	 */
	public function getExtension ($includePeriod = true)
	{
		if ($this->filetype !== self::FILETYPE_IMAGE_JPEG)
			throw new Exception('Invalid filetype!');
		return ($includePeriod ? '.':'').'jpg';
	}

	/**
	 * @return string filena
	 */
	public function getFilename ()
	{
		return $this->id . $this->getExtension();
	}

	public function getAddress ($full = true, $domainType = Web::DOMAIN_TYPE_AUTO)
	{
		if (!$full)
			return '/'.$this->id;
		else
			return 'https://'.Web::getDomain($domainType).'/'.$this->id;
	}

	/**
	 * @return string 
	 */
	public function getUri($full = false, $domainType = Web::DOMAIN_TYPE_AUTO)
	{
		if (!$full)
			return self::BASENAME . $this->getFilename();
		else
			return 'https://'.Web::getDomain($domainType).self::BASENAME.$this->getFilename();
	}

	public function getMobileUri ($full = false)
	{
		if (!$full)
			return self::BASENAME_MOBILE . $this->getFilename();
		else
			return 'https://'.Web::getDomain().self::BASENAME_MOBILE.$this->getFilename();
	}
}
