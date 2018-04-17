@extends('user.panel.masterForms')
@section('formBody')
    <input type="hidden" name="ticket_id" value="{{ old('ticket_id',isset($ticket) ? $ticket->id : '') }}" autocomplete="off">



            @foreach($ticketMessages as $tM)
                <div class="box-panel">
                    <div class="header">
                        <div class="row">
                        <div class="col-md-6 pull-right">
                            فرستنده: {{($tM->sender!=0)?'مدیریت سیستم':$user->mobile_number}}
                        </div>
                        <div class="col-md-6 pull-right">
                                {{Helpers::convert_date_g_to_j($tM->created_at,true)}} - {{$tM->created_at->format('H:i:s')}}
                        </div>
                        </div>
                    </div>
                <div class="data">
                <div class="row">
                    <div class="col-md-12 pull-right">
                            <p>{!!$tM->message_text!!}</p>
                    </div>
                </div>
                </div>
                </div>
            @endforeach





    @if(!isset($ticket) || $ticket->ticket_status==0)
    <div class="box-panel">
        <div class="header">
            <h3 class="title-box">ارسال پاسخ</h3>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea rows="5" class="form-control" name="message_text" placeholder="متن پیام را اینجا بنویسید" autocomplete="off">{{ old('message_text',isset($ticket->message_text) ? Helpers::br2nl($ticket->message_text) : '') }}</textarea>
                        @if ($errors->has('message_text'))<span class="help-block"><strong>{{ $errors->first('message_text') }}</strong></span>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

