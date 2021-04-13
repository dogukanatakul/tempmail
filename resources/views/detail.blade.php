@extends('app')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="clearfix">
                        <h6>{{ $mail->subject }} <small>{{ $mail->date }}</small></h6>
                    </div>
                    <div class="clearfix">
                        {!! $html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
