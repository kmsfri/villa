<?php

namespace App\Http\Middleware;

use Closure;

class getSectionPathParts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(\Request::method()=='POST'){
            return $next($request);
        }

        $routeDetails=[
            'showdashboard'=>[
                'page_title'=>'پیشخوان',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان']
                ],
            ],
            'showuser'=>[
                'page_title'=>'اطلاعات کاربری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'کاربر'],
                ],
            ],
            'useraction'=>[
                'page_title'=>'اطلاعات کاربری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'کاربر'],
                ],
            ],
            'blogaction'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'کاربر'],
                    (object)['title'=>'ویرایش اطلاعات بلاگ']
                ],
            ],
            'showblog'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'کاربر'],
                    (object)['title'=>'ویرایش اطلاعات بلاگ']
                ],
            ],
            'addcontent'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                    (object)['title'=>'افزودن جاذبه گردشگری جدید']
                ],
            ],
            'editcontent'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                    (object)['title'=>'ویرایش جاذبه گردشگری']
                ],
            ],
            'addcontentaction'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                    (object)['title'=>'افزودن جاذبه گردشگری جدید']
                ],
            ],
            'editContentCategory'=>[
                'page_title'=>'دسته بندیها',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                    (object)['title'=>'انتخاب دسته بندی']
                ],
            ],
            'doEditContentCategory'=>[
                'page_title'=>'دسته بندیها',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                    (object)['title'=>'انتخاب دسته بندی']
                ],
            ],

            'contents'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                ],
            ],
            'showinbody'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                ],
            ],
            'draft'=>[
                'page_title'=>'مطالب گردشگری',
                'headingButton'=>(object)[
                    'url'=>Route('addcontent'),
                    'title'=>'افزودن مطلب گردشگری جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'جاذبه های گردشگری'],
                ],
            ],
            'villaList'=>[
                'page_title'=>'لیست ویلاها',
                'headingButton'=>(object)[
                    'url'=>Route('addVillaForm'),
                    'title'=>'ثبت ملک جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'ملک های من'],
                ],
            ],
            'addVillaForm'=>[
                'page_title'=>'افزودن ملک جدید',
                'headingButton'=>(object)[
                    'url'=>Route('addVillaForm'),
                    'title'=>'ثبت ملک جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'ملک های من'],
                    (object)['title'=>'ثبت ملک جدید'],
                ],
            ],
            'editVillaForm'=>[
                'page_title'=>'ویرایش ملک',
                'headingButton'=>(object)[
                    'url'=>Route('addVillaForm'),
                    'title'=>'ثبت ملک جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'ملک های من'],
                    (object)['title'=>'ویرایش ملک'],
                ],
            ],
            'editVillaCategory'=>[
                'page_title'=>'تعیین دسته بندی ملک',
                'headingButton'=>(object)[
                    'url'=>Route('addVillaForm'),
                    'title'=>'ثبت ملک جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'ملک های من'],
                    (object)['title'=>'دسته بندیها'],
                ],
            ],
            'ticketList'=>[
                'page_title'=>'لیست تیکتها',
                'headingButton'=>(object)[
                    'url'=>Route('ticketMessages'),
                    'title'=>'ارسال تیکت جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'تیکت های من'],
                ],
            ],
            'ticketMessages'=>[
                'page_title'=>'تیکت',
                'headingButton'=>(object)[
                    'url'=>Route('ticketMessages'),
                    'title'=>'ارسال تیکت جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'تیکت های من'],
                    (object)['title'=>'مشاهده تیکت'],
                ],
            ],
            'updateVilla'=>[
                'page_title'=>'بروزرسانی ویلا',
                'headingButton'=>(object)[
                    'url'=>Route('addVillaForm'),
                    'title'=>'ثبت ملک جدید',
                ],
                'sectionParts'=>[
                    (object)['title'=>'پیشخوان'],
                    (object)['title'=>'ملک های من'],
                    (object)['title'=>'بروزرسانی'],
                ],
            ],







        ];





        $routeName=\Request::route()->getName();

        $data=[
            'sectionPath'=>$routeDetails[$routeName]['sectionParts'],
            'page_title'=>$routeDetails[$routeName]['page_title'],
            'headingButton'=>$routeDetails[$routeName]['headingButton'],
        ];

        \View::share( $data);

        return $next($request);
    }
}
