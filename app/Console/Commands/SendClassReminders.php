<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\democlasses;
use App\Models\studentprofile;
use App\Models\tutorprofile;
use App\Services\TwilioWhatsAppService;
use Carbon\Carbon;

class SendClassReminders extends Command
{
    protected $signature = 'classes:send-reminders';
    protected $description = 'Send WhatsApp reminders 30 minutes before demo classes';

    protected $whatsApp;

    public function __construct(TwilioWhatsAppService $whatsApp)
    {
        parent::__construct();
        $this->whatsApp = $whatsApp;
    }

    public function handle()
    {
        $now = Carbon::now();

        // Target = classes starting 30 minutes from now
        $targetTime = $now->copy()->addMinutes(30);

        $classes = democlasses::where('status', 3) // confirmed
            ->whereNotNull('slot_confirmed')
            ->whereBetween('slot_confirmed', [
                $targetTime->copy()->subMinute(5), // small window
                $targetTime->copy()->addMinute(5)
            ])
            ->get();

        foreach ($classes as $class) {
            $student = studentprofile::where('student_id', $class->student_id)->first();
            $tutor   = tutorprofile::where('tutor_id', $class->slot_confirmed_by)->first();

            $meetingLink = $class->demo_link ?? "https://mychoicetutor.com/waiting-room";

            $message = "⏰ Reminder!\n\n" .
                       "Your demo class will start in 30 minutes.\n" .
                       "Subject: {$class?->subject?->name}\n" .
                       "Date/Time: " . date('d M Y h:i A', strtotime($class->slot_confirmed)) . "\n\n" .
                       "👉 Join here: {$meetingLink}";

            // Send to student
            if (!empty($student->mobile)) {
                $to = "+92" . ltrim($student->mobile, "0");
                $this->whatsApp->sendMessage($to, $message);
            }

            // Send to tutor
            if (!empty($tutor->mobile)) {
                $to = "+92" . ltrim($tutor->mobile, "0");
                $this->whatsApp->sendMessage($to, $message);
            }
        }

        $this->info("30-minute reminders sent successfully.");
    }
}
