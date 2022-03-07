<?php

namespace App\Http\Controllers;

use App\Models\Companies\Company;
use App\Models\Flag;
use App\Models\MainCategory;
use App\Models\Supplier;
use App\Models\Platform;
use App\Models\Transaction;
use App\Repositories\AccountActivitiesRepository;
use App\Repositories\BankAccountsRepository;
use App\Repositories\BankDefinitionRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EpinProductEntitiesRepository;
use App\Repositories\EpinProductRepository;
use App\Repositories\EpinStockRepository;
use App\Repositories\GenbaOrderLogsShredRepository;
use App\Repositories\GenbaPriceRepository;
use App\Repositories\GenbaProductRepository;
use App\Repositories\GenresRepository;
use App\Repositories\PlatformRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class AjaxMainController extends Controller
{

    public function __construct(
        SupplierRepository $supplierRepository,
        CompanyRepository $companyRepository,
        PlatformRepository $platformRepository,
        GenresRepository $genresRepository,
        GenbaProductRepository $genbaProductRepository,
        GenbaPriceRepository $genbaPriceRepository,
        CategoryRepository $categoryRepository,
        EpinProductRepository $epinProductRepository,
        EpinProductEntitiesRepository $epinProductEntitiesRepository,
        EpinStockRepository $epinStockRepository,
        TransactionRepository $transactionRepository,
        BankDefinitionRepository $bankDefinitionRepository,
        BankAccountsRepository $bankAccountRepository,
        AccountActivitiesRepository $accountActivitiesRepository,
        GenbaOrderLogsShredRepository $genbaOrderLogsShredRepository
    ) {
        $this->supplierRepo = $supplierRepository;
        $this->companyRepo = $companyRepository;
        $this->platformRepo = $platformRepository;
        $this->genresRepo = $genresRepository;
        $this->genbaProductRepo = $genbaProductRepository;
        $this->genbaPriceRepo = $genbaPriceRepository;
        $this->categoryRepo = $categoryRepository;
        $this->epinProductRepo = $epinProductRepository;
        $this->epinProductEntitiesRepo = $epinProductEntitiesRepository;
        $this->epinStockRepo = $epinStockRepository;
        $this->transactionRepo = $transactionRepository;
        $this->bankRepo = $bankDefinitionRepository;
        $this->bankAccountRepo = $bankAccountRepository;
        $this->accountActivitiesRepo = $accountActivitiesRepository;
        $this->genbaOrderLogsShredRepo = $genbaOrderLogsShredRepository;
    }

    public function getAjaxData(Request $request)
    {   
        

        $data = [];
        $model = ($request->get('model')) ? $request->get('model') : null;
        $queryId = ($request->get('queryId')) ? $request->get('queryId') :null;
        if ($request->ajax()) {
            if ($model) {
                if ($model == 'genbaPrice') {
                    $data = $this->genbaPriceRepo->dataTable($request->get('id'));
                }
                if ($model == 'genbaOrderLogsShred') {
                    $data = $this->genbaOrderLogsShredRepo->dataTable();
                }
                if ($model == 'transaction') {
                    $data = $this->transactionRepo->dataTable($request->get('status'));
                }
                if ($model == 'accountActivities') {
                    $data = $this->accountActivitiesRepo->dataTable();
                }
                if ($model == 'supplier') {
                    $data = $this->supplierRepo->dataTable();
                }
                if ($model == 'genres') {
                    $data = $this->genresRepo->dataTable();
                }
                if ($model == 'company') {
                    $data = $this->companyRepo->dataTable();
                }
                if ($model == 'category') {
                    $data = $this->categoryRepo->dataTable();
                }
                if ($model == 'platform') {
                    $data = $this->platformRepo->dataTable();
                }
                if ($model == 'genbaProducts') {
                    $data = $this->genbaProductRepo->dataTable();
                }
                if ($model == 'epinProducts') {
                    $data = $this->epinProductRepo->dataTable();
                }
                if ($model == 'epinProductEntities') {              
                    if($queryId)
                    {
                        $data = $this->epinProductEntitiesRepo->dataTable($queryId);
                    }               
                }
                if ($model == 'Stock') {
                    $data = $this->epinStockRepo->dataTable();
                }

                if ($model == 'BankDefinition') {
                    $data = $this->bankRepo->dataTable();
                }
                if($model == 'bankAccounts') {
                    $data = $this->bankAccountRepo->dataTable();
                }



              
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
    }
    // public function getAjaxData2(Request $request)
    // {
    //     if ($request->ajax()) {
           
    //         $data = $this->genbaPriceRepo->dataTable2();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    public function flagStatus()
    {
 
        $flags = Flag::where('value',1)->get();
        $data = [];
        
        foreach ($flags as $item)
        {
            $data[] = $item;

            $temp = Flag::where('id',$item->id)->first();
            $temp->value=0;
            $temp->note +=1;
            $temp->save();
        }             
        return $data;
    }

    public function resetNote(Request $request)
    {
        if ($request->status == 103) {
            $temp = Flag::where('keys','wait')->first();  
            $temp->note=0;
            $temp->save(); 
            return redirect('/transactions?status=103');     
        }else if ($request->status == 301) {
            $temp = Flag::where('keys','preorder')->first();   
            $temp->note=0;
            $temp->save(); 
            return redirect('/transactions?status=301');                   
        }else if ($request->status == 100) {
            $temp = Flag::where('keys','success')->first();   
            $temp->note=0;
            $temp->save(); 
            return redirect('/transactions?status=100');                   
        }
      return redirect()->back();
    }

}
