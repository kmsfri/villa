<?php

namespace App\Http\Controllers\Admin;

use App\Models\RenterUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use \App\Models\Ticket;
use \App\Models\TicketMessage;
use Validator;

class TicketController extends Controller
{
    public function showTicketList(Request $request){

        $add_url=Null;
        if(isset($request->renter_user_id) && $request->renter_user_id!=Null){
            $user = RenterUser::findOrFail($request->renter_user_id);
            $tickets = $user->Tickets()->orderBy('tickets.updated_at','DESC')->orderBy('tickets.created_at','DESC')->paginate(10);
            $add_url=Route('adminTicketMessages').'?renter_user_id='.$user->id;
        }else{
            $tickets = Ticket::orderBy('tickets.updated_at','DESC')->orderBy('tickets.created_at','DESC')->paginate(10);
        }


        $data=[
            'title'=>'لیست مطالب بخش گردشتگری وبسایت',
            'add_url'=>$add_url,
            'del_url'=>Route('adminDeleteTicket'),
            'tickets'=>$tickets,
        ];
        return view('admin.pages.lists.tickets',$data);
    }




    public function showTicketMessages(Request $request){

        $ticket=Null;
        $ticketMessages=array();

        $renter_user_id=Null;
        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $ticket=Ticket::find($request->ticket_id);
            if($ticket==Null) abort(404);
            $ticketMessages=$ticket->TicketMessages()->get();

            $user=RenterUser::findOrFail($ticket->renter_user_id);

        }elseif(isset($request->renter_user_id) && $request->renter_user_id!=Null){
            $user=RenterUser::findOrFail($request->renter_user_id);
            $renter_user_id=$user->id;
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'add',
            'post_add_url'=>Route('adminDoSaveTicket'),
            'title'=>'تیکت',
            'ticket'=>$ticket,
            'ticketMessages'=>$ticketMessages,
            'user'=>$user,
            'renter_user_id'=>$renter_user_id,
        ];
        return view('admin.pages.forms.add_ticket',$data);
    }



    public function doSaveTicket(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'ticket_id' => 'nullable|integer|exists:tickets,id',
                'renter_user_id'=>'nullable|integer|exists:renter_users,id',
                'message_text'=>'nullable|max:280',
                'ticket_status'=>'required|integer'
            ]
        );

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }

        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $ticket=Ticket::findOrFail($request->ticket_id);
            $ticket->ticket_status=$request->ticket_status;
            $ticket->save();
        }elseif(isset($request->renter_user_id) && $request->renter_user_id!=Null){
            $ticket=new Ticket();
            $ticket->renter_user_id=$request->renter_user_id;
            $ticket->ticket_status=$request->ticket_status;
            $ticket->save();
        }else{
            abort(404);
        }

        if(isset($request->message_text) && $request->message_text!=Null) {
            $ticketMessage = new TicketMessage();
            $ticketMessage->sender = 1;
            $ticketMessage->admin_user_id = Auth::guard('admin')->user()->id;
            $ticketMessage->message_text = nl2br($request->message_text);

            $ticket->TicketMessages()->save($ticketMessage);

            $ticket->touch();
        }

        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $msg=["تیکت مورد نظر با موفیت بروزرسانی شد"];
        }else{
            $msg=["تیکت جدید با موفقیت ایجاد شد"];
        }



        return redirect(Route('adminTicketMessages',$ticket->id))->with('messages', $msg);

    }



    public function deleteTicket(Request $request){
        if(isset($request->remove_val)){
            Ticket::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminTicketList')))->with('messages', $msg);
    }


}
