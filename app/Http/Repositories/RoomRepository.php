<?php
namespace App\Http\Repositories;

use App\Http\Requests\PaginateRequest;
use App\Http\Requests\Room\SearchAvailableRequest;
use App\Models\Room;
use App\Traits\PaginateTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomRepository {
  use PaginateTrait;

  protected $roomModel;

  public function __construct()
  {
    $this->roomModel = new Room();
  }

  public function paginate(PaginateRequest $request) {
    try {
      $data = $this->roomModel->with(['facilities']);
  
      return PaginateTrait::make([
          'name',
          'floor',
          'capacity',
      ], $request, $data);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function searchAvailable(SearchAvailableRequest $request) {
    try {
      $startDate = $request->start_date;
      $endDate = $request->end_date;

      return $this->getAvailableRoom($startDate, $endDate);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function schedules(PaginateRequest $request) {
    try {
      $date = Carbon::now();

      $startDate = $date->copy()->startOfDay();
      $endDate = $date->copy()->endOfDay();

      $query = $this->roomModel->with(['facilities', 'bookings', 'bookings.member'])->whereHas('bookings', function($q) use($startDate, $endDate) {
        return $q->whereBetween('booking_start_date', [$startDate, $endDate])
        ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      });

      return PaginateTrait::make([
        'name',
        'floor',
        'capacity',
    ], $request, $query);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function scheduleDetail($id) {
    try {
      $date = Carbon::now();

      $startDate = $date->copy()->startOfDay();
      $endDate = $date->copy()->endOfDay();

      return $this->roomModel->with(['feedbacks', 'facilities', 'bookings', 'bookings.member'])->whereHas('bookings', function($q) use($startDate, $endDate) {
        return $q->whereBetween('booking_start_date', [$startDate, $endDate])
        ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      })->where('id', $id)->firstOrFail();
    } catch(ModelNotFoundException $e) {
      throw new \Exception('Data not found!', 404);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function getAvailableRoom($startDate, $endDate) {
    try {
      return $this->roomModel->with(['facilities'])->whereDoesntHave('bookings', function($q) use($startDate, $endDate) {
        return $q->whereBetween('booking_start_date', [$startDate, $endDate])
        ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      })->get();
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function findOneOrFail(array $where) {
    try {
      return $this->roomModel->with(['feedbacks', 'facilities', 'bookings', 'bookings.member'])->where($where)->firstOrFail();
    } catch(ModelNotFoundException $e) {
      throw new \Exception('Data not found!', 404);
    } catch (\Exception $e) {
      throw $e;
    }
  }
}
