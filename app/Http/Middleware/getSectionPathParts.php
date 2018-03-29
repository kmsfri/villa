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
