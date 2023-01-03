<?php
namespace App\Http\Repositories;

use App\Models\Booking;
use App\Traits\PaginateTrait;

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
}
