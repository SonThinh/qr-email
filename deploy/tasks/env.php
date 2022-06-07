<?php

namespace Deployer;

require 'recipe/laravel.php';

task('deploy:env', function () {
    upload('deploy/env/.env.{{stage}}', '{{deploy_path}}/shared/.env');
    writeln('Update .env.{{stage}} success!');
});