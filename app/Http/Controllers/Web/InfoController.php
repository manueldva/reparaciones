<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Reception;

class InfoController extends Controller
{	

    public function info(){

    	$received  = Reception::where('status', 'RECEIVED')->count();
    	$repairing = Reception::where('status', 'REPAIRING')->count();
    	$waiting   = Reception::where('status', 'WAITING')->count();
    	//$posts = Post::orderBy('id','DESC')->where('status','PUBLISHED')->paginate(5);
    	return view('web.infos', compact('received', 'repairing', 'waiting'));
    }
}
