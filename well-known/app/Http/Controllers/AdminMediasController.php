<?php
namespace App\Http\Controllers;
use App\Models\Photo;
use App\Support\MediaUpload;
use Illuminate\Http\Request;
use App\Http\Requests;


class AdminMediasController extends Controller
{
    //
    

    public function index(){

        $photos = Photo::latest()->paginate(20);
        return view('media.index', compact('photos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    public function create(){
        return view('media.upload');
    }
    

    public function store(Request $request){
        $file = $request->file('file');

        if (!$file) {
            return response()->json(['error' => 'No file received.'], 422);
        }

        try {
            // Saved in public/images/media (same place as the editor picker).
            $photo = MediaUpload::store($file);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return response()->json(['file' => $photo->file, 'url' => MediaUpload::urlFor($photo->file)]);
    }
    

    public function destroy($id){
            $photo = Photo::findOrFail($id);
            $photo->delete();
    }


    /**
     * ON  = pages show this file through a random, browser-bound link (/m/...).
     * OFF = pages show the normal /public/images/media/<file name> link.
     */
    public function toggleRandomLink(Request $request, $id){
        $photo = Photo::findOrFail($id);
        $photo->random_link = $request->input('enabled') ? 1 : 0;
        $photo->save();

        return response()->json(['id' => $photo->id, 'random_link' => (int) $photo->random_link]);
    }
    

    public function deleteMedia(Request $request){
        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){
                $photo->delete();
                unlink(public_path() .  '/images/media/' . $photo->file );
            }
            return redirect()->back()->with('user_success','Image/s deleted successfully!');;
        } else {
            return redirect()->back();
        }
    }




}
