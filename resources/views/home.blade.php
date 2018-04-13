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
                            <h1>Number of times referral code used: {{$referredCount}}</h1>
                        </div>
                    @endauth

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class = "row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Two-Factor Authentication</div>

                <div class="panel-body">
                    @if (Auth::user()->google2fa_secret)
                    <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Disable 2FA</a>
                    @else
                    <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Enable 2FA</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
