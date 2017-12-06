<?php

namespace App\Console\Commands;

use App\Groceries;
use App\PopularItem;
use Illuminate\Console\Command;

class CheckPrice extends Command
{
    private $priceNow;
    private $priceWas;
    private $discount;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boodschappen:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the prices of each grocery.';

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
        //Retrieve the grocieres
        $groceries = Groceries::where('productID', '!=', 'null')->get();

        //Update the prices
        $this->update($groceries, Groceries::class);

        //Retrieve the popular items
        $groceries = PopularItem::where('productID', '!=', 'null')->get();

        //Update the prices
        $this->update($groceries, PopularItem::class);
    }

    private function update($groceries, $database)
    {
        //Loop through all items
        foreach ($groceries as $grocery) {

            //Escape spaces
            $description = str_replace(' ', '%20', $grocery->description);

            //Get the data
            $data = file_get_contents('https://www.ah.nl/service/rest/delegate?url=/zoeken?rq=' . $description . '&searchType=product&_=1510216828382');

            //Convert to json
            $data = json_decode($data);

            //Check the price
            $this->check($data, $grocery);

            //Find the grocery if it exists
            $databaseGrocery = $database::where('productID', '=', $grocery->productID)->first();

            //If it does
            if ($databaseGrocery)
            {
                //Update properties
                $databaseGrocery->priceNow = $this->priceNow;
                $databaseGrocery->priceWas = $this->priceWas;
                $databaseGrocery->discount = $this->discount;
                $databaseGrocery->save();
            }

            //Reset the variables
            $this->priceNow = null;
            $this->priceWas = null;
            $this->discount = null;
        }
    }

    private function check($data, $grocery)
    {
        //Get the lanes
        $lanes = $data->_embedded->lanes;

        //Loop through the lanes
        for ($i=0; $i < count($lanes); $i++)
        {
            //Find a specific property inside the array
            if ($lanes[$i]->type == 'SearchLane')
            {
                //Store the used index
                $index = $i;
            }
        }

        try
        {
            //Fetch the specific property
            $response = $lanes[$index]->_embedded->items;

            //Remove the last array object from the array
            array_pop($response);

            //Loop through the array
            for ($k=0; $k < count($response); $k++)
            {
                //Find a specific property inside the array that indicates that it is a grocery item
                if ($response[$k]->context == 'SearchAndBrowse' && $response[$k]->_embedded->product->id == $grocery->productID)
                {
                    //Save the values
                    $this->priceNow = $response[$k]->_embedded->product->priceLabel->now;

                    //If there is a price reduction
                    if (isset($response[$k]->_embedded->product->priceLabel->was))
                    {
                        //Save the values
                        $this->priceWas = $response[$k]->_embedded->product->priceLabel->was;
                    }

                    //If there is a discount
                    if (isset($response[$k]->_embedded->product->discount))
                    {
                        //Save the values
                        $this->discount = $response[$k]->_embedded->product->discount->label;
                    }
                }
            }
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
}
