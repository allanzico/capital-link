<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(5);

        //$transactions = Transaction::all();
        return view('dashboard')->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'owner_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            // 'paid_by' => 'required',
        ]);

        //Change date format
        $originalDate = $request->input('date');
        $newDate = date("Y-m-d", strtotime($originalDate));

        //Create Transaction
        $newTransaction = new Transaction;
        $newTransaction->owner_id =  $request->input('owner_id');
        $newTransaction->date = $newDate;
        $newTransaction->amount = $request->input('amount');
        $newTransaction->payment_type = $request->input('payment_type');
        $newTransaction->payed_for = $request->input('payed_for');
        $newTransaction->owner_name =  $request->input('owner_name');
        $newTransaction->notes = $request->input('notes');

        $newTransaction->save();
        //return redirect('/home');
        return redirect()->route('home')->withStatus(__('Savings added succesfully.'));
    }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
