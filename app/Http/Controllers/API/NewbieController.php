<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Newbie;
use App\Repositories\NewbieRepository;
use Illuminate\Http\Request;

class NewbieController extends Controller
{
    //
    protected $model;

    /**
     * PostController constructor.
     *
     * @param NewbieRepositoryInterface $newbie
     */
    public function __construct(Newbie $newbie)
    {
        $this->model = new NewbieRepository($newbie);
    }

    /**
     * List all posts.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'newbies' => $this->model->all()
        ];

        return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newbie_first_attend' => 'required',
            'newbie_addition_credit' => 'required',
            'newbie_note' =>'required|max:255'
        ]);

        // create record and pass in only fields that are fillable
        return $this->model->create($request->only($this->model->getModel()->fillable));
    }

    public function show($id)
    {
        return $this->model->show($id);
    }

    public function update(Request $request, $id)
    {
        // update model and only pass in the fillable fields
        $this->model->update($request->only($this->model->getModel()->fillable), $id);

        return $this->model->show($id);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }
}
