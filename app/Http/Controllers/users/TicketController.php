<?php

namespace App\Http\Controllers\users;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use \App\Models\Ticket;
use \App\Models\TicketMessage;
use Validator;
class TicketController extends Controller
{
    public function showTicketList(Request $request){
        $user = Auth::guard('user')->user();
        $tickets = $user->Tickets()->orderBy('tickets.updated_at','DESC')->orderBy('tickets.created_at','DESC')->paginate(10);

        $data=[
            'user'=>$user,
            'tickets'=>$tickets,
        ];
        return view('user.panel.TicketList',$data);
    }




    public function showTicketMessages(Request $request){
        $renter_user = Auth::guard('user')->user();

        $ticket=Null;
        $ticketMessages=array();


        $actionURL=Route('doSaveTicket');

        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $ticket=$renter_user->Tickets()->find($request->ticket_id);
            if($ticket==Null) abort(404);
            $ticketMessages=$ticket->TicketMessages()->get();


            if($ticket->ticket_status==1){
                $actionURL=Null;
            }

        }




        $data=[
            'user'=>$renter_user,
            'actionURL'=>$actionURL,
            'ticket'=>$ticket,
            'ticketMessages'=>$ticketMessages,
            'saveButtonTitle'=>'ارسال',
        ];
        return view('user.panel.addTicket',$data);
    }



    public function doSaveTicket(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'ticket_id' => 'nullable|integer|exists:tickets,id',
                'message_text'=>'required|max:280',
            ]
        );

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }

        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $ticket=Ticket::where('id',$request->ticket_id)
                            ->where('renter_user_id',Auth::guard('user')->user()->id)
                            ->where('ticket_status',0)
                            ->first();
        }else{
            $ticket=new Ticket();
            $ticket->renter_user_id=Auth::guard('user')->user()->id;
            $ticket->ticket_status=0;
            $ticket->save();
        }


        $ticketMessage=new TicketMessage();
        $ticketMessage->sender=0;
        $ticketMessage->message_text=nl2br($request->message_text);

        $ticket->TicketMessages()->save($ticketMessage);

        $ticket->touch();


        if(isset($request->ticket_id) && $request->ticket_id!=Null){
            $msg=["پیام مورد نظر با موفقیت ارسال شد"];
        }else{
            $msg=["تیکت جدید با موفقیت ایجاد شد"];
        }
        return redirect(url(Route('ticketMessages',$ticket->id)))->with('messages', $msg);


    }


}
