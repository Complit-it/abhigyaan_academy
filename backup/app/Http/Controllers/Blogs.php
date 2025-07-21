<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\BlogsModel;
use Illuminate\Http\Request;
use Validator;

class Blogs extends Controller
{
    //
    public function addBlogs()
    {

        $allCategories = Banners::where('category', 5)->get();

        $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        return view('adminPages.blogs', [
            'title' => 'Add Blogs',
            'allCategories' => $allCategories,
            'singleOffer' => null,
            'allBlogs' => $allBlogs,
            // 'description' => 'Add Blogs',
            // 'from' => 'admin',
            // 'email' => '
        ]);
    }

    public function addBlogsPost(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'scheduledfrom' => 'required',
            'actual_blog' => 'required',
            'status' => 'required',
        ]);

        $blogs = new BlogsModel();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/blogs/', $filename);
            $blogs->featured_image = $filename;
        } else {
            $blogs->featured_image = 'NA';
        }

        $blogs->category = $request->category;
        $blogs->title = $request->title;
        $blogs->slug = $request->slug;
        $blogs->published_on = $request->scheduledfrom;
        $blogs->actual_blog = $request->actual_blog;
        $blogs->status = $request->status;
        $blogs->tags = "ALL";
        $blogs->save();

        return redirect()->back()->with('success', 'Blog added successfully');
    }

    public function editBlogs($id)
    {
        $blogs = BlogsModel::find($id);
        $allCategories = Banners::where('category', 5)->get();

        $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        return view('adminPages.blogs', [
            'title' => 'Add Blogs',
            'allCategories' => $allCategories,
            'singleOffer' => $blogs,
            'allBlogs' => $allBlogs,
            // 'description' => 'Add Blogs',
            // 'from' => 'admin',
            // 'email' => '
        ]);
    }

    public function updateBlogs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'scheduledfrom' => 'required',
            'actual_blog' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('message', $validator->errors());
        }

        $blogs = BlogsModel::where('id', $request->id)->first();

        if ($request->hasFile('image')) {

            //delete previous if existing
            // check if already exist
            if ($blogs->featured_image != null) {
                if (file_exists($blogs->featured_image)) {
                    unlink($blogs->featured_image);
                }

            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/blogs/', $filename);
            $blogs->featured_image = $filename;
        }

        $blogs->category = $request->category;
        $blogs->title = $request->title;
        $blogs->slug = $request->slug;
        $blogs->published_on = $request->scheduledfrom;
        $blogs->actual_blog = $request->actual_blog;
        $blogs->status = $request->status;
        $blogs->tags = "ALL";
        $blogs->save();

        return back()->with("message", "Blog Updated Successfully");
    }
}
