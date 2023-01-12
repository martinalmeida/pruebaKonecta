<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use DataTables;
use Hash;


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
                ->whereIn('productos.status', array(1, 2))
                ->orderBy('productos.nombreProducto', 'desc')
                ->get(['productos.id', 'productos.nombreProducto', 'productos.referencia', 'productos.precio', 'productos.peso', 'c.categoria', 'st.cantidad', 'productos.created_at', 'u.name', 'productos.status AS estado']);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $butons = '<div class="text-center"><a onclick="listData(' . $row['id'] . ');" class="btn btn-success btn-sm text-white" title="Editar Usuario"><i class="fal fa-user-edit"></i></a> ';
                    $butons .= '<a onclick="statusChange(' . $row['id'] . ', ' . $row['estado'] . ');" class="btn btn-primary btn-sm text-white" title="Cambiar Estado"><i class="fal fa-exchange-alt"></i></a> ';
                    $butons .= '<a onclick="deleteRegister(' . $row['id'] . ');" class="btn btn-danger btn-sm text-white" title="Eliminar Usuario"><i class="fal fa-trash"></i></a></div>';
                    return $butons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tablaProductos');
    }

    // public function selectRol(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $roles = Rol::select('id', 'rol')->get();
    //     }
    //     return response()->json($roles);
    // }

    // public function create(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $create = User::create([
    //             'rolId' => $request->rol,
    //             'name' => $request->nombre,
    //             'email' => $request->correo,
    //             'password' => Hash::make($request->password)
    //         ]);
    //     }
    //     $create ? $response = ['status' => true] : $response = ['status' => false];
    //     return response()->json($response);
    // }

    // public function selectUser($id)
    // {
    //     $user = User::where('id', $id)->get();
    //     return response()->json($user);
    // }

    // public function update(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $update = User::where('id', $request->idUser)
    //             ->limit(1)->update(['rolId' => $request->rol, 'name' => $request->nombre, 'email' => $request->correo, 'password' => Hash::make($request->password)]);
    //     }
    //     $update ? $response = ['status' => true] : $response = ['status' => false];
    //     return response()->json($response);
    // }

    // public function status($id, $status)
    // {
    //     $status == 1 ? $change = 2 : $change = 1;
    //     $update = User::where('id', $id)
    //         ->limit(1)->update(['status' => $change]);
    //     $update ? $response = ['status' => true] : $response = ['status' => false];
    //     return response()->json($response);
    // }

    // public function delete($id)
    // {
    //     $update = User::where('id', $id)
    //         ->limit(1)->update(['status' => 3]);
    //     $update ? $response = ['status' => true] : $response = ['status' => false];
    //     return response()->json($response);
    // }
}
