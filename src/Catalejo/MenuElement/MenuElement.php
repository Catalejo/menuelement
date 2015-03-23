<?php namespace Catalejo\MenuElement;

use Config, Route;


class MenuElement {

    /**
     * Creador del elemento que se entregará como resultado
     *
     * @param $path Nombre de la ruta
     * @param $text Texto que se mostrará
     * @param $args Configuraciones extras
     * @return string
     */
    public function make($path, $text, $args = [])
    {
        $classElement = config('menuelement.classElement');
        $classCurrentElement = self::createClassCurrentElement($path);
        $icon = self::createIcon($args);
        $url = route($path);
        $element = self::createElement();

        $replace = [
            '{{CLASSELEMENT}}' => trim("{$classElement} {$classCurrentElement}"),
            '{{URL}}' => $url,
            '{{ICON}}' => $icon,
            '{{TEXT}}' => $text,
        ];

        return str_replace(array_keys($replace), array_values($replace), $element );
    }

    /**
     * Creador de la clase de CSS que indica que estamos en el actual elemento
     *
     * @param $path
     * @return Config|null
     */
    public static function createClassCurrentElement($path)
    {
        if(Route::currentRouteName() == $path)
        {
            return config('menuelement.classCurrentElement');
        }

        return null;
    }

    /**
     * Creador de toda la etiqueta correspondiente al dibujado del icono
     *
     * @param $args
     * @return null|string
     */
    public static function createIcon($args)
    {
        $icon = array_get($args, 'icon');

        if( isset($icon))
        {
            $classIcon = config('menuelement.classIcon');
            $wrapper = config('menuelement.wrapperIcon');

            return '<' . $wrapper . ' class="' . $classIcon . ' ' . $icon . '" aria-hidden="true"></' . $wrapper . '>';
        }

        return null;
    }


    /**
     * Creador del template del elemento, solamente dejando expresadas las variables que después se reemplazarán
     *
     * @return string
     */
    public static function createElement()
    {
        $wrapper = config('menuelement.wrapper');

        return '<' . $wrapper . ' class="{{CLASSELEMENT}}"><a href="{{URL}}">{{ICON}}{{TEXT}}</a></' . $wrapper . '>';
    }

}