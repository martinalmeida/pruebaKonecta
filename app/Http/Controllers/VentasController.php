<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Stock;
use DataTables;


class VentasController extends Controller
{
    public function index()
    {
        return view('ventas.ventas', ['routeActive' => 'venta']);
    }

    public function dataTableVentas(Request $request)
    {
        if ($request->ajax()) {
            $data = Venta::join('stock AS s', 's.id', '=', 'ventas.stockId')
                ->join('productos AS p', 'p.id', '=', 's.productoId')
                ->join('categorias AS c', 'c.id', '=', 'p.categoriaId')
                ->join('status AS st', 'st.id', '=', 'ventas.status')
                ->join('users AS u', 'u.id', '=', 'ventas.userId')
                ->select(
                    'ventas.id',
                    'p.nombreProducto',
                    'c.categoria',
                    'ventas.personaVenta',
                    'ventas.cantidad',
                    'ventas.descripcion',
                    'u.name',
                    'st.status AS estado',
                    'ventas.status',
                )
                ->whereIn('ventas.status', array(1, 2))
                ->orderBy('ventas.id', 'desc')
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $butons = '<div class="text-center"><a onclick="listData(' . $row['id'] . ');" class="btn btn-success btn-sm text-white" title="Editar Venta"><i class="fal fa-pencil-alt"></i></a> ';
                    $butons .= '<a onclick="statusChange(' . $row['id'] . ', ' . $row['status'] . ');" class="btn btn-primary btn-sm text-white" title="Cambiar Estado"><i class="fal fa-exchange-alt"></i></a> ';
                    $butons .= '<a onclick="deleteRegister(' . $row['id'] . ');" class="btn btn-danger btn-sm text-white" title="Eliminar Venta"><i class="fal fa-trash"></i></a></div>';
                    return $butons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tablaVentas');
    }

    public function selectProductosStock(Request $request)
    {
        if ($request->ajax()) {
            $producto = Stock::join('productos AS p', 'p.id', '=', 'stock.productoId')
                ->select(
                    'stock.id',
                    'p.nombreProducto',
                )
                ->where('stock.status', '=', 1)
                ->orderBy('p.nombreProducto', 'desc')
                ->get();
        }
        return response()->json($producto);
    }

    public function create(Request $request)
    {
        $create = FALSE;
        if ($request->ajax()) {
            $cantidad = Stock::where('id', $request->stockId)->select('cantidad')->get();
            if ($request->cantidad < $cantidad[0]['cantidad']) {
                $create = Venta::create([
                    'stockId' => $request->stockId,
                    'userId' => $request->userId,
                    'personaVenta' => $request->personaVenta,
                    'cantidad' => $request->cantidad,
                    'descripcion' => $request->descripcion
                ]);
            }
        }
        $create ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function selectVenta($id)
    {
        $venta = Venta::where('id', $id)->get();
        return response()->json($venta);
    }

    public function update(Request $request)
    {
        $update = FALSE;
        if ($request->ajax()) {
            $cantidad = Stock::where('id', $request->stockId)->select('cantidad')->get();
            if ($request->cantidad < $cantidad[0]['cantidad']) {
                $update = Venta::where('id', $request->idVenta)
                    ->limit(1)->update([
                        'stockId' => $request->stockId,
                        'userId' => $request->userId,
                        'personaVenta' => $request->personaVenta,
                        'cantidad' => $request->cantidad,
                        'descripcion' => $request->descripcion
                    ]);
            }
        }
        $update ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function status($id, $status)
    {
        $status == 1 ? $change = 2 : $change = 1;
        $status = Venta::where('id', $id)
            ->limit(1)->update(['status' => $change]);
        $status ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function delete($id)
    {
        $delete = Venta::where('id', $id)
            ->limit(1)->update(['status' => 3]);
        $delete ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }
}
