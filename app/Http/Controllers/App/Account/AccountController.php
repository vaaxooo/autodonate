<?php

namespace App\Http\Controllers\App\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function details(Request $request) {
        if($request->isMethod('put')) {
            return (new \App\Http\Services\Account\ServiceUpdate)->handle($request->all());
        }

        return view('pages.account.index');
    }

    public function notifications() {
        $query = Auth::user()->notifications()->orderBy('id', 'desc')->limit(10);
        $query->update([
            'read' => true
        ]);
        $notifications = $query->get();
        return view('pages.account.notifications', ["notifications" => $notifications]);
    }

    public function activity() {
        $logs = Auth::user()->activityLogs()->where('action', 'auth')->orderBy('id', 'desc')->limit(10)->get();
        return view('pages.account.activity', ['logs' => $logs]);
    }

    public function security(Request $request) {
        if($request->post('logs')) {
            Auth::user()->update(['logs' => !Auth::user()->logs]);
        }
        if($request->post('twofactor')) {
            Auth::user()->update(['twofactor' => !Auth::user()->twofactor]);
        }
        if($request->post('smtp_unusual_activity')) {
            Auth::user()->update(['smtp_unusual_activity' => !Auth::user()->smtp_unusual_activity]);
        }
        if($request->post('smtp_new_browser')) {
            Auth::user()->update(['smtp_new_browser' => !Auth::user()->smtp_new_browser]);
        }
        return view('pages.account.security');
    }

    public function changePassword(Request $request) {
        return (new \App\Http\Services\Account\ServiceChangePassword)->handle($request->all());
    }

    public function billing() {
        return view('pages.account.billing');
    }

}
