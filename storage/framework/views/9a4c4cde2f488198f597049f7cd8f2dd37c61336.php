<?php $__env->startSection('content_add_form'); ?>
    <?php if(count($errors)>0): ?>
        <?php echo e(dd($errors)); ?>

        <?php endif; ?>

    <input type="hidden" name="parent_id" value="<?php echo e(old('parent_id',isset($parent_id) ? $parent_id : Null)); ?>">
    <div class="form-group<?php echo e($errors->has('category_title') ? ' has-error' : ''); ?>">
        <label for="category_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_title" value="<?php echo e(old('category_title',isset($category->category_title) ? $category->category_title : '')); ?>">
            <?php if($errors->has('category_title')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_title')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('category_slug_corrected') ? ' has-error' : ''); ?>">
        <label for="category_slug" class="col-md-2 pull-right control-label">کلمات کلیدی آدرس:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_slug" value="<?php echo e(old('category_slug',isset($category->category_slug) ? $category->category_slug : '')); ?>">
            <?php if($errors->has('category_slug_corrected')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_slug_corrected')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>






    <div class="form-group<?php echo e($errors->has('category_order') ? ' has-error' : ''); ?>">
        <label for="category_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=40; $i++): ?>
                    <option <?php if(old('category_order' , isset($category->category_order) ? $category->category_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('category_order')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_order')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('category_status') ? ' has-error' : ''); ?>">
        <label for="category_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_status' class='selectpicker form-control pull-right'>
                <option <?php if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('category_status')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_status')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>


    <?php if(isset($ctg_type) && $ctg_type='category3'): ?>
        <div class="form-group<?php echo e($errors->has('show_in_blog') ? ' has-error' : ''); ?>">
            <label for="show_in_blog" class="col-md-2 pull-right control-label">نمایش در وبلاگ:</label>
            <div class="col-md-6 pull-right">
                <select  name='show_in_blog' class='selectpicker form-control pull-right'>
                    <option <?php if(old('show_in_blog' , isset($category->show_in_blog) ? $category->show_in_blog : '')==1): ?> selected <?php endif; ?> value="1" >بله</option>
                    <option <?php if(old('show_in_blog' , isset($category->show_in_blog) ? $category->show_in_blog : '')==0): ?> selected <?php endif; ?> value="0" >خیر(عدم نمایش)</option>
                </select>
                <?php if($errors->has('show_in_blog')): ?>
                    <span class="help-block"><strong><?php echo e($errors->first('show_in_blog')); ?></strong></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>


    <div class="form-group<?php echo e($errors->has('image_dir') ? ' has-error' : ''); ?>">
        <label for="image_dir" class="col-md-2 pull-right control-label">تصویر اصلی:</label>
        <div class="col-md-4 pull-right">
            <input type="file" onchange="readURL(this,'','img_dir_preview')" name="image_dir" id="image_dir" value="<?php echo e(old('image_dir',isset($category->image_dir) ? $category->image_dir : '')); ?>" autocomplete="off">
            <?php if($errors->has('image_dir')): ?> <span class="help-block"><strong><?php echo e($errors->first('image_dir')); ?></strong></span> <?php endif; ?>
        </div>
        <div class="col-md-4 pull-right">
            <img id="img_dir_preview" class="<?php echo e(isset($category->image_dir) ? '' : 'hide'); ?>" src="<?php echo e(isset($category->image_dir) ? url($category->image_dir) : '#'); ?>" alt="تصویر اصلی" autocomplete="off" />
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('image_hover_dir') ? ' has-error' : ''); ?>">
        <label for="image_hover_dir" class="col-md-2 pull-right control-label">تصویر دوم:</label>
        <div class="col-md-4 pull-right">
            <input type="file" onchange="readURL(this,'','image_hover_dir_preview')" name="image_hover_dir" id="image_hover_dir" value="<?php echo e(old('image_hover_dir',isset($category->image_hover_dir) ? $category->image_hover_dir : '')); ?>" autocomplete="off">
            <?php if($errors->has('image_hover_dir')): ?> <span class="help-block"><strong><?php echo e($errors->first('image_hover_dir')); ?></strong></span> <?php endif; ?>
        </div>
        <div class="col-md-4 pull-right">
            <img id="image_hover_dir_preview" class="<?php echo e(isset($category->image_hover_dir) ? '' : 'hide'); ?>" src="<?php echo e(isset($category->image_hover_dir) ? url($category->image_hover_dir) : '#'); ?>" alt="تصویر دوم" autocomplete="off" />
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsCustom'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>