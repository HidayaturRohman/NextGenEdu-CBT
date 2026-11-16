<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class TestAlumni extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'test:alumni';
    protected $description = 'Test Dataalumni controller methods';

    public function run(array $params)
    {
        CLI::write("Testing Dataalumni...", 'green');

        // Simulate session
        $session = session();
        $session->set([
            'is_login'  => true,
            'id_user'   => 1,
            'username'  => 'admin',
            'role'      => '1',
            'role_name' => 'Administrator'
        ]);

        $controller = new \App\Controllers\Dataalumni();
        $controller->initController(service('request'), service('response'), service('logger'));

        // Test index()
        try {
            $viewContent = $controller->index();
            CLI::write("index() rendered successfully! Length: " . strlen($viewContent), 'cyan');
        } catch (\Throwable $e) {
            CLI::error("index() error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine());
            return;
        }

        CLI::write("SUCCESS! Dataalumni works perfectly without errors.", 'green');
    }
}
