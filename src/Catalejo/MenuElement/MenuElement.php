<?php namespace Catalejo\MenuElement;

use Config, Route;


class MenuElement {

    protected $view;
    protected $route;
    protected static $instance;


    public function make($path, $text, $args)
    {
        $classElement = Config::get('menuelement::classElement');
        $classCurrentElement = $this->createClassCurrentElement($path);
        $icon = $this->buildIcon($args);
        $url = route($path);
        $element = $this->createElement();

        $replace = [
            '{{CLASSELEMENT}}' => "{$classElement} {$classCurrentElement}",
            '{{URL}}' => $url,
            '{{ICON}}' => $icon,
            '{{TEXT}}' => $text,
        ];

        return str_replace(array_keys($replace), array_values($replace), $element );
    }

    public function createClassCurrentElement($path)
    {
        if(Route::currentRouteName() == $path)
        {
            return Config::get('menuelement::currentElement');
        }

        return null;
    }

    /**
     * @param $args
     * @return null|string
     */
    public function createIcon($args)
    {
        $icon = array_get($args, 'icon');

        if( isset($icon))
        {
            $classIcon = Config::get('menuelement::classIcon');
            $wrapper = Config::get('menuelement::wrapperIcon');

            return '<' . $wrapper . ' class="' . $classIcon . ' ' . $icon . '" aria-hidden="true"></' . $wrapper . '>';
        }

        return null;
    }


    public function createElement()
    {
        $wrapper = Config::get('menuelement::wapper');

        return '<' . $wrapper . ' class="{{CLASSELEMENT}}"><a href="{{URL}}">{{ICON}}{{TEXT}}</a></' . $wrapper . '>';
    }


    /////////////////////
    /**
     * Handle dynamic method calls
     *
     * @param $path
     * @param $text
     * @param array $args
     * @return
     * @internal param string $name
     */
    public static function __callStatic($path, $text, $args)
    {
        $args = empty($args) ? [] : $args[0];
        $instance = static::$instance;
        if ( ! $instance) $instance = static::$instance = new static;
        return $instance->make($path, $text, $args);
    }

}