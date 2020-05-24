<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Logging;
use App\Pack;
use App\PromoCode;
use App\Repositories\LoggingRepository;
use App\Repositories\PackRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\TransactionRepository;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    //
    protected $model;
    protected $promoModel;
    protected $packModel;
    protected $logModel;

    /**
     * PostController constructor.
     *
     * @param TransactionRepositoryInterface $transaction
     */
    public function __construct(Transaction $transaction, PromoCode $promoCode, Pack $pack,Logging $logging)
    {
        $this->model = new TransactionRepository($transaction);
        $this->promoModel = new PromoCodeRepository($promoCode);
        $this->packModel = new PackRepository($pack);
        $this->logModel = new LoggingRepository($logging);
    }

    /**
     * List all posts.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'transactions' => $this->model->all()
        ];

        return response(['errorCode' => 0, 'meessage' => "Success", 'data' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'pack_id' => 'required',
        ]);
        $bought_pack = $this->packModel->show($request->pack_id);
        $gst = $bought_pack->price * 7 / 100;

        if ($request->promo_id) {
            $use_promo = $this->promoModel->show($request->promo_id);
            $discount = $use_promo->discount / 100 * $bought_pack->price;
            $grand_total = $bought_pack->price - $discount + $gst;
        } else {
            $grand_total = $bought_pack->price + $gst;
            $discount = 0;
        }
        $new_request = array_merge($request->all(), [
            'discount' => round($discount,2) ,
            'sub_total'=> round($bought_pack->price),
            'total'=>round($grand_total),
            'gst'=>round($gst),
            'promo_id'=> ($request->promo_id)? $request->promo_id : null
        ]);

        // create record and pass in only fields that are fillable
        $created_request = $this->model->create($new_request);
        if($created_request){
            $description = "User Id".$request->user_id." bought".$bought_pack->name;
            $effect = "Transaction Table";
            $action = "Create";
            $user_id = $request->user_id;
            $new_log = array_merge([],[
                "description"=>$description,
                "effectedTable"=>$effect,
                "action"=>$action,
                "user_id"=>$user_id
            ]);
            return $this->logModel->create($new_log);

        }
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
