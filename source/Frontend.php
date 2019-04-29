<?php

namespace ic\Plugin\FeedImages;

use ic\Framework\Plugin\PluginClass;

/**
 * Class Frontend
 *
 * @package ic\Plugin\FeedImages
 */
class Frontend extends PluginClass
{

	/**
	 * @inheritdoc
	 */
	protected function configure(): void
	{
		parent::configure();

		$this->hook()
		     ->on('rss2_item', 'addEnclosure')
		     ->on('rss2_ns', 'addMediaNS')
		     ->on('rss2_item', 'addMediaImage');
	}

	/**
	 * Adds the image as a <enclosure> element.
	 */
	public function addEnclosure(): void
	{
		if (!in_array($this->getOption('type'), [
			FeedImages::ALL,
			FeedImages::ENCLOSURE,
		], true)) {
			return;
		}

		if (!($image = $this->getImage())) {
			return;
		}

		printf('	<enclosure url="%s" length="%s" type="%s" />', $image['url'], $image['size'], $image['mime']);
	}

	/**
	 * Adds the namespace for the media RSS.
	 */
	public function addMediaNS(): void
	{
		echo '  xmlns:media="http://search.yahoo.com/mrss/"';
	}

	/**
	 * Adds the image as a <media:content> element.
	 */
	public function addMediaImage(): void
	{
		if (!in_array($this->getOption('type'), [
			FeedImages::ALL,
			FeedImages::MEDIA,
		], true)) {
			return;
		}

		if (!($image = $this->getImage())) {
			return;
		}

		printf('	<media:content url="%s" fileSize="%s" type="%s" medium="image" width="%s" height="%s" />', $image['url'], $image['size'], $image['mime'], $image['width'], $image['height']);
	}

	/**
	 * Gets the featured image.
	 *
	 * @return null|array {
	 * @type string $file
	 * @type int    $width
	 * @type int    $height
	 * @type string $path
	 * @type string $url
	 * @type string $mime
	 * @type int    $size
	 * }
	 */
	protected function getImage(): ?array
	{
		if (!has_post_thumbnail()) {
			return null;
		}

		$id    = get_post_thumbnail_id(get_the_ID());
		$image = image_get_intermediate_size($id, $this->getOption('size'));

		if (empty($image)) {
			return null;
		}

		$uploads = wp_upload_dir();

		$image['mime'] = get_post_mime_type($id);
		$image['size'] = filesize(path_join($uploads['basedir'], $image['path']));

		return $image;
	}

}