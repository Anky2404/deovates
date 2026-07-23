<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'emails.logs.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = EmailLog::with('template')->latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function view(string $uuid)
    {
        $log = EmailLog::with('template')->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix.$this->folder.'view', compact('log'));
    }
}
