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
                        <input style="width:100%;"type="text" readonly="readonly"
                                value="{{ url('/') . '/?ref=' . Auth::user()->affiliate_id }}">
                    @endauth

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
