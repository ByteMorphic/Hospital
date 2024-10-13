<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Expense;
use App\Models\Ward;
use Illuminate\Support\Facades\Log;

class CustomTaskCommand extends Command
{
    protected $signature = 'app:make-expense';
    protected $description = 'Create new expense record for each ward';

    public function handle()
    {
        try {
            $wards = Ward::all();

            foreach ($wards as $ward) {
                Expense::create([
                    'date' => date('Y-m-d'),
                    'ward_id' => $ward->id,
                    'note' => 'Expense for ward ' . $ward->name,
                    'user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            return Command::SUCCESS;
        } catch (\Exception $e) {
            // $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Error in app:make-expense command: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
