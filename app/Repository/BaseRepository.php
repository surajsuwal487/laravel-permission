<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class BaseRepository
{
   /**      
    * @var Model      
    */
   protected $model;

   /**      
    * BaseRepository constructor.      
    *      
    * @param Model $model      
    */
   public function __construct(Model $model)
   {
      $this->model = $model;
   }

   /**
    * @param array $attributes
    *
    * @return Model
    */

   public function all()
   {
      return $this->model->orderBY('id', 'DESC')->get();
   }

   public function findByUser($user_id)
   {
      return $this->model->where('user_id', $user_id)->latest()->get();
   }


   /**
    * @param $id
    * @return Model
    */
   public function find($id)
   {
      return $this->model->findOrFail($id);
   }

   public function findBySlug($slug)
   {
      return $this->model->where('slug', $slug)->first();
   }

   public function deleteBySlug($slug)
   {
      return $this->model->where('slug', $slug)->delete();
   }

   public function delete($id)
   {
      return $this->model->where('id', $id)->delete();
   }
   /**
    * @param array $attributes
    * @param $id
    * @return Model
    */
}
