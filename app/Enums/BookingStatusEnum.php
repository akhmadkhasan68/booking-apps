<?php
namespace App\Enums;

enum BookingStatusEnum: string {
    case PENDING = "PENDING";
    case CANCELED = "CANCELED";
    case DONE = "DONE";
}
