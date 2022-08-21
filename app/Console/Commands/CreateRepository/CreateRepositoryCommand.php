<?php

namespace App\Console\Commands\CreateRepository;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateRepositoryCommand extends Command
{
    public const NAMESPACE_SEARCH = '__NAMESPACE__';
    public const NAME_OF_CLASS_SEARCH = '__NAME_OF_CLASS__';
    public const NAMESPACE_REPLACE = 'App\Repositories\\';
    public const MODEL_NAME = '__MODEL_NAME__';

    protected $signature = 'make:repository {name}';

    protected $description = 'Create a repository';

    private Filesystem $filesystem;

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
        $fullName = $name.'Repository';

        $this->filesystem->ensureDirectoryExists(app_path().'/Repositories/'.$name);

        if ( ! file_exists('../../Repositories/'.$name.'/'.$fullName.'.php')) {
            $template = file_get_contents('create-repository-class-template.txt', true);
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

            $this->filesystem->put(app_path().'/Repositories/'.$name.'/'.$fullName.'.php', $template);
        }

        return 0;
    }
}
