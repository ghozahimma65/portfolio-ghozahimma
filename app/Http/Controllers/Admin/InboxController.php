<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InboxController extends Controller
{
    /**
     * Display all contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.inbox.index', compact('messages'));
    }

    /**
     * Display a specific message detail and mark it as read.
     */
    public function show(ContactMessage $message)
    {
        // Auto mark as read on view
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.inbox.show', compact('message'));
    }

    /**
     * Mark a message as read or unread toggle.
     */
    public function markRead(Request $request, ContactMessage $message)
    {
        $message->update(['is_read' => ! $message->is_read]);

        return redirect()->back()->with('success', 'Message status updated.');
    }

    /**
     * Delete a contact inquiry.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.inbox.index')->with('success', 'Message deleted successfully.');
    }

    /**
     * Export all messages to CSV format.
     */
    public function exportCsv(): StreamedResponse
    {
        // Use cursor() to avoid loading all messages into memory at once (M-4 fix)
        $messages = ContactMessage::orderBy('created_at', 'desc')->cursor();

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="portfolio_inbox_' . date('Y-m-d') . '.csv"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $columns = ['ID', 'Name', 'Email', 'Subject', 'Message', 'IP Address', 'Received At'];

        $callback = function() use ($messages, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for MS Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);

            foreach ($messages as $msg) {
                fputcsv($file, [
                    $msg->id,
                    $msg->name,
                    $msg->email,
                    $msg->subject,
                    $msg->message,
                    $msg->ip_address,
                    $msg->created_at->toDateTimeString()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
