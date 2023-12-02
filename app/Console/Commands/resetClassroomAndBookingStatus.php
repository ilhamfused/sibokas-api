<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Classroom;
use Illuminate\Console\Command;
use App\Models\BookingClassroom;

class resetClassroomAndBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-classroom-and-booking-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookingClassroomToday = BookingClassroom::whereDate('created_at', today())->get();
        $classroom = Classroom::where('status', 2)->get();

        foreach ($bookingClassroomToday as $booking) {
            $booking->update([
                "time_out" => Carbon::now(),
                "status" => 2
            ]);
        }

        foreach ($classroom as $room) {
            $room->update(["status" => 1]);
        }
    }
}
