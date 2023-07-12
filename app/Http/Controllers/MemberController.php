<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Member;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MemberCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $members = Member::get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('members.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|regex:/^[9][6-9][0-9]{8}$/',
            'address' => 'required|string|max:255',
            'dob' => 'required|string',
            'join_date' => 'required|date',
            'image_path' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $categories = $request->validate([
            'category_id' => 'required|array',
        ]);

        if ($request->image_path) {
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('member', $imageName, 'public');
            $formFields['image_path'] = '/storage/member/' . $imageName;
        }

        DB::beginTransaction();

        try {

            $member = Member::create($formFields);
            $member->categories()->attach($request->category_id);


            DB::commit();

            return redirect(route('member.index'))->with('success', 'New member added successfully');
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to create member');
        }
    }

    public function show(Member $member){
        return view('members.show',compact('member'));
    }

    public function edit(Member $member){
        $categories = Category::get();
        $selected_categories = $member->categories()->get()->pluck('id')->toArray();
        return view('members.edit', compact('member','categories', 'selected_categories'));
    }

    public function update(Request $request, Member $member){
        $formFields = $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|regex:/^[9][6-9][0-9]{8}$/',
            'address' => 'required|string|max:255',
            'image_path' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $categories = $request->validate([
            'category_id' => 'required|array',
        ]);

        
        if ($request->image_path) {
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('member', $imageName, 'public');
            $formFields['image_path'] = '/storage/member/' . $imageName;

            $trimmedPath = trim(str_replace("/storage/", "", $member->image_path));

            if (Storage::disk('public')->exists($trimmedPath)) {

                Storage::disk('public')->delete($trimmedPath);
            }
        }

        DB::beginTransaction();

        try {

            $member->update($formFields);
            $member->categories()->sync($request->category_id);


            DB::commit();

            return redirect(route('member.show',$member->id))->with('success', 'Member updated ssuccessfully');
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to update member');
        }



        return view('members.edit', compact('member','categories', 'selected_categories'));
    }

}
