<?php

namespace App\Http\Controllers;

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

}
