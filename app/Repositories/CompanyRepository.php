<?php

namespace App\Repositories;

use App\Models\Companies\Company;
use App\Models\Companies\CompanyApi;
use App\Models\Companies\CompanyIp;
use LengthException;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class CompanyRepository extends EloquentRepository
{
    protected $entity = Company::class;
    protected $entity2 = CompanyApi::class;

    function save($request)
    {
        //dd($request->all());
        $data = ['error', 'error'];
        //dd($request->all());


        if ($request->get('id')) {
            $company = Company::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $company = new Company();
            $action = 'created';
        }
        // dd($request);
        $company->title = $request->get('title');
        $company->description = $request->get('description');
        $company->email = $request->get('email');
        $company->accountingCode = $request->get('accountingCode');
        $company->isActive = $request->boolean('isActive');
        $company->maxTransactionLimit = $request->get('maxTransactionLimit');
        $company->percentage = $request->get('percentage');
        $company->limitControl = $request->get('limitControl');
        $company->ballance = $request->get('ballance');
        $company->constantPercentage = $request->boolean('constantPercentage');
        $company->sms = $request->boolean('sms');
        $company->mail = $request->boolean('mail');
        $company->unlimited = $request->boolean('unlimited');
        $company->preOrders = $request->boolean('preOrders');
        $company->status = 1;//$request->get('status');
        $company->save();

        if($company){

            //Api Tab --
            if($request->get('id')) {
                $companyApi = CompanyApi::where('company_id', $request->get('id'))->first();
                if(!$companyApi)
                {
                    $companyApi = new CompanyApi();
                }
                $action = 'updated';
            } else {
                $companyApi = new CompanyApi();
            }
            $companyApi->company_id=$company->id;
            $companyApi->authorization = $request->get('authorization');
            $companyApi->api_name = $request->get('api_name');
            $companyApi->api_key = $request->get('api_key');
            $companyApi->feedback_url = $request->get('feedback_url');
            $companyApi->client_id = $request->get('client_id');
            $companyApi->client_key = $request->get('client_key');
            $companyApi->save();

            // Ip Tab --
            // if($request->get('id')) {
            //     $companyApi = CompanyApi::where('id', $request->get('id'))->first();
            //     $action = 'updated';
            // } else {
            //     $companyApi = new CompanyApi();
            // }
            // get Textarea value, turn to an array and save each element.
            

            $tempArr = preg_split('/\r\n|[\r\n]/', $request->get('ip'));
            $companyIp = CompanyIp::where('company_id', $request->get('id'))
                    
                    ->delete();
            foreach ($tempArr as $item) {
                if($request->get('id')) {
                    $companyIp = CompanyIp::where('company_id', $request->get('id'))
                    ->where('ip',$item)
                    ->first();
                    if(!$companyIp)
                    {
                        $companyIp = new CompanyIp();
                    }
                    $action = 'updated';
                } else {
                    $companyIp = new CompanyIp();
                }
                
                $companyIp->ip = $item;
                $companyIp->company_id = $company->id;
                $companyIp->save();
            }
        }
        
        if ($company) {
            $data = ['success' => 'Company ' . $action . ' successfully.'];
        }
        return $data;
    }
    function allData()
    {
        $data = Company::latest()->get();
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Company::latest()->get();
        $show = 'companiesProduct';
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'title' => $row->title,
                    'description' => $row->description,
                    'email' => $row->email,
                    'ballance' => $row->ballance,
                    'isActive' => $row->isActive,
                    // 'status' => $row->status,
                    'action' => '<div class="button-block"><a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btnRepo edit btn-outline-warning btn-sm"><i class="bx bx-edit"></i></a>
                                <form action="' . $show . '" id="formshow" name="formshow" method="GET" enctype="multipart/form-data">                             
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                                      
                                <button class="btn btnRepo update btn-outline-success btn-sm"data-id="' . $row->id . '"><i class="bx bx-show"></i></button>                               
                                </form>
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn delete btnRepo btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a>
                                </div>'
                ];
            }
        }
        return $data;
    }
}
