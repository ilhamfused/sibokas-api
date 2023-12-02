<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Semester;
use App\Models\Classroom;
use Illuminate\Console\Command;
use App\Models\BookingClassroom;
use App\Models\ClassroomSchedule;
use Illuminate\Support\Facades\DB;

class CheckClassroomScheduleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-classroom-schedule-status';

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
        // Ambil semester terakhir yang masih berjalan
        $dayOfWeek = Carbon::now()->dayOfWeek;
        $currentSemester = Semester::where('end_date', '>=', now())->latest()->first();

        if (!$currentSemester) {
            $this->info('Tidak ada semester yang sedang berjalan.');
            return;
        }

        // Ambil classroom schedules untuk semester terakhir yang masih berjalan
        $classroomSchedules = ClassroomSchedule::where([
            ['semester_id', $currentSemester->id],
            ['day_of_week', $dayOfWeek],
        ])->get();

        // Loop dan periksa jadwal serta update status classroom
        foreach ($classroomSchedules as $classroomSchedule) {
            $this->updateClassroomStatus($classroomSchedule);
        }

        $this->info('Jadwal kelas diperbarui.' . $dayOfWeek);
    }

    protected function updateClassroomStatus($classroomSchedule)
    {
        // Update status classroom ke 'in_use' jika dalam rentang waktu, dan 'free' jika tidak
        $currentTime = now();
        $startTime = Carbon::parse($classroomSchedule->start_time);
        $endTime = Carbon::parse($classroomSchedule->end_time);
        $classroomId = $classroomSchedule->classroom_id;

        // Cek apakah ada booking untuk classroom ini yang belum check-out
        $uncheckoutBooking  = BookingClassroom::where([
            ['classroom_id', $classroomId],
            ['status', 1], // status checked in
        ])->first();

        $this->info('current time' . $currentTime . 'start time' . $startTime . 'end time' . $endTime);

        if ($currentTime->between($startTime, $endTime)) {
            if ($uncheckoutBooking) {
                $uncheckoutBooking->update([
                    "time_out" => Carbon::now(),
                    "status" => 2, // status 2 (checked out)
                ]);
                return;
            }
            // Classroom sedang digunakan
            Classroom::where('id', $classroomSchedule->classroom_id)->update(['status' => 2]);
        } else {
            if ($uncheckoutBooking) {
                return;
            }
            // Classroom tidak digunakan
            Classroom::where('id', $classroomSchedule->classroom_id)->update(['status' => 1]);
        }
    }
}
