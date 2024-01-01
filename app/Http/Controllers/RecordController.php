<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Google_Client;
use Illuminate\Http\Request;
use Google_Service_Sheets;
use Illuminate\Support\Facades\Log;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Record::where('id',  request()->get('user_id'))->update([
                'telegram_id' =>  request()->get('telegram_id')
            ]);
            return Record::where('id', request()->get('user_id'))->first();
        }catch (\Exception $e){
            Log::info($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fio = $request->post('fio');
            $phone = $request->post('phone');
            $maosh = $request->post('maosh');
            $working_in = $request->post('working_in');

            $record =  Record::firstOrCreate([
                'phone' => $phone
            ], [
                'phone' => $phone,
                'fio' => $fio,
                'maosh' => $maosh,
                'working_in' => $working_in
            ]);

            return ['user_id' => $record->id,  'error' => false];
        } catch (\Exception $e){
            Log::info($e->getMessage());
            return ['error' => true];
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
