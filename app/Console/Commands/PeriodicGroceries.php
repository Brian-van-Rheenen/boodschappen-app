<?php

namespace App\Console\Commands;

use App\Groceries;
use App\Log;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PeriodicGroceries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boodschappen:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store periodic groceries into the groceries database table.';

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
     * @return mixed
     */
    public function handle()
    {
        //Get the date in Dutch
        setlocale(LC_ALL, 'nl_NL.utf8');
        $date = strtolower(Carbon::now()->formatLocalized('%A'));

        //Retrieve the schedule by date
        $schedule = Schedule::where('day', $date)->get();

        //Loop through all items
        foreach ($schedule as $data) {

            //Add properties to the form data
            $data['description'] = ucfirst($data['description']);
            $data['user'] = "Systeem";
            $data['completed'] = 0;

            //New array order
            $sort = array('id', 'user', 'description', 'quantity', 'priceWas', 'priceNow', 'completed', 'image');

            //New empty array
            $sortedArray = array();

            //Sort the array
            foreach($sort as $index) {
                $sortedArray[$index] = $data[$index];
            }

            //Find the grocery if it exists
            $grocery = Groceries::where('description', '=', $sortedArray['description'])->first();

            //If it does
            if ($grocery)
            {
                //Quantity + 1
                $grocery->quantity = $grocery->quantity + $sortedArray['quantity'];
                $grocery->image = $sortedArray['image'];
                $grocery->save();
            }
            else
            {
                //Insert the grocery into the database
                $grocery = Groceries::create($sortedArray);
            }

            //Create a history log and insert it into the database
            Log::createLog(
                $data['user'],
                ' heeft ',
                $grocery->description,
                ' toegevoegd.',
                $data['quantity'] . 'x'
            );
        }
    }
}
