<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use DateTime;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = DB::table('transactions as t')
        ->select('t.id as id','u.name as peminjam','v.name as kendaraan','t.startDate as start','t.endDate as end','t.price as price',
        DB::raw('
        (CASE
        WHEN t.status="1" THEN "Dipinjam"
        WHEN t.status="2" THEN "Sudah Kembali"
        WHEN t.status="3" THEN "Hilang"
        END) AS status
        '),
        )
        ->join('users as u', 't.userId', '=', 'u.id')
        ->join('vehicles as v', 't.vehicleId', '=', 'v.id')
        ->orderBy('t.startDate', 'asc')
        ->get();
        return view('transaksi.daftarTransaksi', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $vehicles = Vehicle::all();
        return view("transaksi.peminjaman", compact('users', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $transaction = $request->validate(["userId" => "required","vehicleId" => "required","startDate" => "required","endDate" => "required",]);

            $transaction["status"] = 1;

            $startDate = new DateTime($transaction["startDate"]);
            $endDate = new DateTime($transaction["endDate"]);
            $daysDifference = $startDate->diff($endDate)->days;
            $dailyPrice = Vehicle::find($transaction["vehicleId"])->dailyPrice;

            $transaction["price"] = $dailyPrice * $daysDifference;

            Transaction::create($transaction);
            DB::commit();
            return redirect()->route("transaksi.daftarTransaksi");
        } catch (\Exception $e) {
            Db::rollback();
            return redirect()->route("kendaraan.daftarKendaraan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = DB::table('transactions as t')
        ->select('t.id as id','u.name as peminjam','v.name as kendaraan','t.startDate as start','t.endDate as end','t.price as price','t.status as status',)
        ->join('users as u', 't.userId', '=', 'u.id')
        ->join('vehicles as v', 't.vehicleId', '=', 'v.id')
        ->where('t.id', '=', $id)
        ->first();
        return view("transaksi.pengembalian", compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $transaction = $request->validate(["id" => "required","status" => "required",]);

            Transaction::find($request->id)->update($transaction);
            DB::commit();
            return redirect()->route("transaksi.daftarTransaksi");
        } catch (\Exception $e) {
            Db::rollback();
            return redirect()->route("transaksi.daftarTransaksi");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
