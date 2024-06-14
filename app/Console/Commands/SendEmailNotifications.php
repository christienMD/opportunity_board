<?php

namespace App\Console\Commands;

use App\Models\Opportunity;
use App\Models\User;
use App\Notifications\OpportunityEmailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendEmailNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Email Notifications to all subscribed students when an opportunity is published';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch the most recently published opportunity
        $opportunity = Opportunity::whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->first();

        if (!$opportunity) {
            $this->info('No new opportunities found.');
            return;
        }

        // Output details of the opportunity
        $this->info('New opportunity details:');
        $this->table(
            ['Title', 'Description', 'Category', 'Closing Date', 'Published At'],
            [[$opportunity->title, $opportunity->description, $opportunity->category, $opportunity->closing_date, $opportunity->published_at]]
        );

        // Fetch students who are registered under the opportunity's category
        $students = User::where('category', $opportunity->category)->get();

        if ($students->isEmpty()) {
            $this->info('No students registered under the category.');
            return;
        }

        // Output details of the students
        $this->info('Students registered under the category:');
        $studentDetails = $students->map(function ($student) {
            return [
                'Name' => $student->name,
                'Email' => $student->email,
            ];
        })->toArray();

        $this->table(
            ['Name', 'Email'],
            $studentDetails
        );

        // Notify each student
        $students->each(function ($student) use ($opportunity) {

            try {
                $student->notify(new OpportunityEmailNotification($opportunity));
                $this->info('Notification sent to: ' . $student->email);
            } catch (\Exception $e) {
                Log::error('Failed to send notification to ' . $student->email . ': ' . $e->getMessage());
                $this->error('Failed to send notification to: ' . $student->email);
            }
        });


        $this->info('Email Noifications sent successfully!');
    }
}

