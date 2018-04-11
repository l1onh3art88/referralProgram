@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @auth
                        <div class="referralCode">
                            <input style="width:100%;"type="text" readonly="readonly"
                                value="{{Auth::user()->affiliate_id }}">
                        </div>
                        <div class = "referralUsage">
                            <h1>Your referral code has been used {{$referredCount}} times!</h1>
                        </div>
                    @endauth

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
