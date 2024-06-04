<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\BlogsModel;
use App\Models\Newsletters;
use App\Models\PackageData;
use App\Models\PackageDetails;
use App\Models\StudentBatch;
use App\Models\Subjects;
use App\Models\SubSubTopics;
use App\Models\SubTopics;
use App\Models\Topics;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class MasterData extends Controller
{
    //

    public function addTopicPage()
    {
        $allTopics = Topics::join('subjects', 'subjects.id', 'topics.subject_id')->where('topics.status', '1')->get([
            'topics.id', 'topics.name', 'topics.description', 'topics.icon_url', 'topics.status', 'subjects.name as subject_name',
        ]);
        $allSubjects = Subjects::where('status', '1')->select()->get();

        return view('adminPages.topics', [
            'title' => 'AdminPortal | Add problem Category',
            'allTopics' => $allTopics,
            'allSubjects' => $allSubjects,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addTopicPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Topic name required';
            } else if ($nameError->has('subject_id')) {
                $nameError = 'Subject Must be seleced.';
            } else {
                $nameError = 'Topic image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/topics/');
            $image->move($destinationPath, $pathName);
        } else {
            $pathName = 'default.png';
        }

        $addCity = Topics::create([
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'description' => 'NA',
            'icon_url' => 'images/topics/' . $pathName,
            'status' => '1',

        ]);

        AdminController::updateAuditTrail('New Topic is Added' . json_encode($addCity));

        return back()->with('success', 'Topic added successfully');
    }

    public function deleteTopic($id)
    {

        $delete = Topics::where('id', $id)->first();

        if ($delete) {
            //check if topic is in use in packageData
            $checkPackageData = PackageData::where('topic_id', $id)->first();
            if ($checkPackageData) {
                return back()->with('error', 'Topic cannot be deleted because it is in use in a package');
            }
        }

        AdminController::updateAuditTrail('Deleted problem Category ' . json_encode($delete));
        if ($delete) {
            if (Storage::disk('public')->exists($delete->icon_url)) {
                $this->deleteExistingFile($delete->icon_url);
            }
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return redirect('topics')->with('message', 'Topic Deleted Successfully.');
        }
    }

    public function editTopic($id)
    {
        // $allSubcategories = ProblemCategory::with('problemBrand')->get();
        $allTopics = Topics::join('subjects', 'subjects.id', 'topics.subject_id')->where('topics.status', '1')->get([
            'topics.id', 'topics.name', 'topics.description', 'topics.icon_url', 'topics.status', 'subjects.name as subject_name',
        ]);
        $allSubjects = Subjects::where('status', '1')->select()->get();

        $selectSubCatId = Topics::where('id', $id)->first();

        AdminController::updateAuditTrail('Edit problem Category for ' . json_encode($selectSubCatId));

        return view('adminPages.topics', [
            'title' => 'AdminPortal | Add Problem Category',
            // 'allSubcategories' => $allSubcategories,
            'allTopics' => $allTopics,
            'allSubjects' => $allSubjects,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Topic name required';
            } else if ($nameError->has('subject_id')) {
                $nameError = 'Subject Must be seleced.';
            } else {
                $nameError = 'Topic image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = problemBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = Topics::where('id', $request->id)->first();
            if ($delete) {
                if (Storage::disk('public')->exists($delete->icon_url)) {
                    $this->deleteExistingFile($delete->icon_url);
                }
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/topics/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/topics/' . $name;
            $addCity = Topics::where('id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'name' => $request->name,
                'icon_url' => $imagePath,
            ]);

        } else {

            $addCity = Topics::where('id', $request->id)->update([
                'name' => $request->name,
                'subject_id' => $request->subject_id,
            ]);
        }
        AdminController::updateAuditTrail('Updated problem Category ' . json_encode($addCity));

        return redirect('topics')->with('message', 'Topic updated successfully');
    }

    //Add Subjects

    public function addSubjectPage()
    {
        $allSubjects = Subjects::where('status', '1')->select()->get();
        return view('adminPages.subjects', [
            'title' => 'AdminPortal | Add Subject',
            'allSubjects' => $allSubjects,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addSubjectPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            // check if $validator error has name
            //if it doesnot have name return error "name required"
            // else return error "image required"
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Subject name required';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subjects/');
            $image->move($destinationPath, $pathName);
        } else {
            $pathName = 'default.png';
        }

        $newSubject = Subjects::create([
            'name' => $request->name,
            'icon_url' => 'images/subjects/' . $pathName,
            'description' => $request->description ?? 'NA',
            'status' => '1',
        ]);

        AdminController::updateAuditTrail('New Subject Added successfully' . json_encode($newSubject));
        return back()->with('success', 'Subject added successfully');

    }

    public function deleteSubject($id)
    {

        $delete = Subjects::where('id', $id)->first();

        // check if subject is in packageData
        $checkPackageData = PackageData::where('subject_id', $id)->first();
        if ($checkPackageData) {
            return back()->with('error', 'Subject cannot be deleted because it is in use in a package');
        }

        AdminController::updateAuditTrail('Deleted Subject => ' . json_encode($delete));
        if ($delete) {
            if (Storage::disk('public')->exists($delete->icon_url)) {
                $this->deleteExistingFile($delete->icon_url);
            }
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return redirect('subjects')->with('message', 'Subject Successfully Deleted.');
        }
    }

    public function editSubject($id)
    {
        $allSubjects = Subjects::where('status', '1')->select()->get();
        $selectSubCatId = Subjects::where('id', $id)->first();

        AdminController::updateAuditTrail('Edit Subject for ' . json_encode($selectSubCatId));

        return view('adminPages.subjects', [
            'title' => 'AdminPortal | Edit Subjects',
            // 'allSubcategories' => $allSubcategories,
            'allSubjects' => $allSubjects,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Subject name required';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = problemBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = Subjects::where('id', $request->id)->first();
            if ($delete) {
                if (Storage::disk('public')->exists($delete->icon_url)) {
                    $this->deleteExistingFile($delete->icon_url);
                }
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subjects/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/subjects/' . $name;
            $addCity = Subjects::where('id', $request->id)->update([
                'name' => $request->name,
                'icon_url' => $imagePath,
            ]);

        } else {

            $addCity = Subjects::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        }

        AdminController::updateAuditTrail('Updated problem Category ' . json_encode($addCity));

        return redirect('subjects')->with('message', 'Subject updated successfully');
    }

    // Sub Topic
    public function addSubTopicPage()
    {
        $allSubjects = Subjects::where('status', '1')->select()->get();

        $allSubTopics = SubTopics::
            join('topics', 'topics.id', 'sub_topics.topic_id')
            ->join('subjects', 'subjects.id', 'topics.subject_id')
            ->where('sub_topics.status', '1')
            ->get([
                'sub_topics.id', 'sub_topics.name', 'sub_topics.description', 'sub_topics.icon_url', 'sub_topics.status',
                'topics.name as topic_name', 'subjects.name as subject_name',
            ]);

        return view('adminPages.subTopics', [
            'title' => 'AdminPortal | Add Sub Topics',
            'allSubjects' => $allSubjects,
            'allSubTopics' => $allSubTopics,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addSubTopicPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'name' => 'required|min:1',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            // check if $validator error has name
            //if it doesnot have name return error "name required"
            // else return error "image required"
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Topic name required';
            } else if ($nameError->has('subject_id')) {
                $nameError = 'Subject must be selected';
            } else {
                $nameError = 'Topic image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subtopics/');
            $image->move($destinationPath, $pathName);
        } else {
            $pathName = 'default.png';
        }

        $newSubTopic = SubTopics::create([
            'subject_id' => $request->subject_id,
            'topic_id' => $request->topic_id,
            'name' => $request->name,
            'description' => $request->description ?? 'NA',
            'icon_url' => 'images/subtopics/' . $pathName,
            'status' => '1',
        ]);

        AdminController::updateAuditTrail('New Sub Topic Added successfully' . json_encode($newSubTopic));
        return back()->with('success', 'Sub Topic added successfully');

    }

    public function deleteSubTopic($id)
    {

        $delete = SubTopics::where('id', $id)->first();

        // check if subject is in packageData
        $checkPackageData = PackageData::where('subject_id', $id)->first();
        if ($checkPackageData) {
            return back()->with('error', 'Subject cannot be deleted because it is in use in a package');
        }

        AdminController::updateAuditTrail('Deleted Subject => ' . json_encode($delete));
        if ($delete) {
            if (Storage::disk('public')->exists($delete->icon_url)) {
                $this->deleteExistingFile($delete->icon_url);
            }
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return back()->with('message', 'Sub Topic Successfully Deleted.');
        }
    }

    public function editSubTopic($id)
    {
        $allSubTopics = SubTopics::
            join('topics', 'topics.id', 'sub_topics.topic_id')
            ->join('subjects', 'subjects.id', 'topics.subject_id')
            ->where('sub_topics.status', '1')
            ->get([
                'sub_topics.id', 'sub_topics.name', 'sub_topics.description', 'sub_topics.icon_url', 'sub_topics.status',
                'topics.name as topic_name', 'subjects.name as subject_name',
            ]);
        $allSubjects = Subjects::where('status', '1')->select()->get();
        $selectSubCatId = SubTopics::where('id', $id)->first();
        $allTopics = Topics::where('subject_id', $selectSubCatId->subject_id)->get();

        AdminController::updateAuditTrail('Edit Sub Topic for ' . json_encode($selectSubCatId));

        return view('adminPages.subTopics', [
            'title' => 'AdminPortal | Edit Sub Topic',
            // 'allSubcategories' => $allSubcategories,
            'allSubjects' => $allSubjects,
            'allSubTopics' => $allSubTopics,
            'selectSubCatId' => $selectSubCatId,
            'allTopics' => $allTopics,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateSubTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Sub Topic name required';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = problemBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = SubTopics::where('id', $request->id)->first();
            if ($delete) {
                if (Storage::disk('public')->exists($delete->icon_url)) {
                    $this->deleteExistingFile($delete->icon_url);
                }
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subtopics/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/subtopics/' . $name;
            $addCity = SubTopics::where('id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'name' => $request->name,
                'icon_url' => $imagePath,
            ]);

        } else {

            $addCity = SubTopics::where('id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'name' => $request->name,
            ]);
        }

        AdminController::updateAuditTrail('Updated Sub Topic ' . json_encode($addCity));

        return redirect('sub-topics')->with('message', 'Sub Topic updated successfully');
    }

    // Sub SUb Topic
    public function addSubSubTopicPage()
    {
        $allSubjects = Subjects::where('status', '1')->select()->get();

        $allSubSubTopics = SubSubTopics::
            join('sub_topics', 'sub_topics.id', 'sub_sub_topics.sub_topic_id')
            ->join('topics', 'topics.id', 'sub_topics.topic_id')
            ->join('subjects', 'subjects.id', 'topics.subject_id')
            ->where('sub_sub_topics.status', '1')
            ->get([
                'sub_sub_topics.id', 'sub_sub_topics.name', 'sub_sub_topics.description', 'sub_sub_topics.icon_url', 'sub_sub_topics.status',
                'sub_topics.name as sub_topic_name', 'topics.name as topic_name', 'subjects.name as subject_name',
            ]);

        return view('adminPages.subsubTopics', [
            'title' => 'AdminPortal | Add Sub Topics',
            'allSubjects' => $allSubjects,
            'allSubSubTopics' => $allSubSubTopics,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addSubSubTopicPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'sub_topic_id' => 'required|min:1',
            'name' => 'required|min:1',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            // check if $validator error has name
            //if it doesnot have name return error "name required"
            // else return error "image required"
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Sub Topic name required';
            } else if ($nameError->has('subject_id')) {
                $nameError = 'Subject must be selected';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'Topic must be selected';
            } else if ($nameError->has('sub_topic_id')) {
                $nameError = 'Sub Topic must be selected';
            } else {
                $nameError = 'Sub Topic image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subsubtopics/');
            $image->move($destinationPath, $pathName);
        } else {
            $pathName = 'default.png';
        }

        $newSubTopic = SubSubTopics::create([
            'subject_id' => $request->subject_id,
            'topic_id' => $request->topic_id,
            'sub_topic_id' => $request->sub_topic_id,
            'name' => $request->name,
            'description' => $request->description ?? 'NA',
            'icon_url' => 'images/subsubtopics/' . $pathName,
            'status' => '1',
        ]);

        AdminController::updateAuditTrail('New Sub Sub Topic Added successfully' . json_encode($newSubTopic));
        return back()->with('success', 'Sub Sub Topic added successfully');

    }

    public function deleteSubSubTopic($id)
    {

        $delete = SubSubTopics::where('id', $id)->first();

        // check if subject is in packageData
        $checkPackageData = PackageData::where('subject_id', $id)->first();
        if ($checkPackageData) {
            return back()->with('error', 'Subject cannot be deleted because it is in use in a package');
        }

        AdminController::updateAuditTrail('Deleted Subject => ' . json_encode($delete));
        if ($delete) {
            if (Storage::disk('public')->exists($delete->icon_url)) {
                $this->deleteExistingFile($delete->icon_url);
            }
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return redirect('sub-sub-topics')->with('message', 'Sub Sub Topic Successfully Deleted.');
        }
        return redirect('sub-sub-topics')->with('message', 'Sub Sub Topic Successfully Deleted.');

    }

    public function editSubSubTopic($id)
    {
        $allSubSubTopics = SubSubTopics::
            join('sub_topics', 'sub_topics.id', 'sub_sub_topics.sub_topic_id')
            ->join('topics', 'topics.id', 'sub_topics.topic_id')
            ->join('subjects', 'subjects.id', 'topics.subject_id')
            ->where('sub_sub_topics.status', '1')
            ->get([
                'sub_sub_topics.id', 'sub_sub_topics.name', 'sub_sub_topics.description', 'sub_sub_topics.icon_url', 'sub_sub_topics.status',
                'sub_topics.name as sub_topic_name', 'topics.name as topic_name', 'subjects.name as subject_name',
            ]);

        $allSubjects = Subjects::where('status', '1')->select()->get();
        $selectSubCatId = SubSubTopics::where('id', $id)->first();
        $allTopics = Topics::where('subject_id', $selectSubCatId->subject_id)->get();
        $allSubTopics = SubTopics::where('topic_id', $selectSubCatId->topic_id)->get();

        AdminController::updateAuditTrail('Edit Sub Topic for ' . json_encode($selectSubCatId));

        return view('adminPages.subsubTopics', [
            'title' => 'AdminPortal | Edit Sub Topic',
            // 'allSubcategories' => $allSubcategories,
            'allSubjects' => $allSubjects,
            'allTopics' => $allTopics,
            'allSubTopics' => $allSubTopics,
            'allSubSubTopics' => $allSubSubTopics,
            'selectSubCatId' => $selectSubCatId,
            'allTopics' => $allTopics,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateSubSubTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('name')) {
                $nameError = 'Sub Topic name required';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = problemBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = SubSubTopics::where('id', $request->id)->first();
            if ($delete) {
                if (Storage::disk('public')->exists($delete->icon_url)) {
                    $this->deleteExistingFile($delete->icon_url);
                }
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/subsubtopics/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/subsubtopics/' . $name;
            $addCity = SubSubTopics::where('id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'sub_topic_id' => $request->sub_topic_id,
                'name' => $request->name,
                'icon_url' => $imagePath,
            ]);

        } else {

            $addCity = SubSubTopics::where('id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'sub_topic_id' => $request->sub_topic_id,
                'name' => $request->name,
            ]);
        }

        AdminController::updateAuditTrail('Updated Sub Topic ' . json_encode($addCity));

        return redirect('sub-sub-topics')->with('message', 'Sub Topic updated successfully');
    }

    public function index()
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        $studentsSay = Banners::where('category', '3')->where('status', '1')->orderBy('id', 'desc')->take(10)->get();
        $last3packages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->take(3)->get();

        $popularExams = Banners::where('category', '2')->where('status', '1')->orderBy('id', 'desc')->take(10)->get();
        $banners = Banners::where('category', '1')->where('status', '1')->orderBy('id', 'desc')->take(5)->get();

        $about = Banners::where('category', '6')->where('status', '1')->orderBy('id', 'desc')->first();

        // echo $banners;
        // die;

        // if the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            return view('welcome', [
                'title' => 'AdminPortal | Dashboard',
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSay,
                'last3packages' => $last3packages,
                'popularExams' => $popularExams,
                'bannersList' => $banners,
                'about' => $about,
                'user' => $user,
            ]);
        } else {
            return view('welcome', [
                'title' => 'AdminPortal | Dashboard',
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSay,
                'last3packages' => $last3packages,
                'popularExams' => $popularExams,
                'bannersList' => $banners,
                'about' => $about,

            ]);
        }

    }

    public function newsletters(Request $request)
    {
        $email = $request->email;
        $addtoNewsLetter = new Newsletters();
        $addtoNewsLetter->email = $email;
        $addtoNewsLetter->status = '1';
        $addtoNewsLetter->save();
        return redirect('/')->with('message', 'You are now subscribed to our newslettersƒa');
    }

    public function contact(Request $request)
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);
        return view('contact', [
            'title' => 'AdminPortal | Dashboard',
            'top3blogs' => $top3blogs,
        ]);

    }

    public function contactForm(Request $request)
    {
        $contact = new Banners();
        $contact->category = 'contact';
        $contact->email = $request->email;
        $contact->from = $request->name;
        $contact->phone = $request->phone;
        $contact->title = $request->subject;
        $contact->description = $request->message;
        $contact->status = '1';
        $contact->save();
        return redirect('contact')->with('message', 'Response submitted successfully. Someone of us will be contacted you soon.');
    }

    public function blogs()
    {
        $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(100000)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        $top3blogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);
        return view('blogs', [
            'title' => 'AdminPortal | Dashboard',
            'top3blogs' => $top3blogs,
        ]);
    }

    public function bloginDetail(Request $request)
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        $slug = $request->slug;
        $geBlog = BlogsModel::where('slug', '=', $slug)->where('status', '2')->first();

        if ($geBlog == null) {
            return redirect('/')->with('message', 'The blog you are trying to view is not available');
        }
        return view('blogdetail', [
            'title' => 'AdminPortal | Dashboard',
            'blogDetail' => $geBlog,
            'top3blogs' => $top3blogs,
        ]);
    }

    public function courses()
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);
        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('courses', [
            'title' => 'AdminPortal | Dashboard',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);

    }

    public function courseDetail($code)
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        // echo $userId = Auth::user()->id;
        // die;

        $package = PackageDetails::where('package_code', $code)->where('package_status', '1')->orderBy('id', 'desc')->get();
        $distinctSubjectNames = PackageData::where('package_code', $code)
            ->join('subjects', 'package_data.subject_id', '=', 'subjects.id')
            ->distinct()
            ->pluck('subjects.name');

        // echo $distinctSubjectNames;die;

        if (count($package) == 0) {
            return back()->with('message', 'Could not find the desired package.');
        }
        // if user is enrolled for the package
        // check enrollment
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $packageId = PackageDetails::where('package_code', $code)->first()->id;

            $checkEnrolledpackage = StudentBatch::
                join('student_batch_to_courses', 'student_batch_to_courses.batchId', 'student_batches.batchId')
                ->join('student_batch_to_students', 'student_batch_to_students.batchId', 'student_batches.batchId')
                ->where('student_batch_to_courses.packageId', $packageId)->where('student_batch_to_students.studentId', $userId)->get();

            // echo $packageId;
            // die;

        } else {
            $checkEnrolledpackage = [];
            $packageId = PackageDetails::where('package_code', $code)->first()->id;

        }
        if (count($checkEnrolledpackage) > 0) {
            $pdf = PackageData::
                join('readable_documents', 'readable_documents.id', 'package_data.data_id')
                ->join('subjects', 'subjects.id', 'readable_documents.subject_id')
                ->where('package_id', $packageId)->where('readable_documents.status', 1)
                ->where('package_data.data_type', 'pdf')
                ->orderBy('subject_name', 'ASC')->orderBy('subject_name', 'ASC')->get([
                'subjects.name as subject_name', 'readable_documents.title', 'readable_documents.file_url as file_url',
            ]);

            $videos = PackageData::
                join('videos', 'videos.id', 'package_data.data_id')
                ->join('subjects', 'subjects.id', 'videos.subject_id')
                ->where('package_id', $packageId)->where('videos.status', 1)
                ->where('package_data.data_type', 'video')
                ->orderBy('subject_name', 'ASC')->get([
                'subjects.name as subject_name', 'videos.title', 'videos.video_url as file_url',
            ]);

        } else {
            $pdf = PackageData::
                join('readable_documents', 'readable_documents.id', 'package_data.data_id')
                ->join('subjects', 'subjects.id', 'readable_documents.subject_id')
                ->where('package_id', $packageId)->where('readable_documents.status', 1)->
                where('package_data.data_type', 'pdf')->orderBy('subject_name', 'ASC')->get([
                'subjects.name as subject_name', 'readable_documents.title', DB::raw('NULL as file_url'),
            ]);

            $videos = PackageData::
                join('videos', 'videos.id', 'package_data.data_id')
                ->join('subjects', 'subjects.id', 'videos.subject_id')
                ->where('package_id', $packageId)->where('videos.status', 1)->where('package_data.data_type', 'video')
                ->orderBy('subject_name', 'ASC')->get([
                'subjects.name as subject_name', 'videos.title', DB::raw('NULL as file_url'),
            ]);

        }

        return view('coursesDetail', [
            'title' => 'AdminPortal | Dashboard',
            'top3blogs' => $top3blogs,
            'pdf' => $pdf,
            'video' => $videos,
            'package' => $package[0],
            'subjects' => $distinctSubjectNames,
        ]);
    }

    // aboutus
    public function aboutus()
    {
        $top3blogs = $allBlogs = BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
            ->where('banners.category', '5')->where('blogs_models.status', '2')->orderBy('id', 'desc')->take(3)->get([
            'blogs_models.*', 'banners.title as category_name',
        ]);

        return view('about-us', [
            'title' => 'AdminPortal | Dashboard',
            'top3blogs' => $top3blogs,
        ]);
    }

}
