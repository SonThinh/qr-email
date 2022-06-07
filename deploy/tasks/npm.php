<?php

namespace Deployer;

require 'recipe/laravel.php';

task('npm:build', function () {
    if (has('previous_release')) {
        if (test('[ -d "{{previous_release}}/node_modules" ]')) {
            run('cp -R {{previous_release}}/node_modules {{release_path}}');
        }else{
            run('cd {{release_path}} && npm install');
        }
    }else{
        run('cd {{release_path}} && npm install');
    }

    run('cd {{release_path}} && npm run prod');
});