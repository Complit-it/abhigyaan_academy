<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\BlogsModel;
use App\Models\GoogleReviews;
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

use Cache;

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

        $checkforInclutioninPackageData = PackageData::where('topic_id', $id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'Topic cannot be deleted because it is in use in a package');
        }

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

        $checkforInclutioninPackageData = PackageData::where('subject_id', $id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'Subject cannot be deleted because it is in use in a package');
        }

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

        $checkforInclutioninPackageData = PackageData::where('sub_topic_id', $id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'Sub Topic cannot be deleted because it is in use in a package');
        }

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

        $checkforInclutioninPackageData = PackageData::where('sub_sub_topic_id', $id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'Sub Sub Topic cannot be deleted because it is in use in a package');
        }

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
        // Cache and fetch the top 3 blogs
        $top3blogs = Cache::remember('top3blogs', 600, function () {
            return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
                ->where('banners.category', '5')
                ->where('blogs_models.status', '2')
                ->orderBy('blogs_models.id', 'desc')
                ->take(3)
                ->get([
                    'blogs_models.*',
                    'banners.title as category_name',
                ]);
        });
    
        // Cache and fetch students' testimonials (Banners with category 3)
        $studentsSay = Cache::remember('studentsSay', 600, function () {
            return Banners::where('category', '3')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->take(10)
                ->get();
        });
    
        // Convert studentsSay to an array, ensure it's not null
        $studentsSayArray = $studentsSay ? $studentsSay->toArray() : [];
    
        // Cache and fetch the latest Google reviews
        $googleReviews = Cache::remember('googleReviews', 600, function () {
            return GoogleReviews::orderBy('id', 'desc')
                ->take(5)
                ->get();
        });
    
        // Map googleReviews to match the studentsSay structure
        foreach ($googleReviews as $review) {
            $nearr = [];
            $nearr['id'] = $review->id;
            $nearr['from'] = $review->reviewer_name;
            $nearr['title'] = $review->reviewer_name; // Use reviewer's name as title
            $nearr['imageUrl'] = $review->reviewer_photo;
            $nearr['rating'] = intval($review->reviewer_rating); // Ensure rating is an integer
            $nearr['description'] = $review->reviewer_text;
            $studentsSayArray[] = $nearr;
        }
    
        // Ensure every entry in studentsSayArray has a 'rating' field (set default rating if missing)
        for ($i = 0; $i < count($studentsSayArray); $i++) {
            if (!isset($studentsSayArray[$i]['rating'])) {
                $studentsSayArray[$i]['rating'] = 5; // Default rating if not set
            }
        }
    
        // Optionally, convert the merged array back to a collection if needed
        $studentsSayCollection = collect($studentsSayArray);
    
        // Cache and fetch the last 3 courses
        $last3packages = Cache::remember('last3packages', 600, function () {
            return PackageDetails::where('package_status', '1')
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();
        });
    
        // Cache and fetch the popular exams (Banners with category 2)
        $popularExams = Cache::remember('popularExams', 600, function () {
            return Banners::where('category', '2')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->take(10)
                ->get();
        });
    
        // Cache and fetch banners (Banners with category 1)
        $banners = Cache::remember('bannersList', 600, function () {
            return Banners::where('category', '1')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
        });
    
        // Cache and fetch the "About" section (Banners with category 6)
        $about = Cache::remember('about', 600, function () {
            return Banners::where('category', '6')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->first();
        });
    
        // Check if the user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            return view('welcome', [
                'title' => 'Abhigyan Academy | Premier Defence Coaching in Guwahati',
                'meta_description' => 'Discover the best defence coaching at Abhigyan Academy in Guwahati. Explore top packages, read student reviews, and more.',
                'meta_keywords' => 'Abhigyan Academy, defence coaching, Guwahati, student reviews, coaching packages',
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSayCollection,
                'last3packages' => $last3packages,
                'popularExams' => $popularExams,
                'bannersList' => $banners,
                'about' => $about,
                'user' => $user,
            ]);
        } else {
            return view('welcome', [
                'title' => 'Abhigyan Academy | Premier Defence Coaching in Guwahati',
                'meta_description' => 'Discover the best defence coaching at Abhigyan Academy in Guwahati. Explore top packages, read student reviews, and more.',
                'meta_keywords' => 'Abhigyan Academy, defence coaching, Guwahati, student reviews, coaching packages',
                'top3blogs' => $top3blogs,
                'studentsSay' => $studentsSayCollection,
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
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('contact', [
            'title' => 'Contact Us - Premier Defence Coaching in Guwahati',
            'meta_description' => 'Get in touch with Abhigyan Academy for more information about our premier defence coaching courses in Guwahati. Contact us for inquiries and support.',
            'meta_keywords' => 'Abhigyan Academy, contact us, defence coaching, Guwahati, education, support',
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
            'title' => 'Abhigyan Academy | Top Blogs for Defence Coaching',
            'meta_description' => 'Explore the latest blogs from Abhigyan Academy, the leading defence coaching institute in Guwahati. Stay updated with our top articles.',
            'meta_keywords' => 'defence coaching, blogs, Abhigyan Academy, Guwahati, NDA, CDS, AFCAT, coaching tips',
            'top3blogs' => $top3blogs,
        ]);
    }

    public function bloginDetail(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});


        $slug = $request->slug;
        $geBlog = BlogsModel::where('slug', '=', $slug)->where('status', '2')->first();

        if ($geBlog == null) {
            return abort(404);
        }
        return view('blogdetail', [
            'title' =>  substr(strip_tags($geBlog->title), 0, 55) . '...', 
            'meta_description' => substr(strip_tags($geBlog->actual_blog), 0, 140) . '...',
            'meta_keywords' => implode(', ', array_map('trim', explode(' ', $geBlog->title))),
            'blogDetail' => $geBlog,
            'top3blogs' => $top3blogs,
        ]);
    }

    public function courses()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('courses', [
            'title' => 'Abhigyan Academy | Premier Defence Coaching Courses',
            'meta_description' => 'Explore our comprehensive defence coaching courses and packages. Top-notch training at Abhigyan Academy in Guwahati.',
            'meta_keywords' => 'defence coaching, Guwahati, Abhigyan Academy, training packages',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);

    }

    public function courseDetail($code)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});


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

        // echo $package;
        // die;
        return view('coursesDetail', [
            'title' => 'Abhigyan Academy | Premier Defence Coaching Courses',
            'meta_description' => 'Explore our comprehensive defence coaching courses and packages. Top-notch training at Abhigyan Academy in Guwahati.',
            'meta_keywords' => 'defence coaching, coaching courses, Abhigyan Academy, Guwahati, training packages',
            'top3blogs' => $top3blogs,
            'pdf' => $pdf,
            'video' => $videos,
            'package' => $package,
            'subjects' => $distinctSubjectNames,
        ]);


        // return view('coursesDetail', [
        //     'title' => 'Abhigyan Academy | Best Defence Coaching Institute in Guwahati',
        //     'top3blogs' => $top3blogs,
        //     'pdf' => $pdf,
        //     'video' => $videos,
        //     'package' => $package[0],
        //     'subjects' => $distinctSubjectNames,
        // ]);
    }

    // aboutus
    public function aboutus()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});


        return view('about-us', [
            'title' => 'Abhigyan Academy | Premier Defence Coaching Institute',
            'meta_description' => 'Learn more about Abhigyan Academy, the premier defence coaching institute in Guwahati. Discover our mission, values, and the dedicated team behind our success.',
            'meta_keywords' => 'Abhigyan Academy, defence coaching, Guwahati, coaching institute, about us, education',
            'top3blogs' => $top3blogs,
        ]);
    }

    public function enquireform(Request $request)
    {

        $enquire = new Banners();
        $enquire->category = 'enquire';
        $enquire->from = $request->name;
        $enquire->email = $request->email;
        $enquire->phone = $request->phone;
        $description = $request->course;
        $parts = explode('/', $description);

        $enquire->title = $parts[0];
        $enquire->description = $parts[1];
        $enquire->save();

        return back()->with('enquiremessage', 'Response submitted successfully. Someone of us will be contacted you soon.');
    }

    public function enquires()
    {
        $allBanners = Banners::where('category', 'enquire')->get();

        return view('adminPages.cfs', [
            'allBanners' => $allBanners,
            'title' => 'Enquires | AdminPortal',
            'meta_description' => 'View and manage all enquiries on the AdminPortal. Access and respond to inquiries effectively.',
            'meta_keywords' => 'enquiries, admin portal, manage enquiries, admin dashboard, customer inquiries',
            'pagetitle' => 'Enquires',
        ]);
    }
    
    public function free_resources(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('free_resources', [
            'title' => 'Free Resources | Abhigyan Academy',
            'meta_description' => 'Access a range of free educational resources and top blogs at Abhigyan Academy. Explore valuable content to enhance your learning.',
            'meta_keywords' => 'free resources, educational content, Abhigyan Academy, blogs, learning materials, Guwahati, defense coaching',
            'top3blogs' => $top3blogs,
        ]);
    }
 
    public function biology(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('biology', [
            'title' => 'Biology Resources | Abhigyan Academy',
            'meta_description' => 'Explore top biology resources and blogs at Abhigyan Academy. Stay informed with the latest educational content and insights in biology.',
            'meta_keywords' => 'biology, educational resources, Abhigyan Academy, blogs, biological insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function chemistry(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('chemistry', [
            'title' => 'Chemistry Resources | Abhigyan Academy',
            'meta_description' => 'Discover top chemistry resources and blogs at Abhigyan Academy. Stay updated with the latest educational content and insights in chemistry.',
            'meta_keywords' => 'chemistry, educational resources, Abhigyan Academy, blogs, chemical insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function economics(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('economics', [
            'title' => 'Economics Insights | Abhigyan Academy',
            'meta_description' => 'Explore leading blogs and resources on economics at Abhigyan Academy. Stay updated with the latest insights and educational content.',
            'meta_keywords' => 'economics, educational resources, Abhigyan Academy, blogs, economic insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);
    }
    public function environment(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('environment', [
            'title' => 'Environmental Insights | Abhigyan Academy',
            'meta_description' => 'Discover top blogs and resources on environmental topics at Abhigyan Academy. Stay informed with the latest insights and updates.',
            'meta_keywords' => 'environment, environmental resources, Abhigyan Academy, blogs, ecological insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function geography(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('geography', [
            'title' => 'Geography Resources | Abhigyan Academy',
            'meta_description' => 'Explore top geography resources and blogs at Abhigyan Academy. Stay updated with the latest educational content and insights in geography.',
            'meta_keywords' => 'geography, educational resources, Abhigyan Academy, blogs, geographical insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function history(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('history', [
            'title' => 'History Insights | Abhigyan Academy',
            'meta_description' => 'Discover valuable history resources and blogs at Abhigyan Academy. Stay informed with the latest educational content and insights.',
            'meta_keywords' => 'history, educational resources, Abhigyan Academy, blogs, historical insights, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function maths(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('maths', [
            'title' => 'Maths Resources | Abhigyan Academy',
            'meta_description' => 'Explore top maths resources and blogs at Abhigyan Academy. Get the latest updates and educational content in mathematics.',
            'meta_keywords' => 'maths, educational resources, Abhigyan Academy, blogs, mathematics, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);
    }
    public function physics(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('physics', [
            'title' => 'Physics Resources | Abhigyan Academy',
            'meta_description' => 'Access top physics resources and blogs at Abhigyan Academy. Stay updated with the latest insights and educational content in physics.',
            'meta_keywords' => 'physics, educational resources, Abhigyan Academy, blogs, science, Guwahati, defense coaching, academic content',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function polity(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('polity', [
            'title' => 'Polity Insights | Abhigyan Academy',
            'meta_description' => 'Explore in-depth articles on polity. Stay informed with the latest blogs and insights on political science and current affairs.',
            'meta_keywords' => 'polity, political science, Abhigyan Academy, blogs, current affairs, Guwahati, defense coaching, general knowledge',
            'top3blogs' => $top3blogs,
        ]);

    }
    public function current_affairs(Request $request)
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        return view('current_affairs', [
            'title' => 'Current Affairs | Abhigyan Academy',
            'meta_description' => 'Stay updated with the latest current affairs. Explore top blogs and news to keep yourself informed and ahead.',
            'meta_keywords' => 'current affairs, latest news, Abhigyan Academy, blogs, updates, Guwahati, defense coaching, general knowledge',
            'top3blogs' => $top3blogs,
        ]);
    }






    public function nda_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('nda_course', [
            'title' => 'NDA Course | Abhigyan Academy Guwahati',
            'meta_description' => 'Enroll in our NDA course at Abhigyan Academy. Access top blogs, packages, and expert training to advance your defense career.',
            'meta_keywords' => 'NDA course, defense coaching, Abhigyan Academy, Guwahati, CDS, SSB, AFCAT, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);
    }
    public function cds_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('cds_course', [
            'title' => 'CDS Course Preparation | Abhigyan Academy Guwahati',
            'meta_description' => 'Join our CDS course at Abhigyan Academy. Access top blogs, packages, and expert training to boost your defense career.',
            'meta_keywords' => 'CDS course, defense coaching, Abhigyan Academy, Guwahati, NDA, SSB, AFCAT, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);

    }
    public function capf_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

       
        return view('capf_course', [
            'title' => 'CAPF Course | Abhigyan Academy',
            'meta_description' => 'Enroll in our CAPF course at Abhigyan Academy. Access top blogs, packages, and expert training to advance your defense career.',
            'meta_keywords' => 'CAPF course, defense coaching, Abhigyan Academy, Guwahati, NDA, CDS, SSB, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);
    }
    public function afcat_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('afcat_course', [
            'title' => 'AFCAT Course | Abhigyan Academy',
            'meta_description' => 'Discover our AFCAT course at Abhigyan Academy. Get access to top blogs, packages, and expert training for your defense career.',
            'meta_keywords' => 'AFCAT course, defense coaching, Abhigyan Academy, Guwahati, NDA, CDS, SSB, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);
    }
    public function ssb_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('ssb_course', [
            'title' => 'SSB Course | Abhigyan Academy Guwahati',
            'meta_description' => 'Join our SSB course at Abhigyan Academy. Access top blogs, packages, and expert training. Advance your defense career with us.',
            'meta_keywords' => 'SSB course, defense coaching, Abhigyan Academy, Guwahati, NDA, CDS, AFCAT, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);

    }
    public function coast_guard_course()
    {
       $top3blogs = Cache::remember('top3blogs', 60, function () {
    return BlogsModel::join('banners', 'banners.id', 'blogs_models.category')
        ->where('banners.category', '5')
        ->where('blogs_models.status', '2')
        ->orderBy('blogs_models.id', 'desc')
        ->take(3)
        ->get([
            'blogs_models.*',
            'banners.title as category_name',
        ]);
});

        $allPackages = PackageDetails::where('package_status', '1')->orderBy('id', 'desc')->get();

        return view('coast_guard_course', [
            'title' => 'Coast Guard Course | Abhigyan Academy',
            'meta_description' => 'Top Coast Guard course at Abhigyan Academy. Explore blogs, packages, and expert training. Start your career with us.',
            'meta_keywords' => 'Coast Guard course, defense coaching, Abhigyan Academy, Guwahati, NDA, CDS, AFCAT, military training, career development',
            'top3blogs' => $top3blogs,
            'allPackages' => $allPackages,
        ]);

    }

}
