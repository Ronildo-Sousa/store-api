<?php

namespace App\Console\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;

class MakeActionCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    protected $name = 'make:action';

    protected $description = 'Create a new Action';

    protected $type = 'action';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/action.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Actions';
    }
}
