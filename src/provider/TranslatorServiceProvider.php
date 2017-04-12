<?php

namespace phalconer\i18n\provider;

use phalconer\i18n\translation\Translator;
use phalconer\common\provider\AbstractServiceProvider;

class TranslatorServiceProvider extends AbstractServiceProvider
{
    /**
     * @var string
     */
    protected $serviceName = 'translator';
    
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $config = $this->config;

        $this->di->setShared(
            $this->serviceName,
            function() use($config) {
                $class = $config->get('class', Translator::class);
                return new $class($this, $config);
            }
        );
    }
}