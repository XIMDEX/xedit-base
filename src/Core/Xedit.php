<?php

namespace Xedit\Base\Core;

use Xedit\Base\Interfaces\Models\IXeditContainer;
use Xedit\Base\Interfaces\Models\IXeditLayout;
use Xedit\Base\Interfaces\Models\IXedit;

class Xedit
{

    /**
     * Get content for Xedit node
     *
     * @param IXedit $doc
     * @return array
     */
    public static function getContentByNode(IXedit $doc)
    {
        return static::getNodes($doc->getContainer(), [], true);
    }

    /**
     * Get nodes for Xedit content
     *
     * @param IXeditContainer $doc
     * @param array $nodes
     * @param bool $isCurrentNode
     * @return array
     */
    public static function getNodes(IXeditContainer $doc, array $nodes = [], bool $isCurrentNode = false)
    {
        $layout = $doc->getLayout();
        $schemaLayout = json_decode($layout->getContent(), true);

        // Process layout
        if (isset($schemaLayout['template'])) {
            foreach ($schemaLayout['template'] as $template) {
                if (strcmp(key($template), IXeditLayout::CONTENT_DOCUMENT) == 0) {
                    $data = static::getNodeData($layout, $doc, $template[key($template)], $schemaLayout, $isCurrentNode);
                    $nodes['xe_' . $data['id']] = $data;
                } else {
                    $include = $layout->getIncludeContainer($template[key($template)]);
                    if (!is_null($include)) {
                        $nodes = static::getNodes($include, $nodes);
                    } else {
                        $nodes['not_found_' . count($nodes)] = [
                            'title' => key($template),
                            'content' => '<div></div>'
                        ];
                    }
                }
            }
        }
        return $nodes;
    }


    public static function getNodeData(IXeditLayout $layout, IXeditContainer $doc, $sections, $schemaLayout, $isCurrentNode)
    {

        $schemas = [];
        $content = '';

        $extraData = [
            'css' => isset($schemaLayout['css']) ? $schemaLayout['css'] : [],
            'js' => isset($schemaLayout['js']) ? $schemaLayout['js'] : []
        ];

        // First get all main schemas
        foreach ($sections as $section => $data) {
            $schemas[$section] = static::getSchemaFromComponent($layout, $section, $data, $extraData);
            if (isset($schemas[$section]) && $schemas[$section]['view'] != null) {
                $content .= $schemas[$section]['view'];
            } else {
                $content .= '<div></div>';
            }
        }

        // Last get dependent schemas
        foreach ($schemas as $section => $data) {
            if (isset($data['sections'])) {
                $schemas = static::getChildSchemasBySections($layout, $schemas, $data['sections'], $extraData);
            }
        }


        if (!is_null($doc) && $doc->getContent()) {
            $content = $doc->getContent();
        }

        // Properties
        $properties = [
            'id' => $doc->getId(),
            'type' => $isCurrentNode ? IXeditLayout::CONTENT_DOCUMENT : IXeditLayout::INCLUDE_DOCUMENT,
            'content' => !is_null($content) ? $content : '',
            'title' => $doc->getTitle(),
            'schema' => $schemas,
            'attributes' => [],
            'css' => array_unique($extraData['css']),
            'js' => array_unique($extraData['js']),
            'editable' => $isCurrentNode

        ];

        return $properties;
    }

    /**
     * Get the html document from Xedit node
     *
     * @param IXedit $doc
     * @return string
     */
    public static function getDocument(IXedit $doc): string
    {
        $nodes = static::getContentByNode($doc);

        $document = "";
        foreach ($nodes as $key => $value) {
            $document .= $value['content'] . "\n";
        }

        return $document;
    }
    /******************************************** AUX METHODS ********************************************/

    /**
     *
     * @param IXeditLayout $layout
     * @param $schemas
     * @param $sections
     * @param $extraData array
     *
     * @return array
     */
    private static function getChildSchemasBySections(IXeditLayout $layout, $schemas, $sections, &$extraData)
    {
        foreach ($sections as $section => $data) {
            if (!array_key_exists($section, $schemas)) {
                $schemas = static::getChildSchemasBySection($layout, $section, $data, $schemas, $extraData);
            }
        }
        return $schemas;
    }

    /**
     *
     * @param IXeditLayout $layout
     * @param $section string
     * @param $schemas array
     * @param $data array
     * @param $extraData array
     *
     * @return array
     */
    private static function getChildSchemasBySection(IXeditLayout $layout, $section, $data, $schemas, &$extraData): array
    {
        $schema = static::getSchemaFromComponent($layout, $section, $data, $extraData);
        if ($schema != null) {
            $schemas[$section] = $schema;
            if (array_key_exists('sections', $schemas[$section])) {
                $schemas = static::getChildSchemasBySections($layout, $schemas, $schemas[$section]['sections'], $extraData);
            }
        }
        return $schemas;
    }


    /**
     *
     * @param IXeditLayout $layout
     * @param $compName
     * @param $data
     * @param $extraData
     * @return array|null
     */
    private static function getSchemaFromComponent(IXeditLayout $layout, $compName, $data, &$extraData)
    {
        $schema = null;
        $comp = $layout->getComponent($compName);

        if ($comp && $comp->getContent()) {

            $jsonComp = json_decode($comp->getContent(), true);

            $schema = array_merge($jsonComp['schema'], $data);
            $schema['name'] = $compName;
            $view = $comp->getView();

            if ($view && $view->getContent()) {
                $schema['view'] = $view->getContent();
            } else {
                $schema['view'] = '';
            }

            $extraData['css'] = isset($jsonComp['css']) ? array_merge($extraData['css'], $jsonComp['css']) : $extraData['css'];
            $extraData['js'] = isset($jsonComp['js']) ? array_merge($extraData['js'], $jsonComp['js']) : $extraData['js'];
        }
        return $schema;
    }
}