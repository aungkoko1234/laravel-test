<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\TypeRepository;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    //
        //
        protected $model;

        /**
         * PostController constructor.
         *
         * @param TypeRepositoryInterface $type
         */
        public function __construct(Type $type)
        {
            $this->model = new TypeRepository($type);
        }

        /**
         * List all posts.
         *
         * @return mixed
         */
        public function index()
        {
            $data = [
                'types' => $this->model->all()
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
