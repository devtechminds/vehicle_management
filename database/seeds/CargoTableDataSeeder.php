<?php

use Illuminate\Database\Seeder;
use App\Cargo;
class CargoTableDataSeeder extends Seeder
{
    /**  php artisan db:seed --class=CargoTableDataSeeder
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::firstOrCreate([
            'cargo_name'=>'transit_full_container_comes_and_empty_container_goes_out_with_vehicle',
            'type'=>'transit',
            'created_by'=>'1',
            'updated_by'=>'1',
            ]);
        Cargo::firstOrCreate([
            'cargo_name'=>'transit_full_container_comes_and_full_container_goes_out_with_vehicle',
            'type'=>'transit',
            'created_by'=>'1',
            'updated_by'=>'1',
            ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'transit_full_container_comes_and_empty_vehicle_goes_out',
        'type'=>'transit',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'transit_loose_material_comes_in_and_empty_vehicle_goes_out',
        'type'=>'transit',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'local_full_container_comes_and_empty_container_goes_out_with_vehicle',
       'type'=>'local',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'local_full_container_comes_and_full_container_goes_out_with_vehicle',
       'type'=>'local',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'local_full_container_comes_and_empty_vehicle_goes_out',
       'type'=>'local',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'local_loose_material_comes_in_and_empty_vehicle_goes_out',
       'type'=>'local',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'empty_container_comes_in_and_empty_vehicle_goes_out.',
       'type'=>'empty',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle',
       'type'=>'empty',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);
        Cargo::firstOrCreate([
        'cargo_name'=>'empty_vehicle_comes_in_and_full_container_goes_with_vehicle',
      'type'=>'empty',
        'created_by'=>'1',
        'updated_by'=>'1',
        ]);

    }
}
