<?php
  namespace App\Repositories;

  use App\Repositories\PackRepositoryInterface;
  use App\Pack;
  use Illuminate\Support\Str;

  class PackRepository implements PackRepositoryInterface{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Pack $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        // $id= Str::uuid()->toString();
        // array_push($data, array("id" => $id));
        // return response([ 'errorCode' => 0, 'meessage' => "Success",'data'=>$data]);
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations)->get();
    }
  }
