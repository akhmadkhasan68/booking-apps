<?php
namespace App\Http\Repositories;

use App\Models\Member;

class MemberRepository {
  protected $memberModel;

  public function __construct()
  {
    $this->memberModel = new Member();
  }

  public function findOne(array $where) {
    return $this->memberModel->with(['user', 'feedbacks', 'booking'])->where($where)->first();
  }

  public function create($data) {
    return $this->memberModel->create($data);
  }
}