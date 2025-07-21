<?php

namespace App\Http\Controllers;

use App\Models\BlogsModel;
use App\Models\MCQs;
use App\Models\SubSubTopics;
use App\Models\SubTopics;
use App\Models\Topics;
use Illuminate\Http\Request;

class MasterDataAPI extends Controller
{
    //

    public function getTopicFromSubject(Request $request)
    {

        $subject = $request->subject_id;

        $allTopicsForSubject = Topics::where('subject_id', $subject)->get(['id', 'name']);
        return response()->json($allTopicsForSubject);
    }

    public function getSubTopicFromTopic(Request $request)
    {

        $subTopic = $request->topic_id;
        $allTopicsForSubject = SubTopics::where('topic_id', $subTopic)->get(['id', 'name']);
        return response()->json($allTopicsForSubject);
    }

    public function getSubSubTopicFromSubTopic(Request $request)
    {
        $subTopic = $request->sub_topic_id;
        $subSubTopicFromSubTopic = SubSubTopics::where('sub_topic_id', $subTopic)->get(['id', 'name']);
        return response()->json($subSubTopicFromSubTopic);
    }

    public function getdata(Request $request)
    {
        // Initialize $class variable
        // $class = '';

        // Determine the class based on the data type
        if ($request->data_type == 'mcq') {
            $data = MCQs::where('topic_id', $request->topic_id)
                ->where('subject_id', $request->subject_id)
                ->select(['title', 'batch_id'])
                ->distinct()
                ->groupBy('title', 'batch_id')
                ->get();

            $arr = [];

            foreach ($data as $a) {
                // Create a new stdClass object to hold the modified data
                $obj = new \stdClass();
                $obj->title = $a->title;
                $obj->id = $a->batch_id;

                // Append the modified object to the array
                $arr[] = $obj;
            }

            // Return the modified array as a JSON response
            return response()->json($arr);

        } else if ($request->data_type == "pdf") {
            $class = "App\Models\ReadableDocuments"; // Assuming 'App\Models\ReadableDocuments' is the namespace and class name for ReadableDocuments model
        } else if ($request->data_type == "video") {
            $class = "App\Models\Videos"; // Assuming 'App\Models\Videos' is the namespace and class name for Videos model
        }

        // Check if $class is not empty and class exists
        if (!empty($class) && class_exists($class)) {
            // Fetch all data from the table based on the determined class
            $data = $class::where('topic_id', $request->topic_id)
                ->where('subject_id', $request->subject_id);

            if ($request->data_type == 'mcq') {
                $data = $data->select(['title', 'batch_id as id'])
                    ->distinct()
                    ->groupBy('title', 'batch_id as id')
                    ->get();
            } else if ($request->data_type == 'pdf') {
                $data = $data->select(['title', 'id'])
                    ->distinct()
                    ->groupBy('title', 'id')
                    ->get();
            } else if ($request->data_type == 'video') {
                $data = $data->select(['title', 'id'])
                    ->distinct()
                    ->groupBy('title', 'id')
                    ->get();
            } else {
                $data = $data->get(); // Default case if no data_type matches
            }

        } else {
            // Handle the case where $class is empty or class doesn't exist
            // You can throw an exception, return an error response, or handle it according to your application logic
        }

        // where('sub_sub_topic_id', $request->sub_sub_topic_id)->get(['id', 'name', 'description', 'url']);
        return response()->json($data);
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->slug;
        $slugExists = BlogsModel::where('slug', $slug)->exists();
        return response()->json($slugExists);
    }
}
