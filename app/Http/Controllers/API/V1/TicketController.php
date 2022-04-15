<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket as ModelsTicket;
use App\Models\Transaction;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api',['except' => ['detailGroup','printQR']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\Gate::allows('isAdmin')) {
            return $this->unauthorizedResponse();
        }
        // $this->authorize('isAdmin');

        $tickets = ModelsTicket::latest()->paginate(10);

        return $this->sendResponse($tickets, 'Tickets list');
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(TicketRequest $request)
    {
        $ticket = ModelsTicket::create([
            'name' => $request['name'],
            'harga' => $request['harga'],
        ]);

        return $this->sendResponse($ticket, 'Ticket Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TicketRequest $request, $id)
    {
        $ticket = ModelsTicket::findOrFail($id);
        $ticket->update($request->all());

        return $this->sendResponse($ticket, 'Ticket Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $ticket = ModelsTicket::findOrFail($id);
        // delete the user

        $ticket->delete();

        return $this->sendResponse([$ticket], 'Ticket has been Deleted');
    }

    public function getCode()
    {
       
        // $this->authorize('isAdmin');

        $tickets = ModelsTicket::select(['id','name','harga'])->get();

        return $this->sendResponse($tickets, 'Tickets list');
    }

    public function printQR($id)
    {
        $ticket = Transaction::where('id',$id)
            ->select(['ticket_code','nama_customer','created_at'])
            ->first();

        return view('qrCode',[
            'ticket' => $ticket
        ]);
    }

    public function detailGroup($id)
    {
        $ticket = Transaction::where('ticket_code',$id)
            ->select(['ticket_code','amount','amount_scanned','nama_customer','created_at'])
            ->first();

        // return response()->json($ticket);
        return view('detailGroup',[
            'ticket' => $ticket
        ]);
    }

}
