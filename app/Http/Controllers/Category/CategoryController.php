<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;

class CategoryController extends Controller
{
    public function create() 
    {
    	$category = new Category;
    	$data     = $category->get();

    	return view('auth.category.new_category', compact('data'));
    }

    public function store(Request $request)
    {
    	$request->validate([
	        'category' => 'required'
	    ],
		[
	        'category.required' => 'The Category is required'
	    ]);

    	$category  = new Category;
        $row_check = $category->where('category', $request->input('category'))
        						->count();

        if ($row_check > 0) 
            return redirect()->route('newcategory')->with('msg', 'Category already added.');
        else {

            $category->category = ucwords(strtolower($request->input('category')));

            if($category->save()) 
                return redirect()->route('newcategory')->with('msg', 'Category has been added successfully');
            else
                return redirect()->route('newcategory')->with('msg', 'Something wrong while adding'); 
        }
    }

    public function update (Request $request, $category_id) {

        if ($request->has('category_name')) {

            $category  = new Category;
            $row_check = $category->where('category', $request->input('category_name'))
            						->count();

            if ($row_check > 1)
                print "1";
            else {

                $category->where('id', $category_id)
                		->update(['category' => ucwords(strtolower($request->input('category_name')))]);
                print "1";
            }
        } else
            print "2";
    }
}
