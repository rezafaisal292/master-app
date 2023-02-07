<?php

namespace App\Providers;

use Collective\Html\FormFacade;
// use Collective\Html\HtmlFacade;

class HtmlServiceProvider extends \Collective\Html\HtmlServiceProvider
{
    
    public function boot()
    {
        FormFacade::component('fgText', 'master-component.text', ['label', 'name', 'value', 'attributes' => [], 'help' => null, 'type' => 'text', 'layout' => false]);       
        FormFacade::component('fgTextarea', 'master-component.text', ['label', 'name', 'value', 'attributes' => [], 'help' => null, 'type' => 'textarea', 'layout' => false]);
        FormFacade::component('fgPassword', 'master-component.password', ['label', 'name','value', 'attributes' => [], 'help' => null, 'type' => 'password','layout' => false]);
        FormFacade::component('fgSelect', 'master-component.select', ['label', 'name', 'options', 'value', 'attributes' => [], 'help' => null, 'layout' => false]);
        // FormFacade::component('fgOption', 'components.form.option', ['label', 'name', 'options', 'value', 'help' => null, 'type' => 'radio', 'layout' => false]);
        // FormFacade::component('fgFormButton', 'components.form.button', ['uri', 'action' => null, 'parameter' => null]);
        // FormFacade::component('fgFilterButton', 'components.form.filter', []);

    }

    protected function registerHtmlBuilder()
    {
        $this->app->singleton('html', function ($app) {
            return new \App\Services\HtmlBuilder($app['url'], $app['view']);
        });
    }

   
}
