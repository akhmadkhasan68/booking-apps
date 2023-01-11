<?php
namespace App\Http\Repositories;

use App\Models\User;

class UserRepository {
  protected $userModel;
  
  public function __construct()
  {
    $this->userModel = new User();  
  }

  public function findOne(array $where) {
    return $this->userModel->with(['member', 'member.division', 'admin'])->where($where)->first();
  }

  public function create($data) {
    return $this->userModel->create($data);
  }
  
  public function update(array $conditions, array $data) {
    return $this->userModel->where($conditions)->update($data);
  }
}
