<?php
namespace Deployer;


require 'deploy/tasks/laravel.php';
require 'deploy/utils.php';

// Project name
set('application', 'qr-email');

// Project repository
set('repository', 'git@github.com:SonThinh/qr-email.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Set keep releases
set('keep_releases', 3);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
inventory('hosts.yml');

// Tasks
require_all('deploy/tasks/*.php');


// Migrate database before symlink new release
before('deploy:symlink', 'artisan:migrate');

after('deploy:update_code', 'deploy:env');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

