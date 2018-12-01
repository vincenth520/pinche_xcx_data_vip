<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        Setting::create([
            'key'   => 'APPID',
            'value'    => 'APPID',
            'type' => 1,
        ]);

        Setting::create([
            'key'   => 'AppSecret',
            'value'    => 'AppSecret',
            'type' => 1,
        ]);


    }
}
