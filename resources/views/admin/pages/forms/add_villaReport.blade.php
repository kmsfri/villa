@extends('admin.master-add')
@section('content_add_form')


    <div class="form-group{{ $errors->has('report_text') ? ' has-error' : '' }}">
        <label for="report_text" class="col-md-2 pull-right control-label">متن گزارش:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" rows="10" name="report_text">{{ old('report_text',isset($report->report_text) ? Helpers::br2nl($report->report_text) : '') }}</textarea>
            @if ($errors->has('report_text'))
                <span class="help-block"><strong>{{ $errors->first('report_text') }}</strong></span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('report_status') ? ' has-error' : '' }}">
        <label for="report_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='report_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option @if(old('report_status' , isset($report->report_status) ? $report->report_status : '')==0) selected @endif value="0" >جدید</option>
                <option @if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==1) selected @endif value="1" >بررسی شده</option>
                <option @if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==2) selected @endif value="2" >پذیرفته شده</option>
                <option @if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==3) selected @endif value="3" >رد شده</option>
            </select>
            @if ($errors->has('report_status'))<span class="help-block"><strong>{{ $errors->first('report_status') }}</strong></span>@endif
        </div>
    </div>



@stop