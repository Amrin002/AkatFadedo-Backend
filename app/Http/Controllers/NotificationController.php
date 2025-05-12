<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of unread notifications.
     */
    public function getUnreadNotifications(Request $request)
    {
        $user = $request->user();

        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'total_unread' => $notifications->count(),
            'notifications' => $notifications
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead(Request $request, $notificationId)
    {
        $user = $request->user();

        $notification = Notification::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }

        $notification->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        $user = $request->user();

        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }
    public function markAsReadFromBlade(Request $request, $id)
    {
        $user = $request->user();
        $notification = Notification::where('id', $id)->where('user_id', $user->id)->first();
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
        }
        return redirect()->back();
    }

    public function markAllAsReadFromBlade(Request $request)
    {
        $user = $request->user();
        Notification::where('user_id', $user->id)->where('is_read', false)->update(['is_read' => true]);
        return redirect()->back();
    }

    /**
     * Destroy function (optional for deletion logic).
     */
    public function destroy(Notification $notification)
    {
        // Opsional: implementasi untuk menghapus notifikasi jika diperlukan
    }
}
