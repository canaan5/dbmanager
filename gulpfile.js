const elixir = require('laravel-elixir');

require('elixir-typescript');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       // .webpack('app.js')
       .copy('node_modules/@angular', 'public/@angular')
        .copy('node_modules/core-js', 'public/core-js')
        .copy('node_modules/reflect-metadata', 'public/reflect-metadata')
        .copy('node_modules/systemjs', 'public/systemjs')
        .copy('node_modules/rxjs', 'public/rxjs')
        .copy('node_modules/zone.js', 'public/zone.js')

        .typescript(
            'app/**/**.ts',
            'public/app',
            {
                "target": "es5",
                "module": "system",
                "moduleResolution": "node",
                "sourceMap": true,
                "emitDecoratorMetadata": true,
                "experimentalDecorators": true,
                "removeComments": false,
                "noImplicitAny": false
            }
        )
        .typescript(
        'admin/**/**.ts',
        'public/admin/app',
        {
            "target": "es5",
            "module": "system",
            "moduleResolution": "node",
            "sourceMap": true,
            "emitDecoratorMetadata": true,
            "experimentalDecorators": true,
            "removeComments": false,
            "noImplicitAny": false
        }
    );

});
