<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\BlogsModel;
use App\Models\DynamicFormModel;
use App\Models\GoogleReviews;
use App\Models\LandingPageContent;
use App\Models\LandingPageSections;
use App\Models\PackageDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DynamicFormBuilder extends Controller
{
    //

    public function index()
    {
        return view('dynamicformbuilder.index');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'formName' => 'required',
            'formData' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 200);
        }

        $formName = $request->formName;
        $formData = $request->formData;

        // check form name in the database
        $checkFormName = DynamicFormModel::where('form_name', $formName)->first();
        if ($checkFormName) {

            $saveFormData = DynamicFormModel::where('form_name', $formName)->update([
                'form_data' => $formData,
            ]);

            $message = 'Form updated successfully';

        } else {
            $saveFormData = DynamicFormModel::create([
                'form_name' => $formName,
                'form_data' => $formData,
            ]);

            $message = 'Form saved successfully';
        }

        // store the form data in the database
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    public function viewforms()
    {
        $forms = DynamicFormModel::all();
        return view('dynamicformbuilder.viewallForms',
            [
                'forms' => $forms,
            ]);
    }

    public function deleteform($id)
    {
        $deleteForm = DynamicFormModel::find($id);
        $deleteForm->delete();
        return redirect()->back();
    }

    public function viewform($id)
    {
        $form = DynamicFormModel::find($id);
        return view('dynamicformbuilder.index',
            [
                'form' => $form,
            ]);
    }

    public function getLandingage($slug)
    {
        $enableSections = LandingPageSections::where('is_active', true)->orderBy('order', 'ASC')->get();

    
        $top3blogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        $studentsSay = Banners::where('category', '3')->where('status', '1')->orderBy('id', 'desc')->take(10)->get();
        $googleReviews = GoogleReviews::orderBy('id', 'desc')->take(5)->get();

        // Convert studentsSay to array
        $studentsSayArray = $studentsSay->toArray();

        // Map googleReviews to match studentsSay structure and add to studentsSayArray
        foreach ($googleReviews as $review) {
            $nearr = [];
            $nearr['id'] = $review['id'];
            $nearr['from'] = $review['reviewer_name'];
            $nearr['title'] = $review['reviewer_name']; // Fixed to use the reviewer's name
            $nearr['imageUrl'] = $review['reviewer_photo'];
            $nearr['rating'] = intval($review['reviewer_rating']); // Convert rating to integer if needed
            $nearr['description'] = $review['reviewer_text'];
            $studentsSayArray[] = $nearr;
        }

        // Ensure every entry in studentsSayArray has a 'rating' field
        for ($i = 0; $i < count($studentsSayArray); $i++) {
            if (!isset($studentsSayArray[$i]['rating'])) {
                $studentsSayArray[$i]['rating'] = 5; // Default rating
            }
        }

        // Optionally, convert the merged array back to a collection if needed
        $studentsSayCollection = collect($studentsSayArray);

        $last3packages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();
        $popularExams = Banners::where('category', '2')->where('status', '1')->orderBy('id', 'desc')->take(10)->get();
        // $banners = Banners::where('category', '1')->where('status', '1')->orderBy('id', 'desc')->take(5)->get();
        $about = Banners::where('category', '6')->where('status', '1')->orderBy('id', 'desc')->first();

        $section2 = LandingPageContent::where('section_id', '2')->get();
        $section3 = LandingPageContent::where('section_id', '3')->orderBy('id', 'desc')->first();
        $section4 = LandingPageContent::where('section_id', '4')->orderBy('id', 'desc')->get();
        $section6 = LandingPageContent::where('section_id', '6')->orderBy('id', 'desc')->first();
    


        // echo $enableSections->where('id', 3)->first();
        // die();
        // Check if the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            return view('viewLandingPage', [
                'title' => LandingPageSections::where('id', 2)->first()->name,
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSayCollection,
                'last3packages' => $last3packages,
                'popularExams' => $popularExams,
                'bannersList' => $section2,
                'section3' => $section3,
                'section4' => $section4,
                'section6' => $section6,
                'about' => $about,
                'user' => $user,
                'allSections' => $enableSections,
                'seoTitle' => LandingPageSections::where('id', 2)->first()->name,
                'seoDescription' => LandingPageSections::where('id', 2)->first()->sub_header,
            ]);
        } else {
            return view('viewLandingPage', [
                'title' => LandingPageSections::where('id', 2)->first()->name,
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSayCollection,
                'last3packages' => $last3packages,
                'popularExams' => $popularExams,
                'bannersList' => $section2,
                'section3' => $section3,
                'section4' => $section4,
                'section6' => $section6,
                'about' => $about,
                'allSections' => $enableSections,
                'seoTitle' => LandingPageSections::where('id', 2)->first()->name,
                'seoDescription' => LandingPageSections::where('id', 2)->first()->sub_header,

            ]);
        }
    }

    public function landingPage()
    {

        $sections = LandingPageSections::get();

        $enableSections = LandingPageSections::where('is_active', true)->get();

        return view('dynamicformbuilder.landingPage', [
            'singleOffer' => null,
            'allBanners' => array(),
            'sections' => $sections,
            'enableSections' => $enableSections,
        ]);
    }

    public function updateSections(Request $request)
    {
        // Get selected section IDs, their orders, names, and sub_headers from the form
        $selectedSections = $request->input('sections', []);
        $orders = $request->input('order', []);
        $names = $request->input('name', []);
        $subHeaders = $request->input('subheader', []);

        // Update all sections to be inactive and reset their order, name, and sub_header
        DB::table('landing_page_sections')->update([
            'is_active' => false,
            'order' => 10,
            'name' => DB::raw('name'), // Keeps the current name value unchanged
            'sub_header' => DB::raw('sub_header'), // Keeps the current sub_header value unchanged
        ]);

        // Enable only the selected sections and update their order, name, and sub_header
        foreach ($selectedSections as $sectionId) {
            DB::table('landing_page_sections')
                ->where('id', $sectionId)
                ->update([
                    'is_active' => true,
                    'order' => isset($orders[$sectionId]) ? $orders[$sectionId] : 10,
                    'name' => isset($names[$sectionId]) ? $names[$sectionId] : DB::raw('name'),
                    'sub_header' => isset($subHeaders[$sectionId]) ? $subHeaders[$sectionId] : DB::raw('sub_header'),
                ]);
        }

        return response()->json(['message' => 'Sections updated successfully!']);
    }

    public function landingPagePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $section_id = $request->category;

        if ($section_id == 2) {
            $section = new LandingPageContent();
            $section->section_id = $section_id;
            $section->image_alt_text = $request->title;
            $section->video_link = $request->video_link;
            $section->content = $request->descriptionforAboutUS;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = '/images/landingpage/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/landingpage/'), $imageName);
                $section->image_url = $imageName;
            }
            $section->save();
            return redirect()->back()->with('message', 'Section added successfully');

        } else if ($section_id == 3) {
            $section = new LandingPageContent();
            $section->section_id = $section_id;
            $section->section_header_text = $request->title;
            $section->section_sub_header_text = $request->description;
            $section->video_link = $request->video_link;
            $section->content = $request->descriptionforAboutUS;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = '/images/landingpage/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/landingpage/'), $imageName);
                $section->image_url = $imageName;
            }
            $section->save();
            return redirect()->back()->with('message', 'Section added successfully');
        } else if ($section_id == 4) {
            $section = new LandingPageContent();
            $section->section_id = $section_id;
            $section->section_header_text = $request->title;
            $section->section_sub_header_text = $request->description;
            $section->navigation_link = $request->navigationLink;
            // imageTitle
            $section->image_alt_text = $request->imageTitle;

            $section->content = $request->descriptionforAboutUS;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = '/images/landingpage/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/landingpage/'), $imageName);
                $section->image_url = $imageName;
            }
            $section->save();
            return redirect()->back()->with('message', 'Section added successfully');
        } else if ($section_id == 6) {
            $section = new LandingPageContent();
            $section->section_id = $section_id;
            $section->section_header_text = $request->title;
            $section->video_link = $request->video_link;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = '/images/landingpage/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/landingpage/'), $imageName);
                $section->image_url = $imageName;
            }
            $section->save();
            return redirect()->back()->with('message', 'Section added successfully');
        }

    }

    public function getLandingPageData($id)
    {
        $section = LandingPageContent::where('section_id', $id)->get();
        return response()->json($section);
    }

    public function deleteLandingPageContent($id)
    {
        $deleteForm = LandingPageContent::find($id);
        $deleteForm->delete();
        return redirect()->back();
    }

    public function editLandingPageContent($id)
    {
        $section = LandingPageContent::find($id);

        $sections = LandingPageSections::get();

        $enableSections = LandingPageSections::where('is_active', true)->get();

        return view('dynamicformbuilder.landingPage', [
            'singleOffer' => $section,
            'allBanners' => array(),
            'sections' => $sections,
            'enableSections' => $enableSections,
        ]);
    }
}
