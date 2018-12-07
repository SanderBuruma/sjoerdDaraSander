<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Advertentie;
use App\Message;
use Session;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messages.index')
            ->withMessages(Auth::user()->messages);
    }

    public function indexAjax()  {
        $messages = Message::where('receiver_id',auth()->id())->get();
        $returnMessages = [];
        foreach($messages as $k => $v) {
            $v->sender_name = User::find($v->sender_id)->name;
        }
        return ($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, array(
            'title'        => 'required|string|max:255|min:3',
            'message_body' => 'required|string|max:255|min:3',
            'receipient'   => 'required|string|max:255|min:3',
        ));

        $receiver = User::where('name',$request->receipient)->first();
        $message = new Message;
        $message->message       = $request->message_body;
        $message->title         = $request->title;
        $message->receiver_id   = $receiver->id;
        $message->sender_id       = auth()->id();

        $message->save();
        Session::flash('success', "Bericht verstuurd naar $receiver->name!");
		return redirect()->route('advertentie.show', $request->redirect);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* 
    create message based on user name
    */
    public function namedCreate(Request $request) {
        $user = User::where('name', $request->name)->first();
        $advertentie = Advertentie::where('slug',$request->advertentie_slug)->first();
        // // uncomment us for production
        // if (auth()->id() == $user->id) {
        //     Session::flash('error','De ontvangende user bent uzelf!');
        //     return redirect()->route('/home');
        // }
        return view('messages.createNamed')->withUser($user)->withAdvertentie($advertentie);
    }
}
