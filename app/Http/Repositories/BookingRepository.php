<?php
namespace App\Http\Repositories;

use App\Http\Requests\PaginateRequest;
use App\Models\Booking;
use App\Traits\PaginateTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingRepository {
  use PaginateTrait;

  protected $bookingModel;

  public function __construct()
  {
    $this->bookingModel = new Booking();
  }

  public function create(array $data) {
    try {
      return $this->bookingModel->create($data);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function getBookingHistoryPaginate(PaginateRequest $request) {
    try {
      $memberId = $request->member_id;

      $query = $this->bookingModel->with(['member', 'room'])->when($memberId, function($q) use($memberId) {
          $q->where('member_id', $memberId);
      });

      return PaginateTrait::make([
          'name',
          'nip',
          'phone',
          'description',
      ], $request, $query);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function findOneOrFail(array $where) {
    try {
      return $this->bookingModel->with(['room', 'member'])->where($where)->firstOrFail();
    } catch(ModelNotFoundException $e) {
      throw new Exception("Data not found!", 404);
    } catch (\Exception $e) {
      throw $e;
    }
  }
}
