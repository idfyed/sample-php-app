<?php
/**
 * Copyright 2017 (C) Diglias AB
 *
 * Immutable class that wraps the Handlebars engine and configuration.
 *
 * @author jonas
 */

namespace sample;

use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;

class Template
{

    /**
     * Constructs a template a and configures the Handlebars engine.
     *
     * @param $templateName name of the template to render when the render method is called
     */
    function __construct($templateName)
    {
        $templateDir = dirname(dirname(dirname(__FILE__))) . '/resources';

        $this->engine = new Handlebars(array(
            'loader' => new FilesystemLoader($templateDir, array(
                'extension' => 'hbs'
            )),
            'partials_loader' => new FilesystemLoader(
                $templateDir . '/partials', array(
                    'extension' => 'hbs'
                )
            )
        ));

        $this->name = $templateName;
    }

    /**
     * Renders the template and returns the rendered result.
     *
     * @param $data Input data to inject into the template
     * @return string
     */
    function render($data)
    {
        return $this->engine->render($this->name, $data);
    }

    private $engine;
    private $name;
}
