<?php

namespace App\Modules\Core\Repositories\Payment;

use App\Modules\Core\Models\Payment;
use Celysium\Helper\Repository\BaseRepository;

class PaymentRepository extends BaseRepository
{
    protected static string $entity = Payment::class;
}
