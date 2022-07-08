<?php

namespace App\Repository;

use Spatie\Permission\Models\Role;
use DB;

class RoleRepository 
{
    private $model;
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findorfail($id);
    }

    public function create(array $attributes)
    {
        try{
            // Begin a transaction
            DB::beginTransaction();

            $data = $this->model->create($attributes);

            //Commit the transaction
            DB::commit();
            return $data;
        }
        catch(\Exception $e){
            //An error occured; cancel the transaction...
            DB::rollback();
            return false;
        }
        
    }

    public function update($id, array $attributes)
    {
        try{
            DB::beginTransaction();
            $data = $this->getById($id)->update($attributes);
            DB::commit();
            return $data;
        }
        catch(\Exception $e){
            DB::rollback();
            return false;
        }
      
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            $data = $this->getById($id)->delete();
            DB::commit();
            return $data;
        }
        catch(\Exception $e){
            DB::rollback();
            return false;
        }

      
    }
}


?>