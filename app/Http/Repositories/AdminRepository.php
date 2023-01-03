<?php
namespace App\Http\Repositories;

use App\Models\Admin;

class AdminRepository {
  protected $adminModel;

  public function __construct()
  {
    $this->adminModel = new Admin();
  }

  public function findOne(array $where) {
    return $this->adminModel->with(['user'])->where($where)->first();
  }

  public function create($data) {
    return $this->adminModel->create($data);
  }
}
