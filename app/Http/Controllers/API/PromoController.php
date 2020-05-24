<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\PromoCode;
use App\Repositories\PromoCodeRepository;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    //
        //
        protected $model;

        /**
         * PostController constructor.
         *
         * @param PromoCodeRepositoryInterface $promoCode
         */
        public function __construct(PromoCode $promoCode)
        {
            $this->model = new PromoCodeRepository($promoCode);
        }

        /**
         * List all posts.
         *
         * @return mixed
         */
        public function index()
        {
            $data = [
                'promo_codes' => $this->model->all()
            ];

            return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'code' => 'required|max:6',
                'discount' => 'required',
            ]);

            $count = $this->model->count() +1;
            $str_id = $count."";
            $new_request= array_merge($request->all(), ['id' => $str_id]);
            // create record and pass in only fields that are fillable
            //return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$new_request]);
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
