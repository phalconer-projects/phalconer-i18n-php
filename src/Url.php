<?php

namespace phalconer\i18n;

class Url extends \Phalcon\Mvc\Url
{
    public function get($uri = NULL, $args = NULL, $local = true)
    {
        if ($local && is_string($uri)) {
            $uriParts = array_values(
                array_filter(
                    explode('/', $uri),
                    function($value) { return !empty($value); }
                )
            );
            $uriFirstPart = empty($uriParts) ? '' : $uriParts[0];
            
            if (!in_array($uriFirstPart, $this->getDI()->get('translator')->getSupportedLanguages())) {
                if (!$this->getDI()->has('language')) {
                    $this->getDI()->get('translator')->setupLanguage();
                }
                $language = $this->getDI()->get('language');
                if (!empty($language)) {
                    if ($uri === '' || $uri === '/') {
                        $uri .= $language;
                    } else {
                        $uri = substr($uri, 0, 1) === '/' ? '/' . $language . $uri : $language . '/' . $uri;
                    }
                }
            }
        }
        return parent::get($uri, $args, $local);
    }
}
