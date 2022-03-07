<?php

namespace App\Repositories;

use App\Models\GenbaTransaction;
use App\Models\Transaction;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenbaTransactionRepository extends EloquentRepository
{
    protected $entity = GenbaTransaction::class; 

    function save($request)
    {
        //
    }
   
}
