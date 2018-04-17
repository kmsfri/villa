@extends('admin.master-add')
@section('content_add_form')

    <input type="hidden" name="renter_user_id" value="{{ old('renter_user_id',isset($renter_user_id) ? $renter_user_id : '') }}" autocomplete="off">
    <input type="hidden" name="ticket_id" value="{{ old('ticket_id',isset($ticket) ? $ticket->id : '') }}" autocomplete="off">
    <div class="main-panel">

    @foreach($ticketMessages as $tM)
        <div class="box-panel padding">
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
        </div>
    @endforeach







    <div class="box-panel padding">
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
    </div>



    <div class="box-panel padding">
        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">وضعیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('ticket_status') ? ' has-error' : '' }}">
                            <select  name='ticket_status' class='selectpicker form-control pull-right' autocomplete="off">
                                <option @if(old('ticket_status' ,isset($ticket->ticket_status) ? $ticket->ticket_status : '' )==1) selected @endif value="1" >بسته شده</option>
                                <option @if(old('ticket_status' , isset($ticket->ticket_status) ? $ticket->ticket_status : '')==0) selected @endif value="0" >باز</option>
                            </select>
                            @if ($errors->has('ticket_status'))<span class="help-block"><strong>{{ $errors->first('tariff_status') }}</strong></span>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
@stop