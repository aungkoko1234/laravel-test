<?php
namespace App\Repositories;
interface AliasRepositoryInterface{

        public function all();

        public function create(array $data);

        public function update(array $data, $id);

        public function delete($id);

        public function show($id);
}
