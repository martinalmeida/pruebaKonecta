<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Producto;
use DataTables;


class StockController extends Controller
{
    public function index()
    {
        return view('stock.stock', ['routeActive' => 'stock']);
    }

    public function dataTableStock(Request $request)
    {
        if ($request->ajax()) {
            $data = Stock::join('productos as p', 'p.id', '=', 'stock.productoId')
                ->join('categorias as c', 'c.id', '=', 'p.categoriaId')
                ->select(
                    'stock.id',
                    'p.nombreProducto',
                    'c.categoria',
                    'stock.cantidad',
                )
                ->selectRaw('CONCAT(stock.cantidad, "$") AS canti2')
                ->where('p.status', '=', 1)
                ->orderBy('p.nombreProducto', 'desc')
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $butons = '<div class="text-center"><a onclick="listData(' . $row['id'] . ');" class="btn btn-warning btn-sm text-white" title="Agregar Stock"><i class="fal fa-plus-circle"></i></a><div>';
                    return $butons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tablaStocks');
    }

    public function selectProducto(Request $request)
    {
        if ($request->ajax()) {
            $producto = Producto::select('id', 'nombreProducto')->get();
        }
        return response()->json($producto);
    }

    public function selectStock($id)
    {
        $stock = Stock::where('id', $id)->get();
        return response()->json($stock);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $update = Stock::where('id', $request->idStock)
                ->limit(1)->update([
                    'userId' => $request->userId,
                    'cantidad' => $request->cantidad
                ]);
        }
        $update ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }
}
