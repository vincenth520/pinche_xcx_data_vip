<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\AppointmentRepositoryEloquent;


class AppointmentsController extends Controller
{

    /**
     * @var AppointmentRepositoryEloquent
     */
    protected $repository;

    public function __construct(AppointmentRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        return $this->repository->addAppointment($request->all());
    }

    public function getMyAppointmentCount(Request $request)
    {
        return $this->repository->getMyAppointmentCount($request->all());
    }

    public function getMyInfoAppointment(Request $request)
    {
        return $this->repository->getMyInfoAppointment($request->all());
    }

    public function getMyAppointment(Request $request)
    {
        return $this->repository->getMyAppointment($request->all());
    }

    public function getAppointmentDetail(Request $request)
    {
        return $this->repository->getAppointmentDetail($request->all());
    }

    public function agreeAppointment(Request $request)
    {
        return $this->repository->agreeAppointment($request->all());
    }

    
}
