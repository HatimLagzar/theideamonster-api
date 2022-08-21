<?php

namespace App\Console\Commands\CreateService;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateServiceCommand extends Command
{
    public const MODEL_NAME = '__MODEL_NAME__';
    public const NAMESPACE_SEARCH = '__NAMESPACE__';
    public const NAME_OF_CLASS_SEARCH = '__NAME_OF_CLASS__';
    public const NAMESPACE_REPLACE = 'App\Services\Core\\';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service';
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name     = ucfirst(trim($this->argument('name')));
        $fullName = $name.'Service';

        $this->filesystem->ensureDirectoryExists(app_path().'/Services/Core/'.$name);

        if ( ! file_exists('../../Services/Core/'.$name.'/'.$fullName.'.php')) {
            $template = file_get_contents('create-service-class-template.txt', true);
            $template = str_replace(
                self::NAMESPACE_SEARCH,
                self::NAMESPACE_REPLACE.$name,
                $template
            );

            $template = str_replace(
                self::NAME_OF_CLASS_SEARCH,
                $fullName,
                $template
            );

            $template = str_replace(
                self::MODEL_NAME,
                $name,
                $template
            );

            $this->filesystem->put(app_path().'/Services/Core/'.$name.'/'.$fullName.'.php', $template);
        }

        return 0;
    }
}
