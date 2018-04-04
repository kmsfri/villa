@extends('admin.master-add')
@section('content_add_form')
    <input type="hidden" name="parent_id" value="{{ old('parent_id',isset($parent_id) ? $parent_id : Null) }}">
    <input type="hidden" name="canHasSubProp" value="{{ old('canHasSubProp',isset($canHasSubProp) ? $canHasSubProp : Null) }}">
    <div class="form-group{{ $errors->has('prop_title') ? ' has-error' : '' }}">
        <label for="prop_title" class="col-md-2 pull-right control-label">{{($parent_id==Null)?'عنوان خصوصیت:' : 'مقدار:'}}</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="prop_title" value="{{ old('prop_title',isset($property->prop_title) ? $property->prop_title : '') }}">
            @if ($errors->has('prop_title')) <span class="help-block"><strong>{{ $errors->first('prop_title') }}</strong></span> @endif
        </div>
    </div>

    @if(old('canHasSubProp',isset($canHasSubProp) ? $canHasSubProp : True))
    <div class="form-group{{ $errors->has('has_text_value') ? ' has-error' : '' }}">
        <label for="has_text_value" class="col-md-2 pull-right control-label">مقدار:</label>
        <div class="col-md-6 pull-right">
            <select  name='has_text_value' class='selectpicker form-control pull-right'>
                <option @if(old('has_text_value' , isset($property->has_text_value) ? $property->has_text_value : '')==0) selected @endif value="0" >استاتیک</option>
                <option @if(old('has_text_value' , isset($property->has_text_value) ? $property->has_text_value : '')==1) selected @endif value="1" >متنی</option>
            </select>
            @if ($errors->has('has_text_value')) <span class="help-block"><strong>{{ $errors->first('has_text_value') }}</strong></span> @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('guide_text') ? ' has-error' : '' }}">
        <label for="guide_text" class="col-md-2 pull-right control-label">متن راهنما:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="guide_text" value="{{ old('guide_text',isset($property->guide_text) ? $property->guide_text : '') }}">
            @if ($errors->has('guide_text')) <span class="help-block"><strong>{{ $errors->first('guide_text') }}</strong></span> @endif
        </div>
    </div>
    @endif


    <div class="form-group{{ $errors->has('img_dir') ? ' has-error' : '' }}">
        <label for="img_dir" class="col-md-2 pull-right control-label">آیکن:</label>
        <div class="col-md-4 pull-right">
            <input type="file" onchange="readURL(this,'','img_preview')" name="img_dir" id="img_dir" value="{{ old('img_dir',isset($property->img_dir) ? $property->img_dir : '') }}" autocomplete="off">
            @if ($errors->has('img_dir')) <span class="help-block"><strong>{{ $errors->first('img_dir') }}</strong></span> @endif
        </div>
        <div class="col-md-4 pull-right">
            <img id="img_preview" class="{{ isset($property->img_dir) ? '' : 'hide' }} uploaded_img_preview" src="{{ isset($property->img_dir) ? url($property->img_dir) : '#' }}" alt="آیکن" autocomplete="off" />
        </div>
    </div>





    <div class="form-group{{ $errors->has('prop_order') ? ' has-error' : '' }}">
        <label for="prop_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='prop_order' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=20; $i++)
                    <option @if(old('prop_order' , isset($property->prop_order) ? $property->prop_order : '')==$i) selected @endif value="{{$i}}" >{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has('prop_order')) <span class="help-block"><strong>{{ $errors->first('prop_order') }}</strong></span> @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('prop_status') ? ' has-error' : '' }}">
        <label for="prop_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='prop_status' class='selectpicker form-control pull-right'>
                <option @if(old('prop_status' , isset($property->prop_status) ? $property->prop_status : '')==1) selected @endif value="1" >فعال</option>
                <option @if(old('prop_status' , isset($property->prop_status) ? $property->prop_status : '')==0) selected @endif value="0" >غیر فعال</option>
            </select>
            @if ($errors->has('prop_status')) <span class="help-block"><strong>{{ $errors->first('prop_status') }}</strong></span> @endif
        </div>
    </div>



    <div class="form-group{{ $errors->has('multi_assign') ? ' has-error' : '' }}">
        <label for="multi_assign" class="col-md-2 pull-right control-label">انتخاب چندگانه:</label>
        <div class="col-md-6 pull-right">
            <select  name='multi_assign' class='selectpicker form-control pull-right'>
                <option @if(old('multi_assign' , isset($property->multi_assign) ? $property->multi_assign : '')==1) selected @endif value="1" >بله</option>
                <option @if(old('multi_assign' , isset($property->multi_assign) ? $property->multi_assign : '')==0) selected @endif value="0" >خیر</option>
            </select>
            @if ($errors->has('multi_assign')) <span class="help-block"><strong>{{ $errors->first('multi_assign') }}</strong></span> @endif
        </div>
    </div>

@stop

@section('jsCustom')
    <script type="text/javascript">
        function readURL(input,img_id,img_preview_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+img_preview_id+img_id)
                        .attr('src', e.target.result)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
                $('#'+img_preview_id+img_id).removeClass('hide');
            }
        }
    </script>
@stop