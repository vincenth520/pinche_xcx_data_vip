<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\DriverRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function __construct(DriverRepositoryEloquent $driverRepositoryEloquent)
    {
        $this->driverRepositoryEloquent = $driverRepositoryEloquent;
    }

    public function getDriver(Request $request){
        return $this->driverRepositoryEloquent->getDriverByUserId($request->get('user_id'));
    }
}
