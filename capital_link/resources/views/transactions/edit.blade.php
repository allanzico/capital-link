@extends('layouts.app', ['title' => __('Transaction')])

@section('content')
    @include('users.partials.header', ['title' => __('Update Transaction')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('EDIT TRANSACTION') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('transactions.edit', $transaction) }}" autocomplete="off">
                            @csrf

                                {{-- User ID  --}}
                                <div class="form-group">
                                    <input class="form-control" id="owner_id"  name="owner_id" type="hidden" value="secret">
                                </div>

                                {{-- Date  --}}
                                <div class="form-group">
                                    <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" name="date" placeholder="Select date" type="text" value="">
                                    </div>
                                </div>

                                {{-- Amount --}}
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Amount') }}</label>
                                    <input type="text" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" required>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>

                               {{-- Paid by --}}
                                <div class="form-group{{ $errors->has('paid_by') ? ' has-danger' : '' }}">

                                    <label class="form-control-label" for="input-paid_by">{{ __('Paid By') }}</label>
                                    <select class="form-control" id="input-paid_by" name="owner_name">
                                         @if (count($members)>0)
                                            @foreach ($members as $member)
                                                <option>{{$member->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('paid_by'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paid_by') }}</strong>
                                        </span>
                                    @endif


                                </div>

                                      {{-- Paid For --}}
                                <div class="form-group{{ $errors->has('paid_for') ? ' has-danger' : '' }}">

                                    <label class="form-control-label" for="input-paid_for">{{ __('Paid For') }}</label>
                                    <select class="form-control" id="input-paid_for" name="payed_for">
                                        <option selected>Choose...</option>
                                        <option value="One">One</option>
                                        <option value="Two">Two</option>
                                        <option value="Three">Three</option>
                                    </select>
                                    @if ($errors->has('paid_for'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paid_for') }}</strong>
                                        </span>
                                    @endif


                                </div>
                                {{-- payment type --}}
                               <div class="form-group">
                                  <label for="description">Payment Type</label>
                                    <select class="form-control" name="payment_type">
                                        <option>Mastercard</option>
                                        <option>Mobile Money</option>
                                        <option>Bank</option>
                                    </select>
                                </div>
                                {{-- Notes  --}}
                                <div class="form-group">
                                     <label class="form-control-label" for="input-amount">{{ __('Notes') }}</label>
                                     <textarea class="form-control form-control-alternative" rows="3" placeholder="Add notes ..." name="notes"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
