<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use DataTables;


class ProductosController extends Controller
{
    public function index()
    {
        return view('productos.productos', ['routeActive' => 'producto']);
    }

    public function dataTableProducto(Request $request)
    {
        if ($request->ajax()) {
            $data = Producto::join('categorias AS c', 'c.id', '=', 'productos.categoriaId')
                ->join('users AS u', 'u.id', '=', 'productos.userId')
                ->leftjoin('stock AS st', 'st.productoId', '=', 'productos.id')
                ->join('status AS s', 's.id', '=', 'productos.status')
                ->select(
                    'productos.id',
                    'productos.nombreProducto',
                    'productos.referencia',
                    'productos.peso',
                    'c.categoria',
                    'u.name',
                    's.status AS estado',
                    'productos.status',
                )
                ->selectRaw("CONCAT(productos.precio, '$') AS precio")
                ->selectRaw("REPLACE(DATE_FORMAT(productos.created_at, '%d %m %Y'), ' ', '/') AS creado")
                ->selectRaw("IFNULL(st.cantidad,0) AS cantidad")
                ->whereIn('productos.status', array(1, 2))
                ->orderBy('productos.nombreProducto', 'desc')
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $butons = '<div class="text-center"><a onclick="listData(' . $row['id'] . ');" class="btn btn-success btn-sm text-white" title="Editar Usuario"><i class="fal fa-user-edit"></i></a> ';
                    $butons .= '<a onclick="statusChange(' . $row['id'] . ', ' . $row['status'] . ');" class="btn btn-primary btn-sm text-white" title="Cambiar Estado"><i class="fal fa-exchange-alt"></i></a> ';
                    $butons .= '<a onclick="deleteRegister(' . $row['id'] . ');" class="btn btn-danger btn-sm text-white" title="Eliminar Usuario"><i class="fal fa-trash"></i></a></div>';
                    return $butons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tablaProductos');
    }

    public function selectCategoria(Request $request)
    {
        if ($request->ajax()) {
            $roles = Categoria::select('id', 'categoria')->get();
        }
        return response()->json($roles);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'categoriaId' => 'required',
                'userId' => 'required',
                'nombreProducto' => 'required',
                'referencia' => 'required',
                'precio' => 'required',
                'peso' => 'required'
            ]);
            $create = Producto::create($request->all());
        }
        $create ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function selectProducto($id)
    {
        $producto = Producto::where('id', $id)->get();
        return response()->json($producto);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $update = Producto::where('id', $request->idProducto)
                ->limit(1)->update([
                    'categoriaId' => $request->categoriaId,
                    'userId' => $request->userId,
                    'nombreProducto' => $request->nombreProducto,
                    'referencia' => $request->referencia,
                    'precio' => $request->precio,
                    'peso' => $request->peso
                ]);
        }
        $update ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function status($id, $status)
    {
        $status == 1 ? $change = 2 : $change = 1;
        $status = Producto::where('id', $id)
            ->limit(1)->update(['status' => $change]);
        $status ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }

    public function delete($id)
    {
        $delete = Producto::where('id', $id)
            ->limit(1)->update(['status' => 3]);
        $delete ? $response = ['status' => true] : $response = ['status' => false];
        return response()->json($response);
    }
}
