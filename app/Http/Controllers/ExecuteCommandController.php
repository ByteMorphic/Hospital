<?php

namespace App\Http\Controllers;

use App\Console\Commands\CustomTaskCommand;
use Illuminate\Http\Request;

class ExecuteCommandController extends Controller
{
    public function executeCommand(Request $request)
    {
        // Execute the command
        $command = new CustomTaskCommand();
        $command->handle();

        // Return a response indicating success or failure
        return response()->json(['message' => 'Command executed successfully']);
    }
}
