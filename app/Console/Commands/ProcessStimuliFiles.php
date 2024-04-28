<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProcessStimuliFiles extends Command
{
    protected $signature = 'stimuli:process';

    protected $description = 'Process stimuli files in public/matches and public/control directories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $directory = public_path('stimuli/matches');
        $files = File::allFiles($directory);

        foreach ($files as $file) {
            $path = str_replace(public_path(), '', (string)$file);
        
            DB::table('images')->insert([
                'image_path' => $path,
                'taken' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Stimuli files processed successfully.');
    }
 
}
