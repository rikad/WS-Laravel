<?php

use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $class = [
                ['name'=>'Deluxe','description'=>'mantap gede','price'=>'900000'],
                ['name'=>'special','description'=>'khusus spartan','price'=>'750000'],
                ['name'=>'Single','description'=>'biasa wae','price'=>'400000'],
        ];

        $rooms = [
                ['code'=>'A1','class_id'=>1],
                ['code'=>'B2','class_id'=>2],
                ['code'=>'C3','class_id'=>3],
        ];

        $items = [
                ['code'=>'IT1','name'=>'Double Beds','price'=>'300000'],
                ['code'=>'IT2','name'=>'Playstation 4','price'=>'250000'],
                ['code'=>'IT3','name'=>'Xbox','price'=>'100000'],
        ];

        $reservations = [
                ['user_id'=>3,'room_id'=>1,'checkin'=>'2016-10-04','checkout'=>'2016-10-06','status'=>1],
                ['user_id'=>4,'room_id'=>2,'checkin'=>'2016-10-04','checkout'=>'2016-10-06','status'=>1],
        ];

        $reservation_item = [
                ['reservation_id'=>1,'item_id'=>3],
                ['reservation_id'=>2,'item_id'=>1],
        ];

        DB::table('class')->insert($class);
        DB::table('rooms')->insert($rooms);
        DB::table('items')->insert($items);
        DB::table('reservations')->insert($reservations);
        DB::table('reservation_item')->insert($reservation_item);

    }
}
