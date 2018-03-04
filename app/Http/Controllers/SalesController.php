<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sales;
use App\Inventory;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find(decrypt($user_id));

        $sales = $user->profileSales()->paginate(10);

        // $months = ''; 
        // for ($i=1; $i < 13; $i++){
        //    $months .= date('m', mktime(0, 0, 0, $i, 1)) . ', ';
        // }

        // $months = explode(',', rtrim($months, ', '));

        // dd($months);

        // $array_months = explode(', ', $months);

        // // dd($array_months);

        // foreach ($array_months as $array_month) {
        //     $sales_price = $user->profileSales->where('created_at', '<=', date('F', strtotime($array_month)) . ' 00:00:00')->sum('price');
        // }

        // // dd($sales_price);

        // $inv_value = $user->profileInvs->where('date_reorder', '<=', date('Y-m-d', strtotime('today')))->sum('value');

        // // dd($sales_price, $inv_value);

        // $array_income = '';

        // foreach ($incomes as $income) {
        //     $array_income .= $income->value . ',';
        // }

        // $array_incomes = rtrim($array_income, ', ');


        // $inventories = $user->profileInvs;

        // $incomes = [1,2];

        // return view('sales.index')->with('user', $user)->with('sales', $sales)->with('incomes', $incomes)->with('months', $months);

        return view('sales.index')->with('user', $user)->with('sales', $sales);
    }

    public function indexDaily($user_id)
    {
        $user = User::find(decrypt($user_id));

        $start_day = date('Y-m-d', strtotime('today')) . ' 00:00:00';
        $end_day = date('Y-m-d', strtotime('today')) . ' 23:59:59';

        $today = $user->profileSales()->where('created_at', '>=', $start_day)->where('created_at', '<=', $end_day)->paginate(10);

        return view('sales.daily')->with('user', $user)->with('today', $today);
    }

    public function indexMonthlyRange(Request $request, $user_id)
    {
        $user = User::find(decrypt($user_id));

        // $months = ''; 
        // for ($i=1; $i < 13; $i++){
        //    $months .= date('m', mktime(0, 0, 0, $i, 1)) . ', ';
        // }

        $query_date_start = $request->year . $request->start_month;

        $query_date_end = $request->year . $request->end_month;

        if ($query_date_start > $query_date_end) {
            flash('Date range not valid!');

            return back();
        }

        // First day of the month.
        $start_month = date('Y-m-01', strtotime($query_date_start));

        // Last day of the month.
        $end_month = date('Y-m-t', strtotime($query_date_end));

        $sales = $user->profileSales()->whereBetween('created_at', [$start_month . ' 00:00:00', $end_month . ' 23:59:59'])->paginate(10);

        // $inventories = $user->profileInvs()->whereBetween('date_reorder', [$start_month, $end_month])->paginate(10);

        // $income_sales = $user->profileSales()->whereBetween('created_at', [$start_month . ' 00:00:00', $end_month . ' 23:59:59'])->sum('price');

        // $income_invs = $user->profileInvs()->whereBetween('date_reorder', [$start_month, $end_month])->sum('value');

        // $incomes = $income_sales - $income_invs;

        // dd($incomes);

        // return view('sales.index')->with('user', $user)->with('sales', $sales)->with('incomes', $incomes)->with('months', $months);
        return view('sales.index')->with('user', $user)->with('sales', $sales);
    }

    public function salesPrint($user_id, $year, $start_month, $end_month)
    {
        $user = User::find(decrypt($user_id));

        $query_date_start = $year . $start_month;

        $query_date_end = $year . $end_month;

        if ($query_date_start > $query_date_end) {
            flash('Date range not valid!');

            return back();
        }

        // First day of the month.
        $start_month = date('Y-m-01', strtotime($query_date_start));

        // Last day of the month.
        $end_month = date('Y-m-t', strtotime($query_date_end));

        $sales = $user->profileSales()->whereBetween('created_at', [$start_month . ' 00:00:00', $end_month . ' 23:59:59'])->paginate(10);

        return view('sales.print')->with('user', $user)->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id);
        return view('sales.edit', [$user->id, $sale->id])->with('sale', $sale)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id);

        $this->validate($request, [
            'cx' => 'required|max:255',
            'items' => 'required',
            'price' => 'required|integer',
        ]);

        $sale->cx = $request->cx;
        $sale->items = $request->items;
        $sale->price = $request->price;
        $sale->update();

        flash('Successfully updated sales!');

        return redirect()->route('sales.index', encrypt($user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $user = User::find(decrypt($user_id));
        $sale = Sales::find($id)->delete();

        flash('Successfully deleted sales!');

        return redirect()->route('sales.index', encrypt($user->id));
    }
}
