@extends('app')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @if(count($mails)!=0)
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">@lang('mail.table_column1')</th>
                                <th scope="col">@lang('mail.table_column2')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mails as $mail)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('view', $mail->uuid) }}" title="@lang('mail.detail_mail')">
                                            <h6 class="{{ ($mail->status == 2) ? 'font-weight-bold font-italic' : 'null' }}">{!! $mail->subject !!}</h6>
                                        </a>
                                    </th>
                                    <td>
                                        <small title="{!! $mail->fromAddress !!}">{!! $mail->fromName !!}</small>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-12 text-center mail-loading">
                        <img class="mail-img" src="{{ asset('template/img/mail.svg') }}" alt="">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
