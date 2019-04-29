<?php

namespace ic\Plugin\FeedImages;

use ic\Framework\Plugin\Plugin;

/**
 * Class FeedImages
 *
 * @package ic\Plugin\FeedImages
 */
class FeedImages extends Plugin
{

	public const ALL = 'all';

	public const ENCLOSURE = 'enclosure';

	public const MEDIA = 'media';

	/**
	 * @inheritdoc
	 */
	protected function configure(): void
	{
		parent::configure();

		$this->setOptions([
			'type' => self::ALL,
			'size' => 'thumbnail',
		]);
	}

}