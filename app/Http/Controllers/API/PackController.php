<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Pack;
use App\Repositories\PackRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackController extends Controller
{
    //
            //
            protected $model;

            /**
             * PostController constructor.
             *
             * @param PackRepositoryInterface $pack
             */
            public function __construct(Pack $pack)
            {
                $this->model = new PackRepository($pack);
            }

            /**
             * List all posts.
             *
             * @return mixed
             */
            public function index()
            {
                $data = [
                    'packs' => $this->model->all()
                ];

                return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
            }

            public function store(Request $request)
            {
                $this->validate($request, [
                    'name' => 'required|max:500',
                    'display_order'=>'required',
                    'description'=>'required|max:500',
                    'total_credit'=>'required',
                    'price'=>'required',
                    'validity_month'=>'required',
                    'estimate_price'=>'required',
                    'newbie_id'=>'required',
                    'tag_id'=>'required',
                    'type_id'=>'required',
                    'alias_id'=>'required'

                ]);
                $id= Str::uuid()->toString();
                $new_request= array_merge($request->all(), ['id' => $id]);

                //return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$new_request]);
                // create record and pass in only fields that are fillable
                return $this->model->create($new_request);
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
