<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud
    {nameOfTheClass? : the name of class.},
    {nameOfTheModelClass? : the name of model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a custom livewire CRUD';

    //our custom class properties here
    protected $nameOfTheClass;
    protected $nameOfTheModelClass;
    protected $file;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //gathers all parameters
        $this->gatherParameters();

        //generate the livewire class file
        $this->generateLivewireCrudClassfile();

        //generates livewire view file
        $this->generateLivewireCrudViewFile();
    }

    protected function gatherParameters()
    {
        $this->nameOfTheClass = $this->argument('nameOfTheClass');
        $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');

        //if you didn't put name of the class
        if(!$this->nameOfTheClass){
            $this->nameOfTheClass = $this->ask('Enter class name');
        }

        if(!$this->nameOfTheModelClass){
            $this->nameOfTheModelClass = $this->ask('Enter model class name');
        }

        //convert to studly case
        $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
        $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);
    }

    protected function generateLivewireCrudClassfile()
    {
        //set the origin & destination class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/' . $this->nameOfTheClass . '.php');

        if ($this->file->exists($fileDestination)){
            $this->info('This class file already exists :'.$this->nameOfTheClass . '.php');
            return false;
        }

        //get the original string content of the file
        $fileOriginalString = $this->file->get($fileOrigin);

        //replace the strings specified in the array sequencialy
        $replaceFileOriginalString = Str::replaceArray('{{}}',
            [
                $this->nameOfTheModelClass, //name model class
                $this->nameOfTheClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                Str::kebab($this->nameOfTheClass), //from "Foobar" to "foo-bar"
                
            ],
            $fileOriginalString
        );

        //put content into the destination directory
        $this->file->put($fileDestination, $replaceFileOriginalString);
        $this->info('Livewire class file created: '. $fileDestination);
    }

    protected function generateLivewireCrudViewFile()
    {
        //set the origin & destination class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOfTheClass) . '.blade.php');

        if ($this->file->exists($fileDestination)){
            $this->info('This view file already exists :'.Str::kebab($this->nameOfTheClass) . '.blade.php');
            return false;
        }

        //copy file to destination
        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('Livewire view file created: '. $fileDestination);
    }
}
