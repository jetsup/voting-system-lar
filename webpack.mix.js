let mix = require("laravel-mix");

mix.js("node_modules/bootstrap/dist/js/bootstrap.min.js", "public/js/bootstrap.min.js")
    .postCss("node_modules/bootstrap/dist/css/bootstrap.css", "public/css/bootstrap.css")
    .postCss("node_modules/bootstrap/dist/css/bootstrap.min.css", "public/css");

mix.css("node_modules/bootstrap/dist/css/bootstrap.css", "public/css");