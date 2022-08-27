<?php

namespace App\Http\Controllers;

use App\Models\BugTypes;
use App\Models\Event;
use App\Models\EventTypes;
use App\Models\Issues;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkAdmin');
    }


    public function create()
    {
        $eventTypes = EventTypes::all();

        return view('admin.add-events-type', compact('eventTypes'));
    }

    public function addEventType(Request $request)
    {
        EventTypes::create($request->all());
        toastr()->success('Data Saved Successfully');
        return redirect()->back();
    }

    public function deleteEventType($id)
    {
        $eventType = EventTypes::findOrFail($id);
        if ($eventType) {
            $eventType->delete();
            toastr()->error('Delete Successfully');
        }
        return redirect()->back();
    }

    public function deleteBugType($id)
    {
        $bugType = BugTypes::findOrFail($id);
        if ($bugType) {
            $bugType->delete();
            toastr()->error('Delete Successfully');
        }
        return redirect()->back();
    }

    public function getAllUsers()
    {
        $users = User::all()->except(Auth::id());
        return view('admin.users.index', compact('users'));
    }

    public function adminUpcomingEvents()
    {
        $upcomingEvents = Event::where('event_date', '>', date('Y-m-d'))->where('is_drafted', 0)->with(['eventPictures', 'user'])->get();
        return view('admin.events.upcoming_events', compact('upcomingEvents'));
    }
    public function adminTodayEvents()
    {
        $todayEvents = Event::where('event_date', '=', date('Y-m-d'))->where('is_drafted', 0)->with(['eventPictures', 'user'])->get();
        return view('admin.events.today_events', compact('todayEvents'));
    }

    public function adminPastEvents()
    {
        $pastEvents = Event::where('event_date', '<', date('Y-m-d'))->where('is_drafted', 0)->with(['eventPictures', 'user'])->get();
        return view('admin.events.past_events', compact('pastEvents'));
    }

    public function getAllIssues()
    {
        $issues = Issues::orderBy('created_at', 'DESC')->get();
        return view('front.issues.index', compact('issues'));
    }

    public function getIssueDetails($id)
    {
        $issue = Issues::findOrFail($id);
        return view('front.issues.show', compact('issue'));
    }

    public function blockUser($id)
    {
        $user = User::findorFail($id);
        if ($user) {
            $user->is_block = 'true';
            $user->save();
        }
        toastr()->success('User has been blocked successfully');
        return redirect()->back();
    }

    public function unBlockUser($id)
    {
        $user = User::findorFail($id);
        if ($user) {
            $user->is_block = 'false';
            $user->save();
        }

        toastr()->success('User has been unblocked successfully');
        return redirect()->back();
    }

    public function addIssueTypes()
    {
        $issueTypes = BugTypes::all();
        return view('front.issues.add_issue_types', compact('issueTypes'));
    }

    public function addBugType(Request $request)
    {
        BugTypes::create($request->all());
        toastr()->success('Data Saved Successfully');
        return redirect()->back();
    }
}
