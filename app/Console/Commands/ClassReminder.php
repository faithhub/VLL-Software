<?php

namespace App\Console\Commands;

use App\Http\Controllers\Teacher\MeetingController;
use App\Models\MasterClass;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ClassReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'class:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily reminder for class time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        function replaceObjectByProperty(&$array, $property, $value, $newObject)
        {
            foreach ($array as &$object) {
                if ($object[$property] == $value) {
                    $object = $newObject;
                    return; // Exit loop after replacing the object
                }
            }
        }

        $createZoom = new MeetingController;
        $classes = MasterClass::where('status', '!=', 'expired')->get();
        $classes_arr = [];
        foreach ($classes as $key => $class) {
            $details = $class->details;

            //Check if details is actually an array
            if (is_array($details)) {
                foreach ($details as $detail) {
                    $date = Carbon::parse($detail['date']);

                    //Check if the meeting date is today
                    if ($date->isToday()) {
                        if (empty($detail['meeting_id'])) {
                            $meeting = $createZoom->create_meeting(
                                ['title' => $class->title, 'title' => $class->title],
                                $detail['date'],
                                $class->timezone,
                                $class->time
                            );
                            $meeting_id = 90;
                            $detail['meeting_id'] = $meeting_id;
                            $newObject = ['id' => $detail['id'], 'date' => $detail['date'], 'meeting_id' => $meeting_id];
                            replaceObjectByProperty($details, 'id', $detail['id'], $newObject);
                        }
                    }
                    array_push($classes_arr, $date->isToday());
                }

                //Save dates & meeting ids
                $class->details = $details;
                $class->save();
            }
        }
        return Command::SUCCESS;
    }
}