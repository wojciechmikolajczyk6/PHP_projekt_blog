<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class SearchController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    function action(Request $request)
    {
        if($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('users')
                    ->orderBy('id', 'asc')
                    ->where('username', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')

                    ->get();

            } else {
                $data = DB::table('users')
                    ->orderBy('id', 'asc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
        <td>'.$row->id.'</td>
         <td>'.$row->username.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->email.'</td>
         <td><a href="/admin/editUser/'. $row->id.'">Edytuj</a></td>
         <td><form method="DELETE" action="/admin/editUser/'.$row->id.'/delete">
                <button class="text-danger">Usuń</button></form></td>
        </form>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">Brak uzytkownikow</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
