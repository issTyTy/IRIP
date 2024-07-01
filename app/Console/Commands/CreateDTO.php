<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDTO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DTO class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $directory = app_path("/DTO/$name.php");

        if (file_exists($directory)) {
            $this->error("DTO class already exists");
            return;
        }

        $content = <<<PHP
<?php

namespace App\DTO;

class $name
{
    public function __construct()
    {
        // Constructor implementation
    }
}

PHP;

        file_put_contents($directory, $content);
        $this->info('New DTO has been created');
    }
}
