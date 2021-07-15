<?php

namespace App\Http\Controllers;

use App\Models\Sujet;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class SujetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function mysujet()
    {
        $sujets = Sujet::all()->where('user_id', auth()->user()->id);
        // $sujets = auth()->user()->sts();
        return view('sujets.sujet', compact('sujets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sujets = Sujet::latest()->paginate(10);

        return view('sujets.index', compact('sujets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sujets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'contenu' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        $sujet = Sujet::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'contenu' => $request->contenu,
                    ]);

        return redirect()->route('sujets.show', $sujet->id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sujet $sujet)
    {
        return view('sujets.show', compact('sujet'));
    }

    public function showfromNoti(Sujet $sujet, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return view('sujets.show', compact('sujet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sujet $sujet)
    {
        $this->authorize('update', $sujet);

        return view('sujets.edit', compact('sujet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sujet $sujet)
    {
        $this->authorize('update', $sujet);

        $data = $this->validate($request, [
            'title' => 'required',
            'contenu' => 'required',
        ]);
        $sujet->update($data);

        return redirect()->route('sujets.show', $sujet->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sujet $sujet)
    {
        $this->authorize('update', $sujet);

        Sujet::destroy($sujet->id);

        return redirect('/');
    }
}
