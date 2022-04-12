<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\TransactionExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TransactionRequest;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api',['except' => ['exportExcel','checkTicket']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $this->authorize('isAdmin');

        $transactions = Transaction::latest()->paginate(10);

        return $this->sendResponse($transactions, 'Transactions list');
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(TransactionRequest $request)
    {

        $timestamp = Carbon::now()->timestamp;
        $user = User::where('id',Auth::id())->select(['name'])->first() ;
        
        $ticketCode = "TKT-".$timestamp;
        $transaction = Transaction::create([
            'nama_customer' => $request['name'],
            'ticket_code' => $ticketCode,
            'amount' => $request['amount'],
            'status' => 'open',
            'amount_scanned' => 0,
            'harga_ticket' => $request['harga_ticket'],
            'created_by' => $user->name,
        ]);

        return $this->sendResponse($transaction, 'Transaction Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return $this->sendResponse($transaction, 'Transaction Information has been updated');
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

        $transaction = Transaction::findOrFail($id);
        // delete the user

        $transaction->delete();

        return $this->sendResponse([$transaction], 'Transaction has been Deleted');
    }

    public function getCode()
    {
       
        // $this->authorize('isAdmin');

        $transactions = Transaction::select(['id','name'])->get();

        return $this->sendResponse($transactions, 'Transactions list');
    }

    public function exportExcel() {
        return Excel::download(new TransactionExport, 'transaction.xlsx');
    }

    public function checkTicket($ticket) {

        $transScanned = Transaction::where('ticket_code',$ticket)->select(['amount','amount_scanned','status'])->first();

        if ($transScanned->status == "closed") {
            return response()->json([
                "status" => $transScanned->status
            ]);
        }

        $counting = $transScanned->amount_scanned + 1;
        if ($transScanned->amount == $counting) {
            Transaction::where('ticket_code',$ticket)
                ->update([
                    "status" => "closed",
                    "amount_scanned" => $counting
                ]);
        }else{
            Transaction::where('ticket_code',$ticket)
                ->update([
                    "amount_scanned" => $counting
                ]);
        } 

        return response()->json([
            "status" => $transScanned->status
        ]);
    }
}