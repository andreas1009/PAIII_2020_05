<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Kabupaten;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    public function index(){
    	$kabupaten_id = session('kabupaten_id');
    	$events = Event::where('kabupaten_id', $kabupaten_id)->paginate(10);
    	$kabupatens = Kabupaten::findOrFail($kabupaten_id);

    	return view('CBT.Event.index',compact('events', 'kabupatens'));
    }

    public function store(Request $request){
    	$event = new Event;
    	$event->nama_event = $request->nama_event;
    	$event->kabupaten_id = $request->kabupaten_id;
    	$event->tgl_awal = $request->tgl_awal;
    	$event->tgl_akhir = $request->tgl_akhir;
    	$event->lokasi = $request->lokasi;
    	$event->deskripsi = $request->deskripsi;
    	$event->cbt_id = session('cbt_id');
    	//file
    	$file = $request->file('foto');
        $gambar = $file->getClientOriginalName();
    	$event->foto = $gambar;

    	if($event->save()){
    		
	    	$file->move(\base_path() ."/public/Kab/information/Event", $gambar);
    		
    		Alert::success('Success', $request->nama_event. ' berhasil ditambahkan');
    		return redirect()->back();
    	}
    }

    public function edit($id){
    	$event = Event::findOrFail($id);
        return view('CBT.Event.edit',compact('event'));
    }

    public function update(Request $request, $id){
    	// var_dump($id);
    	// die();
    	try {
            //select data berdasarkan id
            $event = Event::findOrFail($id);
            //update data

            $event->nama_event = $request->nama_event;
            $event->tgl_awal = $request->tgl_awal;
            $event->tgl_akhir = $request->tgl_akhir;
            $event->lokasi = $request->lokasi;
            $event->deskripsi = $request->deskripsi;
            $event->cbt_id = session('cbt_id');
            $event->save();
            
            //redirect ke route Event.index
            Alert::success('Success', $request->nama_event. ' berhasil diedit');

            return redirect(route('Event.index'))->with(['success' => 'Budaya: ' . $request->nama_event . ' Diedit']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return $e->getMessage();
        }

    }

    public function destroy($id){
    	$event = Event::findOrFail($id);
        $event->delete();
        Alert::success('Success', 'Event berhasil dihapus');
        return redirect()->back();
    }

    public function displayEvent($id){
        $event = Event::findOrFail($id);
        return view('wisatawan.Event.index',compact('event'));
    }
}
