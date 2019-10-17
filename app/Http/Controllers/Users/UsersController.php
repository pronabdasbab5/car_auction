<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Members\Members;
use App\Models\Category\Category;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;

class UsersController extends Controller
{
    public function create() 
    {
    	$member = new Members;
    	$data   = $member->where('isVerified', 0)
    					->get();

    	return view('auth.member.new_members', compact('data'));
    }

    public function verifyUser($member_id)
    {
    	$member = new Members;
    	$data   = $member->where('id', $member_id)
    					->get();

        $category     = new Category;
        $categoryData = $category->all();

    	return view('auth.member.verify_members', compact('data'), ['category' => $categoryData]);
    }

    public function verifyUserData($member_id, Request $request)
    {
        $member = new Members;
        $member->where('id', $member_id)
                ->update([
                    'category_id'=> $request->input('category'),
                    'userName'   => ucwords(strtolower($request->input('name'))),
                    'email'      => $request->input('email'),
                    'mobileNo'   => $request->input('mobile_no'),
                    'address'    => $request->input('address'),
                    'deposit'    => $request->input('deposit_amount'),
                    'buyingLimit'=> $request->input('buying_amount'),
                    'availableLimit'=> $request->input('buying_amount'),
                    'isVerified' => 1,
                ]);


        if($request->hasFile('address_proof')) {

            unlink(public_path('assets/address_proof/'.$request->input('add_old_img')));
            $image        = $request->file('address_proof');
            $file_name    = $request->input('add_old_img');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(450, 300);
            $image_resize->save(public_path("assets/address_proof/".$file_name));
        }

        if($request->hasFile('id_proof')) {

            unlink(public_path('assets/id_proof/'.$request->input('id_old_img')));
            $image        = $request->file('id_proof');
            $file_name    = $request->input('id_old_img');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(450, 300);
            $image_resize->save(public_path("assets/id_proof/".$file_name));
        }

        return redirect()->route('verifyusers', ['member_id' => $member_id])->with('msg', 'User has been verified');
    }

    public function allUser()
    {
        $member = new Members;
        $data   = $member->all();

        return view('auth.member.all_members', compact('data'));
    }

    public function deleteUser($member_id) {

        $member      = new Members;
        $member_data = $member->find($member_id);

        unlink(public_path('assets/address_proof/'.$member_data->addressProof));
        unlink(public_path('assets/id_proof/'.$member_data->idProof));

        $member->where('id', $member_id)
                ->delete();

        return redirect()->route('newusers');
    }

    public function updateStatus($member_id, $status) {

        $member = new Members;
        $member->where('id', $member_id)
                ->update(['status' => $status]);

        return redirect()->route('allusers');
    }

    public function memberImage ($filename) {

        $path = public_path('assets\address_proof\\'.$filename);

        if (!File::exists($path)) 
            $response = 404;


        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function memberImage_1 ($filename) {

        $path = public_path('assets\id_proof\\'.$filename);

        if (!File::exists($path)) 
            $response = 404;
        

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
