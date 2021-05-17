<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Bundler;
use App\Helpers\ApiHelper;
use Auth;

class BundlerController extends Controller
{
    protected function getValidationRules($api2 = false): array
    {
        $rules = [
            'title' => 'required|max:191',
            'description' => 'nullable',
            'endpoint_1' => 'required|url',
            'method_1' => 'required|in:get,post',
            'response_type_1' => 'required|in:single,multiple',
            'response_content_1' => 'required|in:JSON,XML',
            'headers_1' => 'nullable|array',
            'data_1' => 'nullable|array',
        ];
        if ($api2) {
            $rules2 = [
                'endpoint_2' => 'required|url',
                'method_2' => 'required|in:get,post',
                'response_type_2' => 'required|in:single,multiple',
                'response_content_2' => 'required|in:JSON,XML',
                'headers_2' => 'nullable|array',
                'data_2' => 'nullable|array',
            ];
            $rules = array_merge($rules, $rules2);
        }
        return $rules;
    }

    public function index()
    {
        $bundlers = Bundler::where('user_id', Auth::user()->id)->get();
        return view('bundlers.index', compact('bundlers'));
    }

    public function create()
    {
        return view('bundlers.create');
    }

    public function executeApi1(Request $request)
    {
        $rules = $this->getValidationRules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $apiHelper = new ApiHelper;
        $apiData = [
            'endpoint' => $request->endpoint_1,
            'method' => $request->method_1,
            'headers' => $request->headers_1,
            'data' => $request->data_1
        ];
        $result = $apiHelper->executeApi($apiData);
        Cache::put('current_api1_response_'.Auth::user()->id, $result);
        return response()->json([
            'success' => $result['success'],
            'result' => $result['message'],
        ]);
    }

    public function executeApi2(Request $request)
    {
        $rules = $this->getValidationRules(true);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $apiHelper = new ApiHelper;
        $apiData = [
            'endpoint' => $request->endpoint_2,
            'method' => $request->method_2,
            'headers' => $request->headers_2,
            'data' => $request->data_2
        ];
        $result = $apiHelper->executeApi($apiData);
        Cache::put('current_api2_response_'.Auth::user()->id, $result);
        return response()->json([
            'success' => $result['success'],
            'result' => $result['message'],
        ]);
    }

    public function executeCurrentBundler(Request $request)
    {
        $rules = $this->getValidationRules(true);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $apiHelper = new ApiHelper;
        $result = $apiHelper->currentBundlerResponse($request->all());
        Cache::put('current_bundler_response_'.Auth::user()->id, $result);
        return response()->json([
            'success' => $result['success'],
            'result' => $result['message']
        ]);
    }

    public function searchData(Request $request)
    {
        $search = explode('.', $request->search);
        if (Cache::has('current_api1_response_'.Auth::user()->id)) {
            if ($request->has('api_2')) {
                $savedResponse = Cache::get('current_api2_response_'.Auth::user()->id);
            } else {
                $savedResponse = Cache::get('current_api1_response_' . Auth::user()->id);
            }
            if ($savedResponse['success']) {
                $response = json_decode($savedResponse['message'], true);
                if (count($search) > 1) {
                    $invalids = 0;
                    for ($i = 1; $i < count($search); $i++) {
                        $index = $search[$i];
                        if ($index == '*') {
                            $index = 0;
                        }
                        if (isset($response[$index])) {
                            $response = $response[$index];
                        } else {
                            $invalids++;
                        }
                    }
                    if ($invalids == 1) {
                        $matched = [];
                        foreach ($response as $key => $value) {
                            if ($search[count($search) - 1] != '' && false !== strpos($key, $search[count($search) - 1])) {
                                $matched[$key] = $value;
                            }
                        }
                        if (count($matched) == 0) {
                            $matched = $response;
                        }
                    } else {
                        $matched = $response;
                    }
                }
            }

            return response()->json([
                'success' => true,
                'matched' => $matched ?? []
            ]);
        }
    }

    public function store(Request $request)
    {
        $rules = $this->getValidationRules(true);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $apiHelper = new ApiHelper;
        $headers_1 = $apiHelper->prepareHeaders($request->headers_1);
        $headers_2 = $apiHelper->prepareHeaders($request->headers_2);
        $data_1 = $apiHelper->prepareData($request->data_1);
        $data_2 = $apiHelper->prepareData($request->data_2, true);
        $modifications = $apiHelper->prepareModifications($request->modifications);
        $bundler = Bundler::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'endpoint_1' => $request->endpoint_1,
            'method_1' => $request->method_1,
            'response_type_1' => $request->response_type_1,
            'response_content_1' => $request->response_content_1,
            'headers_1' => json_encode($headers_1),
            'data_1' => json_encode($data_1),
            'endpoint_2' => $request->endpoint_2,
            'method_2' => $request->method_2,
            'response_type_2' => $request->response_type_2,
            'response_content_2' => $request->response_content_2,
            'headers_2' => json_encode($headers_2),
            'data_2' => json_encode($data_2),
            'modifications' => json_encode($modifications),
            'iterative_index' => $request->iterative_index,
        ]);
        $currentResponse = Cache::get('current_bundler_response_'.Auth::user()->id);
        Cache::put('bundler_response_'.$bundler->id, $currentResponse);
        Session::flash('flash.banner','Bundler successfully saved to database');
        Session::flash('flash.bannerStyle','success');
        return redirect()->route('bundlers.index');
    }

    public function edit($id)
    {
        $bundler = Bundler::findOrFail($id);
        return view('bundlers.edit', compact('bundler'));
    }

    public function update(Request $request, $id)
    {
        $rules = $this->getValidationRules(true);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $apiHelper = new ApiHelper;
        $headers_1 = $apiHelper->prepareHeaders($request->headers_1);
        $headers_2 = $apiHelper->prepareHeaders($request->headers_2);
        $data_1 = $apiHelper->prepareData($request->data_1);
        $data_2 = $apiHelper->prepareData($request->data_2, true);
        $modifications = $apiHelper->prepareModifications($request->modifications);
        $bundler = Bundler::findOrFail($id);
        $bundler->update([
            'title' => $request->title,
            'description' => $request->description,
            'endpoint_1' => $request->endpoint_1,
            'method_1' => $request->method_1,
            'response_type_1' => $request->response_type_1,
            'response_content_1' => $request->response_content_1,
            'headers_1' => json_encode($headers_1),
            'data_1' => json_encode($data_1),
            'endpoint_2' => $request->endpoint_2,
            'method_2' => $request->method_2,
            'response_type_2' => $request->response_type_2,
            'response_content_2' => $request->response_content_2,
            'headers_2' => json_encode($headers_2),
            'data_2' => json_encode($data_2),
            'modifications' => json_encode($modifications),
            'iterative_index' => $request->iterative_index,
        ]);
        $currentResponse = Cache::get('current_bundler_response_'.Auth::user()->id);
        Cache::put('bundler_response_'.$bundler->id, $currentResponse);
        Session::flash('flash.banner','Bundler successfully saved to database');
        Session::flash('flash.bannerStyle','success');
        return redirect()->route('bundlers.index');
    }

    public function output(Request $request)
    {
        if ($request->has('bundler_id')) {
            $bundler = Bundler::find($request->bundler_id);
            if (!$bundler) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid bundler id'
                ]);
            }
            if ($bundler->user_id == $request->user()->id) {
                if (Cache::has('bundler_response_' . $request->bundler_id)) {
                    $response = Cache::get('bundler_response_' . $request->bundler_id);
                    return response()->json([
                        'success' => $response['success'],
                        'result' => json_decode($response['message']),
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bundler response not found. Please execute the bundler to create response.'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bundler id not associated with current user'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Invalid request"
            ]);
        }
    }

    public function executeBundler($id)
    {
        $bundler = Bundler::findOrFail($id);
        $headers_1 = json_decode($bundler->headers_1, true);
        $data_1 = json_decode($bundler->data_1, true);
        $headers_2 = json_decode($bundler->headers_2, true);
        $data_2 = json_decode($bundler->data_2, true);
        $apiHelper = new ApiHelper;
        $parentResponse = $apiHelper->executeApi2($headers_1, $data_1, $bundler->method_1, $bundler->endpoint_1);
        $childResponse = $apiHelper->executeApi2($headers_2, $data_2, $bundler->method_2, $bundler->endpoint_2);
        $result = $apiHelper->bundlerResponse($bundler, $parentResponse, $childResponse);
        Cache::put('bundler_response_'.$bundler->id, $result);
        Session::flash('flash.banner','Bundler successfully executed');
        Session::flash('flash.bannerStyle','success');
        return redirect()->route('bundlers.index');
    }

    public function destroy(Request $request, $id)
    {
        $bundler = Bundler::findOrFail($id);
        $bundler->delete();
        Session::flash('flash.banner','Bundler successfully deleted');
        Session::flash('flash.bannerStyle','success');
        return redirect()->route('bundlers.index');
    }

    public function dashboard(){
        $bundlers               = Bundler::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit(5)->offset(0)->get();
        $ttlbundlers            = count($bundlers);
        $ttlactivebundlers      = 0;
        $ttlinactivebundlers    = 0;
        $ttlapitokens           = 0; 

        $apiTokens = [];
        if (Auth::user()->tokens->isNotEmpty()){
            $apiTokens      = Auth::user()->tokens;
            $ttlapitokens   = count($apiTokens);
        }
        /*if(isset($bundlers) && count($bundlers)>0){
            foreach($bundlers as $bundler){
                if(\Illuminate\Support\Facades\Cache::has('bundler_response_'.$bundler->id))
                    $ttlactivebundlers = $ttlactivebundlers +1;
                else $ttlinactivebundlers = $ttlinactivebundlers +1;
            }
        }*/
        return view('dashboard', compact('bundlers', 'ttlbundlers', 'ttlactivebundlers', 'ttlinactivebundlers', 'ttlapitokens', 'apiTokens'));
    }
}
