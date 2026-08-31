<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->input('read') === 'unread') {
            $query->whereNull('read_at');
        } elseif ($request->input('read') === 'read') {
            $query->whereNotNull('read_at');
        }

        // Filtrage par statut
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $query->orderBy('created_at', $request->input('sort') === 'oldest' ? 'asc' : 'desc');
        $messages = $query->paginate(20)->withQueryString();
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        // Marquer comme lu
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Mettre à jour le statut et les notes d'un message
     */
    public function updateStatus(ContactMessage $message, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,reviewing,replied,archived',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $message->update($validated);

        return redirect()->route('admin.messages.show', $message)
            ->with('success', 'Statut et notes mis à jour.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé.');
    }
}
