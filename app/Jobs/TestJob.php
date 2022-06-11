<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\CommonMail;
use Mail;

use App\Models\AcademicYear;
use Str;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $email = new CommonMail();
        // Mail::to('udhay.g@texila.org')->send($email);
        
        
        // $max = AcademicYear::max('title') ?? 2000;
        // AcademicYear::create([
        //     'title' => $max+1,
        //     'uuid' => (string) Str::uuid(),
        //     'active' => 1,
        // ]);
    }
}
