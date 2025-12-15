<?php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientCalendarController extends Controller
{
    public function getUserCalendar()
    {
        // tijdelijke test user_id
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([], 401);
        }

        $entries = CalendarEntry::with('exercise')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($entry) {
                return [
                    'title' => $entry->exercise->exercise_name ?? 'Oefening',
                    'start' => $entry->date->format('Y-m-d'),
                    'allDay' => true,

                    // styling (mag blijven)
                    'textColor' => '#fd7596',
                    'backgroundColor' => '#ffffff',
                    'borderColor' => '#fd7596',

                    // handig voor later
                    'extendedProps' => [
                        'settings' => $entry->settings,
                        'exercise_id' => $entry->exercise_id,
                    ],
                ];
            });

        return response()->json($entries);
    }
}
