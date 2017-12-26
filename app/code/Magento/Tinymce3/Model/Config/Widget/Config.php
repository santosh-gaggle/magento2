<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Tinymce3\Model\Config\Widget;

/**
 * Class Config adds widget plugin information required for tinymce3 editor
 */
class Config implements \Magento\Config\Model\Wysiwyg\ConfigInterface
{
    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepo;

    /**
     * @var \Magento\Widget\Model\Widget\Config
     */
    private $widgetConfig;

    /**
     * Config constructor.
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param \Magento\Widget\Model\Widget\Config $widgetConfig
     * @param array $widgetPlaceholders
     */
    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Widget\Model\Widget\Config $widgetConfig,
        array $widgetPlaceholders = []
    ) {
        $this->assetRepo = $assetRepo;
        $this->widgetConfig = $widgetConfig;
        $this->widgetPlaceholders = $widgetPlaceholders;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig($config)
    {
        return [
            'widget_plugin_src' => $this->getWysiwygJsPluginSrc(),
            'widget_window_url' => $this->widgetConfig->getWidgetWindowUrl($config),
            'widget_types' => $this->widgetConfig->getAvailableWidgets($config),
            'widget_error_image_url' => $this->widgetConfig->getErrorImageUrl(),
            'widget_placeholders' => $this->widgetConfig->getWidgetPlaceholderImageUrls()
        ];
    }

    /**
     * Return path to tinymce3 widget plugin
     *
     * @return string
     */
    private function getWysiwygJsPluginSrc()
    {
        $editorPluginJs = 'Magento_Tinymce3::tiny_mce/plugins/magentowidget/editor_plugin.js';
        $result = $this->assetRepo->getUrl($editorPluginJs);
        return $result;
    }
}
