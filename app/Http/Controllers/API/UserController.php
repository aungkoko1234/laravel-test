<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    //
    protected $user;

    /**
     * PostController constructor.
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(User $user)
    {
        $this->user = new UserRepository($user);
    }

    /**
     * List all posts.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'users' => $this->user->all()
        ];

        return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
    }
}
