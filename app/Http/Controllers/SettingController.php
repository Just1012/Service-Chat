<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Services\SettingService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected $SettingService;

    public function __construct(SettingService $SettingService)
    {
        $this->SettingService = $SettingService;
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $systemInfo = Setting::first();
        return view('dashboard.setting.index', compact('systemInfo'));
    }

    public function updateAllSystemInfo(Request $request)
    {
        try {
            // Define validation rules
            $rules = [
                'slug_ar' => 'required|string|max:255',
                'slug_en' => 'required|string|max:255',
                'phone1' => 'nullable|string|max:20',
                'phone2' => 'nullable|string|max:20',
                'whatsapp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'facebook' => 'nullable|string|max:255',
                'instgram' => 'nullable|string|max:255',
                'video_link' => 'nullable|url|max:255',
                'pdf' => 'nullable|file|mimes:pdf|max:10240', // Allows PDF files up to 10 MB
            ];

            // Define custom validation messages
            $messages = [
                'slug_ar.required' => 'The Arabic slug is required.',
                'slug_ar.string' => 'The Arabic slug must be a string.',
                'slug_ar.max' => 'The Arabic slug may not be greater than 255 characters.',

                'slug_en.required' => 'The English slug is required.',
                'slug_en.string' => 'The English slug must be a string.',
                'slug_en.max' => 'The English slug may not be greater than 255 characters.',

                'phone1.string' => 'The phone number 1 must be a string.',
                'phone1.max' => 'The phone number 1 may not be greater than 20 characters.',

                'phone2.string' => 'The phone number 2 must be a string.',
                'phone2.max' => 'The phone number 2 may not be greater than 20 characters.',

                'whatsapp.string' => 'The WhatsApp number must be a string.',
                'whatsapp.max' => 'The WhatsApp number may not be greater than 20 characters.',

                'email.email' => 'The email address must be a valid email format.',
                'email.max' => 'The email address may not be greater than 255 characters.',

                'facebook.string' => 'The Facebook URL must be a string.',
                'facebook.max' => 'The Facebook URL may not be greater than 255 characters.',

                'instgram.string' => 'The Instagram URL must be a string.',
                'instgram.max' => 'The Instagram URL may not be greater than 255 characters.',

                'video_link.url' => 'The video link must be a valid URL.',
                'video_link.max' => 'The video link may not be greater than 255 characters.',

                'pdf.mimes' => 'The uploaded file must be a PDF document.',
                'pdf.max' => 'The PDF file size must not exceed 10 MB.',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Retrieve the system info instance
            $systemInfo = Setting::first(); // Assuming you have only one row

            if (!$systemInfo) {
                $systemInfo = new Setting(); // Create a new instance if no row exists
            }

            // Update the fields with validated data
            $systemInfo->slug_ar = $request->input('slug_ar');
            $systemInfo->slug_en = $request->input('slug_en');
            $systemInfo->phone1 = $request->input('phone1');
            $systemInfo->phone2 = $request->input('phone2');
            $systemInfo->whatsapp = $request->input('whatsapp');
            $systemInfo->email = $request->input('email');
            $systemInfo->facebook = $request->input('facebook');
            $systemInfo->instagram = $request->input('instagram');
            $systemInfo->video_link = $request->input('video_link');

            // Handle the file upload for the PDF
            if ($request->hasFile('pdf')) {
                $pdfFile = $request->file('pdf');
                $pdfName = time() . '.' . $pdfFile->getClientOriginalExtension();
                $pdfPath = $pdfFile->storeAs('pdfs', $pdfName, 'public'); // Save the file in storage/app/public/pdfs

                // Delete the old PDF file if it exists
                if ($systemInfo->pdf && file_exists(public_path('storage/' . $systemInfo->pdf))) {
                    unlink(public_path('storage/' . $systemInfo->pdf));
                }

                $systemInfo->pdf = $pdfPath;
            }

            // Save the updated system info
            $systemInfo->save();

            // Return success message
            toastr()->success(__('System Information Updated Successfully'), __('Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            // Return error message
            toastr()->error(__('An error occurred. Try Again'), __('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    // public function datatable()
    // {
    //     $data = Setting::all();
    //     return response()->json([
    //         'data' => $data,
    //         'message' => 'found data'
    //     ]);
    // }

    // public function create()
    // {
    //     return view('dashboard.setting.create', ['type_page' => 'create']);
    // }
    // public function edit(Setting $setting)
    // {
    //     return view('dashboard.setting.create', ['type_page' => '', 'data' => $setting]);
    // }

    // public function store(Request $SettingRequest)
    // {
    //     $result = $this->SettingService->storeSetting($SettingRequest);
    //     return redirect()->route('setting.index');
    // }


    public function editTerms()
    {
        $terms = Term::first();
        return view('dashboard.setting.terms', compact('terms'));
    }

    public function updateTerms(Request $request)
    {
        try {
            // Define validation rules
            $rules = [
                'terms_ar' => 'required|string',
                'terms_en' => 'required|string',
            ];

            // Validate the request data
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Update the data
            $terms = Term::first(); // Assuming you have only one row
            if (!$terms) {
                $terms = new Term(); // Create a new instance if no row exists
            }

            $terms->terms_ar = $request->terms_ar;
            $terms->terms_en = $request->terms_en;
            $terms->save();

            toastr()->success(__('Privacy Policy Updated Successfully'), __('Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error(__('An error occurred. Try Again'), __('Error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
