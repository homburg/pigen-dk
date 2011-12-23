<?php

class Panel
{

	const BASENAME = '/panels/';
	const FILETYPE_IMAGE_JPEG = 'image/jpeg';

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
	 * @return 
	 */
	public static function getList ()
	{
		if (!is_array(self::$list))
		{
			$filenames = glob(Server::getDocumentRoot().self::BASENAME.'*.jpg');
			self::$list = array_map(function ($file) {
				$matches = array();
				preg_match('#\/(?<id>[^/]+)\.jpg#', $file, $matches);
				return $matches['id'];
			}, $filenames);

			sort(self::$list);
		}
		return self::$list;
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
		$panel->title = @$data['titlë́'];
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

		if (false === ($data = yaml_parse_file($dataFilename)))
		{
			Debug::log('Error parsing image data from file: "'.$dataFilename.'"');
			return false;;
		}

		if (!is_array($data) || !isset($data['caption']) || !isset($data['title']))
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

	public function getAddress ()
	{
		return $this->id;
	}

	/**
	 * @return string 
	 */
	public function getUri()
	{
		return self::BASENAME . $this->getFilename();
	}
}
