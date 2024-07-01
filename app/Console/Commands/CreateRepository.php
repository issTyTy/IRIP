<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository  and interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $directory = app_path("Repository/$name.php");

        if (file_exists($directory)) {
            $this->error("Repository already exists!");
            return null;
        }

        $interface = 'I' . $name;
        $interfaceDirectory = app_path("Repository/Interfaces/$interface.php");

        $content = <<<PHP
<?php

namespace App\Repository;

use App\Repository\Interfaces\\$interface;

class $name implements $interface
{

}

PHP;

        $interfaceContent = <<<PHP
<?php

namespace App\Repository\Interfaces;

interface $interface
{

}

PHP;

        if (!is_dir(app_path('Repository'))) {
            mkdir(app_path('Repository'));
        }

        if (!is_dir(app_path('Repository/Interfaces'))) {
            mkdir(app_path('Repository/Interfaces'));
        }

        file_put_contents($directory, $content);
        file_put_contents($interfaceDirectory, $interfaceContent);

        $this->info("New Repository is created!");
    }
}
