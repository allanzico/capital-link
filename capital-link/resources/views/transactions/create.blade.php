@extends('layouts.app', ['title' => __('Transaction')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Transaction')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Transaction') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ action('TransactionController@store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('New Transaction') }}</h6>
                            <div class="pl-lg-4">

                                {{-- Date  --}}
                                <div class="form-group">
                                    <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker" placeholder="Select date" type="text" value="">
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
                                    <select class="form-control" id="input-paid_by">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
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
                                    <select class="form-control" id="input-paid_for">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @if ($errors->has('paid_for'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paid_for') }}</strong>
                                        </span>
                                    @endif


                                </div>

                                {{-- Notes  --}}
                                <div class="form-group">
                                     <label class="form-control-label" for="input-amount">{{ __('Notes') }}</label>
                                     <textarea class="form-control form-control-alternative" rows="3" placeholder="Add notes ..."></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
