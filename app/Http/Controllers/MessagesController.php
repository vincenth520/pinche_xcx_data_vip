<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\MessageRepositoryEloquent;


class MessagesController extends Controller
{

    /**
     * @var MessageRepositoryEloquent
     */
    protected $repository;


    public function __construct(MessageRepositoryEloquent $messageRepositoryEloquent)
    {
        $this->messageRepositoryEloquent = $messageRepositoryEloquent;
    }


    public function getAllTypeList(Request $request)
    {
        $data = $this->messageRepositoryEloquent->getAllByType($request->all());
        $newData = collect($data)->pluck('count','type');
        return responseJson(true,'获取成功',$newData);
    }

    public function getListByType(Request $request){
        return $this->messageRepositoryEloquent->getListByType($request->all());
    }



}
