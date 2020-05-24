<?php

namespace App\Http\Controllers\API;

use App\Alias;
use App\Http\Controllers\Controller;
use App\Repositories\AliasRepository;
use Illuminate\Http\Request;

class AliasController extends Controller
{
    //

            //
            protected $model;

            /**
             * PostController constructor.
             *
             * @param AliasRepositoryInterface $alias
             */
            public function __construct(Alias $alias)
            {
                $this->model = new AliasRepository($alias);
            }

            /**
             * List all posts.
             *
             * @return mixed
             */
            public function index()
            {
                $data = [
                    'aliases' => $this->model->all()
                ];

                return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
            }

            public function store(Request $request)
            {
                $this->validate($request, [
                    'name' => 'required|max:500'
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
