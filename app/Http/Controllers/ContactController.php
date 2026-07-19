<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['ip_address'] = $request->ip();

        try {
            // Attempt to save to database
            ContactMessage::create($data);
            $storedIn = 'database';
        } catch (Exception $e) {
            // Database failed, fallback to logging
            Log::error('Failed to store contact message in database. Fallback to storage log. Error: ' . $e->getMessage());
            Log::info('CONTACT MESSAGE SUBMISSION (FALLBACK): ' . json_encode($data));
            $storedIn = 'log';
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you, ' . e($data['name']) . '! Your message has been sent successfully.',
            'stored_in' => $storedIn
        ]);
    }
}
