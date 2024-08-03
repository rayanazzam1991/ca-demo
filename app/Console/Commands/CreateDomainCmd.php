<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateDomainCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {boundedContext}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new domain directory structure';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $boundedContext = $this->argument('boundedContext');
//        $domainName = $this->argument('domainName');
        $basePath = 'App/Core/' . $boundedContext;

        // Application
        $applicationStructure = [
            'DTO',
            'Filter',
            'Exceptions',
            'Jobs',
            'Providers',
            'Mappers',
            'Repositories',
            'UseCases',
        ];
        foreach ($applicationStructure as $applicationDirectory) {
            File::makeDirectory($basePath . '/Application/' . $applicationDirectory, 0755, true);
            touch($basePath . '/Application/' . $applicationDirectory . '/.gitkeep');
        }

        // Domain
        $domainStructure = [
            'Entities',
            'Factories',
            'Enums',
            'Events',
            'ValueObjects',
            'Services',
        ];
        foreach ($domainStructure as $domainDirectory) {
            $path = $basePath . '/Domain/' . $domainDirectory;
            File::makeDirectory($path, 0755, true);
            touch($basePath . '/Domain/' . $domainDirectory . '/.gitkeep');
        }
//        if ($domainDirectory === 'Model') {
            $stub = File::get('./stubs/DomainModel.stub');
            $stubReplace = [
                '**BoundedContext**' => $boundedContext,
            ];
            $file = strtr($stub, $stubReplace);
            File::put($basePath . '/Domain/Entities/' . $boundedContext . '.php', $file);
//            continue;
//        }

        // Infrastructure
        $infrastructureStructure = [
            'Eloquent'
        ];
        foreach ($infrastructureStructure as $infrastructureDirectory) {
            File::makeDirectory($basePath . '/Infrastructure/' . $infrastructureDirectory, 0755, true);
            touch($basePath . '/Infrastructure/' . $infrastructureDirectory . '/.gitkeep');
        }

        // Presentation
        $presentationStructure = [
            'Presenters',
            'ViewModels'
        ];
        foreach ($presentationStructure as $presentationDirectory) {
            File::makeDirectory($basePath . '/Presentation/' . $presentationDirectory, 0755, true);
            touch($basePath . '/Presentation/' . $presentationDirectory . '/.gitkeep');
        }
        echo "Bounded Context created successfully";
        return 1;
    }
}
