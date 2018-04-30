<?php

namespace ic\Plugin\FeedImages;

use ic\Framework\Plugin\PluginClass;
use ic\Framework\Settings\Form\Section;
use ic\Framework\Settings\Form\Tab;
use ic\Framework\Settings\Settings;

/**
 * Class Backend
 *
 * @package ic\Plugin\FeedImages
 */
class Backend extends PluginClass
{

	/**
	 * @inheritdoc
	 *
	 * @throws \RuntimeException
	 * @throws \InvalidArgumentException
	 */
	protected function initialize(): void
	{
		Settings::siteOptions($this->id(), $this->getOptions(), $this->name())
		        ->addTab(null, function (Tab $tab) {
			        $tab->addSection(null, function (Section $section) {
				        $section->title(__('Choose how to embed the images in the feeds', $this->id()))
				                ->choices('type', __('Element used', $this->id()), [], [
					                FeedImages::ALL       => __('<enclosure> and <media:content>', $this->id()),
					                FeedImages::ENCLOSURE => __('<enclosure>', $this->id()),
					                FeedImages::MEDIA     => __('<media:content>', $this->id()),
				                ])
				                ->image_sizes('size', __('Image size', $this->id()));
			        });
		        });
	}

}