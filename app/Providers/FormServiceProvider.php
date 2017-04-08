<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the form components
        Form::component('formInput', 'components.form.input',
            ['labelText', 'name', 'value' => null, 'attributes' => []]);

        Form::component('formCheckbox', 'components.form.checkbox',
            ['labelText', 'name', 'value' => false, 'attributes' => []]);

        Form::component('formSelect', 'components.form.select',
            ['labelText', 'name', 'options' => [], 'selectedValue' => null, 'attributes' => []]);

        Form::component('formPassword', 'components.form.password',
            ['labelText', 'name', 'value' => null, 'attributes' => []]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
