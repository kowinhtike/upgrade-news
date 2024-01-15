<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\PostComments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Metadata\Uses;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $news = auth()->user()->news;
        $news = News::all()->reverse();
        return view('home',["news" => $news]);

    }

    public function addNew(){
        return view('news.create');
    }

    public function storeNew(Request $request){
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:10000',
            'image' => 'required',
        ]);
        $new = new News();
        $new->title = $request->title;
        $new->body = $request->body;
        $new->user_id = auth()->user()->id;
        $imagefile = $request->file('image');
        $getImageName = $imagefile->hashName();
        $imagefile->storeAs("public",$getImageName);
        $new->image_url = $getImageName;
        $new->save();

        return to_route('home')->with("create","New created successfully");
    }

    public function showNew($id){
        $new = News::find($id);
        $comments = $new->comments->reverse();
        return view('news.show',['new' => $new,'comments' => $comments]);
    }

    public function editNew($id){
        $new = News::find($id);
        return view('news.edit',["new" => $new]);
    }

    public function updateNew(Request $request, $id){
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:10000',
        ]);
        $new = News::find($id);
        $new->title = $request->title;
        $new->body = $request->body;
        if($request->file('image')){
            //delete the previous image storage
            Storage::delete("public/".$new->image_url);
            $image = $request->file('image');
            $imgName = $image->hashName();
            $image->storeAs('public',$imgName);
            $new->image_url = $imgName;
        }
        $new->save();
        return to_route('home')->with('update',"Blog updated successfully");
    }

    public function deleteNew($id){
        $new = News::where("id",$id)->first();
        Storage::delete("public/".$new->image_url);
        $new->delete();
        return to_route('home')->with('delete',"Blog deleted successfully");
    }

    public function newComment(Request $request,$id){
        $new = News::find($id);
        $comment = new PostComments();
        $comment->text = $request->text;
        $comment->news_id = $id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return to_route('show-new',['id' => $id]);
    }

    public function allUsers(){
        $users = User::all();
        return view('news.allUsers',['users' => $users]);
    }

    public function profile($id){
        $user = User::find($id);
        $news = $user->news;   
        return view('news.profile',['news' => $news,"user" => $user]);
    }
}
