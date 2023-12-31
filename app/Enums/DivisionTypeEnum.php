<?php
namespace App\Enums;

enum DivisionTypeEnum: string {
    case INTERNAL = "INTERNAL";
    case EXTERNAL = "EXTERNAL";
    case GABUNGAN = "INTERNAL & EXTERNAL";
}
