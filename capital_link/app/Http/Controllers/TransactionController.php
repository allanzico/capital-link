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
        ]);

        //Get user ID by name
        $owner_name = $request->input('owner_name');
        $user_id = User::where('name', '=', $owner_name)->first()->id;

        //Change date format
        $originalDate = $request->input('date');
        $newDate = date("Y-m-d", strtotime($originalDate));

        //Create Transaction
        $newTransaction = new Transaction;
        $newTransaction->owner_id =  $user_id;
        $newTransaction->date = $newDate;
        $newTransaction->amount = $request->input('amount');
        $newTransaction->payment_type = $request->input('payment_type');
        $newTransaction->payed_for = $request->input('payed_for');
        $newTransaction->owner_name = $owner_name;
        $newTransaction->notes = $request->input('notes');
        $newTransaction->save();
        //return redirect('/home');
        return redirect()->route('home')->withStatus(__('Savings added succesfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('home')->withStatus(__('Savings successfully deleted'));
    }
}
