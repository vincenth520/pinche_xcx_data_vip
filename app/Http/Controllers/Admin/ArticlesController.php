<?php


namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\ArticleRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\Validators\ArticleValidator;


class ArticlesController extends Controller
{

    /**
     * @var ArticleRepositoryEloquent
     */
    protected $repository;

    /**
     * @var ArticleValidator
     */
    protected $validator;

    public function __construct(ArticleRepositoryEloquent $repository, ArticleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function index(Request $request)
    {
        return $this->repository->paginate($request->get('size',10));
    }

    public function store(Request $request)
    {
        $article = $this->repository->create($request->all());

        return responseJson(true,'发布成功',$article);
    }

    public function show($id)
    {
        $article = $this->repository->find($id);

        return responseJson(true,'获取成功',$article);
    }


    public function update(Request $request, $id)
    {

        try {

            $article = $this->repository->update($request->all(), $id);

            return responseJson(true,'修改成功',$article);

        } catch (ValidatorException $e) {

            return responseJson(false,'修改失败','',422);

        }
    }


    public function destroy($id)
    {

        $deleted = $this->repository->delete($id);

        return responseJson(true,'删除成功',$deleted);
    }
}
