<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\BannerRepositoryEloquent;
use Illuminate\Http\Request;



class BannersController extends Controller
{

    /**
     * @var BannerRepository
     */
    protected $repository;


    public function __construct(BannerRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners = $this->repository->all();

        return responseJson(true,'获取成功',$banners);
    }


}
