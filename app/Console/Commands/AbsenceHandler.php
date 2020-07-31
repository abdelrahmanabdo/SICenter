<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Lesson ;

class AbsenceHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:absence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Cron hanndle Student lesson absence';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $lessons = Lesson::whereOnline(1)->get();
        foreach($lessons as $lesson){
            $now    = Carbon::now();
            $isAfter = $now->greaterThan($lesson->start_time);
            if($isAfter){
                $lesson->update(['online' => 0]);
            }
        }
        return true;
    }
}
