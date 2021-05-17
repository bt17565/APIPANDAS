<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;
use Auth;

class ApiHelper {
    public function prepareHeaders($data)
    {
        $headers = [];
        if (count($data['key']) > 0) {
            foreach ($data['key'] as $index => $key) {
                if ($key && $data['value'][$index]) {
                    $headers[$key] = $data['value'][$index];
                }
            }
        }
        return $headers;
    }

    public function prepareData($data, $dbValue = false)
    {
        $requestData = [];
        if (count($data['key']) > 0) {
            foreach ($data['key'] as $index => $key) {
                if ($key && $data['value'][$index]) {
                    if (!$dbValue && strpos($data['value'][$index], '1.') === 0) {
                        $search = explode('.', $data['value'][$index]);
                        if (Cache::has('current_api1_response_'.Auth::user()->id)) {
                            $savedResponse = Cache::get('current_api1_response_'.Auth::user()->id);
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
                                    if ($invalids == 0) {
                                        $requestData[$key] = $response;
                                    } else {
                                        $requestData[$key] = $data['value'][$index];
                                    }
                                }
                            }
                        }
                    } else {
                        $requestData[$key] = $data['value'][$index];
                    }
                }
            }
        }
        return $requestData;
    }

    public function prepareModifications($data)
    {
        $modifications = [];
        if (count($data['key']) > 0) {
            foreach ($data['key'] as $index => $key) {
                if ($key && $data['value'][$index]) {
                    $modifications[$key] = $data['value'][$index];
                }
            }
        }
        return $modifications;
    }

    public function executeApi($data)
    {
        $headers = $this->prepareHeaders($data['headers']);
        if (count($headers) > 0) {
            $http = Http::withHeaders($headers);
        }
        $requestData = $this->prepareData($data['data']);
        if ($data['method'] == 'get') {
            if (isset($http)) {
                $response = $http->get($data['endpoint'], $requestData);
            } else {
                $response = Http::get($data['endpoint'], $requestData);
            }
        } else {
            if (isset($http)) {
                $response = $http->post($data['endpoint'], $requestData);
            } else {
                $response = Http::post($data['endpoint'], $requestData);
            }
        }
        return [
            'success' => $response->successful(),
            'message' => json_encode($response->json(), JSON_PRETTY_PRINT)
        ];
    }

    public function executeApi2($headers, $data, $method, $endpoint)
    {
        if (count($headers) > 0) {
            $http = Http::withHeaders($headers);
        }
        if ($method == 'get') {
            if (isset($http)) {
                $response = $http->get($endpoint, $data);
            } else {
                $response = Http::get($endpoint, $data);
            }
        } else {
            if (isset($http)) {
                $response = $http->post($endpoint, $data);
            } else {
                $response = Http::post($endpoint, $data);
            }
        }
        return $response->json();
    }

    public function currentBundlerResponse($data)
    {
        $modifications = $this->prepareModifications($data['modifications']);
        if (count($modifications) > 0) {
            $parentResponse = Cache::get('current_api1_response_'.Auth::user()->id);
            $childResponse = Cache::get('current_api2_response_'.Auth::user()->id);
            $collection = $data['response_type_1'] == 'multiple';
            $response = $this->createBundlerResponse($parentResponse, $childResponse, $data, $collection);
        } else {
            $savedResponse = Cache::get('current_api1_response_'.Auth::user()->id);
            $response = json_decode($savedResponse['message'], true);
        }
        return [
            'success' => 'true',
            'message' => json_encode($response, JSON_PRETTY_PRINT)
        ];
    }

    public function createBundlerResponse($parentResponse, $childResponse, $data, $collection = false)
    {
        $api1 = json_decode($parentResponse['message'], true);
        $api2 = json_decode($childResponse['message'], true);
        $modifications = $this->prepareModifications($data['modifications']);
        $headers = $this->prepareHeaders($data['headers_2']);
        $requestData = $this->prepareData($data['data_2']);
        $response = [];
        if ($collection) {
            $iterative = Arr::get($api1, $data['iterative_index']);
            if (count($iterative) > 0) {
                foreach ($iterative as $item) {
                    foreach($modifications as $index => $value) {
                        $itemIndex = explode('.*.', $index)[1];
                        $valueIndex = str_replace('2.', '', $value);
                        if (strpos($value, '2.') !== false) {
                            if (count($requestData) > 0) {
                                foreach ($requestData as $key => $val) {
                                    if (strpos($val, '1.') !== false) {
                                        $dataIndex = explode('.*.', $val)[1];
                                        $requestData[$key] = $item[$dataIndex];
                                    }
                                }
                            }
                            $itemResponse = $this->executeApi2($headers, $requestData, $data['method_2'], $data['endpoint_2']);
                            $dataToAdd = Arr::get($itemResponse, $valueIndex);
                            $item = Arr::set($item, $itemIndex, $dataToAdd);
                        } else {
                            $item = Arr::set($item, $itemIndex, $value);
                        }
                    }
                    $response[] = $item;
                }
            }
            $response = Arr::set($api1, $data['iterative_index'], $response);
        } else {
            if (count($modifications) > 0) {
                foreach ($modifications as $index => $value) {
                    $api1Index = str_replace('1.', '', $index);
                    if (strpos($value, '2.') !== false) {
                        $value = str_replace('2.', '', $value);
                        $api2Value = Arr::get($api2, $value);
                    } else {
                        $api2Value = $value;
                    }
                    $response = Arr::set($api1, $api1Index, $api2Value);
                }
            }
        }
        return $response;
    }

    public function bundlerResponse($bundler, $parentResponse, $childResponse)
    {
        $modifications = json_decode($bundler->modifications, true);
        if (count($modifications) > 0) {
            $collection = $bundler->response_type_1 == 'multiple';
            $response = $this->createResponse($parentResponse, $childResponse, $bundler, $collection);
        } else {
            $response = $parentResponse;
        }
        return [
            'success' => 'true',
            'message' => json_encode($response, JSON_PRETTY_PRINT)
        ];
    }

    public function createResponse($parentResponse, $childResponse, $bundler, $collection = false)
    {
        $modifications = json_decode($bundler->modifications, true);
        $headers = json_decode($bundler->headers_2, true);
        $requestData = json_decode($bundler->data_2, true);
        $response = [];
        if ($collection) {
            $iterative = Arr::get($parentResponse, $bundler->iterative_index);
            if (count($iterative) > 0) {
                foreach ($iterative as $item) {
                    foreach($modifications as $index => $value) {
                        $itemIndex = explode('.*.', $index)[1];
                        $valueIndex = str_replace('2.', '', $value);
                        if (strpos($value, '2.') !== false) {
                            if (count($requestData) > 0) {
                                foreach ($requestData as $key => $val) {
                                    if (strpos($val, '1.') !== false) {
                                        $dataIndex = explode('.*.', $val)[1];
                                        $requestData[$key] = $item[$dataIndex];
                                    }
                                }
                            }
                            $itemResponse = $this->executeApi2($headers, $requestData, $bundler->method_2, $bundler->endpoint_2);
                            $dataToAdd = Arr::get($itemResponse, $valueIndex);
                            $item = Arr::set($item, $itemIndex, $dataToAdd);
                        } else {
                            $item = Arr::set($item, $itemIndex, $value);
                        }
                    }
                    $response[] = $item;
                }
            }
            $response = Arr::set($parentResponse, $bundler->iterative_index, $response);
        } else {
            if (count($modifications) > 0) {
                foreach ($modifications as $index => $value) {
                    $api1Index = str_replace('1.', '', $index);
                    if (strpos($value, '2.') !== false) {
                        $value = str_replace('2.', '', $value);
                        $api2Value = Arr::get($childResponse, $value);
                    } else {
                        $api2Value = $value;
                    }
                    $response = Arr::set($parentResponse, $api1Index, $api2Value);
                }
            }
        }
        return $response;
    }
}
