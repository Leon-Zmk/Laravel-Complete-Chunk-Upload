<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploderController extends Controller
{

    public function create(){
        return view("Upload.create");
    }
    public function store(Request $request){  


           $receiver=new FileReceiver('file',$request,HandlerFactory::classFromRequest($request));

           if(!$receiver->isUploaded()){
                return response()->json("File Not Uploaded");
           }

           $fileReceived=$receiver->receive();
           if($fileReceived->isFinished()){
               $file=$fileReceived->getFile();
               $fileName=$file->getClientOriginalName();

               $file->storeAs("public/file",$fileName);

               if(unlink($file->getPathname())){
                   return response("Chunks Uploded and Deleted Successfully");
               }
           }
            
  
    }

    public function delete(Request $request){

        $file=$request->file;
        $filePath = "public/file/";
        $finalPath = storage_path("app/".$filePath);
        unlink($finalPath.$file);
       return response()->json("Deleted Successfully");
       
    
}

};
