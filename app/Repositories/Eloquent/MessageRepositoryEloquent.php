<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\MessageRepository;
use App\Models\Message;
use App\Repositories\Validators\MessageValidator;

/**
 * Class MessageRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MessageRepositoryEloquent extends BaseRepository implements MessageRepository
{
    /**
     * Specfy Model class name
     *
     * @return string
     */
    public function model()
    {
        return Message::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MessageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllByType($data){
       return DB::select("select type,user_id,see,count(*) as count from `messages`  where `see` = 0 and `user_id` = ? group by `type`",[getUserIdBysk($data['sk'])]);

    }

    public function getListByType($data){
        $res = Message::where('messages.user_id',getUserIdBysk($data['sk']))
            ->where('messages.type',$data['type'])
            ->leftJoin('customers', 'customers.id', '=', 'messages.from_id')
            ->orderBy('messages.created_at','desc')
            ->paginate(15,$columns = ['messages.*','customers.nickName','customers.avatarUrl']);
        Message::where('type',$data['type'])->update(['see' => 1]);
        return $res;
    }

    public static function addMessage($type,$user_id,$from_id,$content,$url=''){
        if ($user_id == $from_id){
            return true;
        }
        $newData['type'] = $type;
        $newData['user_id'] = $user_id;
        $newData['from_id'] = $from_id;
        $newData['content'] = $content;
        $newData['url'] = $url;
        return Message::create($newData);
    }
}
