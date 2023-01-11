<?php
namespace App\Http\Repositories;

use App\Models\Division;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DivisionRepository {
    public function getAll() {
        try {
          $data = Division::all();
      
          return $data;
        } catch (\Exception $e) {
          throw $e;
        }
    }
    
    public function findOneOrFail($id) {
        try {
          $data = Division::where('id', $id)->firstOrFail();
      
          return $data;
        } catch(ModelNotFoundException $e) {
            throw new Exception("Data not found!", 404);
        } catch (\Exception $e) {
          throw $e;
        }
    }
}
