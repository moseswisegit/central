<?php

namespace App\Http\Controllers\SuperAdmin;

use Carbon\Carbon;
use App\Models\TextTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProgrammeBiblique extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('gestion_programme')) {
            return abort(401);
        }

       
        $enteteContent = "Programme biblique";

        return view('superAdmin.PBiblique.index', compact('enteteContent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('eventId');

        $event = TextTheme::find($id);

        if ($event) {
            Log::info('Event found', ['event' => $event]);
            $start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d H:i:s');
            $end_date = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->format('Y-m-d H:i:s') : null;

            $event->update([
                'title' => $request->title,
                'start_date' => $start_date,
                'end_date' =>  $end_date ?? null,
                'color' => $request->color,
            ]);

            Log::info('Mise à jour effectuée avec succès', ['updated_event' => $event]);

            return response()->json(['status' => 'success', 'event' => $event]);
        }

        Log::error('Event not found', ['id' => $id]);

        return response()->json(['status' => 'error', 'message' => 'Event not found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = TextTheme::find($id);
    
        if ($event) {
            $event->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Event deleted successfully']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Event not found']);
    }

    public function store(Request $request)
    {
        Log::info('Attempting to store new event...', ['request_data' => $request->all()]);

        $textTheme = new TextTheme();
        $textTheme->title = $request->title;
        $textTheme->description = $request->description;
        $textTheme->start_date = $request->start_date;
        $textTheme->end_date = $request->end_date;
        $textTheme->color = $request->color;

        Log::info('Event data populated.', ['event_data' => $textTheme]);

        try {
            $textTheme->save();
            Log::info('Event saved successfully.', ['event_id' => $textTheme->id]);
            return response()->json(['status' => 'success', 'message' => 'Event added successfully', 'event' => $textTheme]);
        } catch (\Exception $e) {
            Log::error('Error saving event: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to add event']);
        }
    }

    

    public function getEvents()
    {
        $events = TextTheme::all();
        $formattedEvents = $events->map(function($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'backgroundColor' => $event->color,
                'borderColor' => $event->color,
            ];
        });
        return response()->json($formattedEvents);
    }


}
