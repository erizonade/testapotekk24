<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $columns = ['id', 'foto', 'nama_member', 'nomor_ktp', 'email', 'tanggal_lahir', 'no_hp', 'jenis_kelamin'];


            $totalData = Member::selectRaw('*')->count();
            $totalFiltered = $totalData;

            $search       = $request['search']['value'];
            $limit_Start  = $request['start'];
            $limit_Length = $request['length'];
            $order_col    = $columns[$request['order'][0]['column']];
            $order_dir    = $request['order'][0]['dir'];

            $bookss = Member::selectRaw('*');

            if (!empty($search)) {
                $bookss->whereRaw('(nama_member LIKE  "%' . $search . '%" OR email LIKE  "%' . $search . '%")');
            }

            $totalFiltered = $bookss->count();
            $booksss = $bookss->offset($limit_Start)
                ->limit($limit_Length)
                ->orderBy($order_col, $order_dir)
                ->get();


            $data = array();
            $no = $limit_Start + 1;
            foreach ($booksss as $res) {
                $data[] = array(
                    $no++,
                    '<img width="50px" src="/data/images/' . $res->foto . '">',
                    $res->nama_member,
                    ($res->jenis_kelamin == 'L' ? 'Laki - laki' : 'Perempuan'),
                    $res->nomor_ktp,
                    $res->email,
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id . '">Edit</button>
                    <button class="btn btn-sm btn-warning view" data-id="' . $res->id . '">View</button>
                    <button class="btn btn-sm btn-danger delete" data-id="' . $res->id . '">Delete</button>'
                );
            }

            $dataTable = [];
            $dataTable['draw']            = $request['draw'];
            $dataTable['recordsTotal']    = $totalData;
            $dataTable['recordsFiltered'] = $totalFiltered;
            $dataTable['data']            = $data;


            $response = [
                'response' => [
                    'success' => 200,
                    'message' => 'Members',
                    'data'    => $dataTable
                ]
            ];

            return response()->json($response);
        }

        return view('/admin/member',)->with('activeTab', 'data-member');
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
        $rules = [
            'nama_member'   => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'no_hp'         => 'required|unique:members,no_hp|regex:/^[0-9]+$/|min:8|max:13',
            'foto'          => 'required|image|mimes:jpeg,png,jpg|max:1000',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'email'         => 'required|unique:users,email',
            'password'      => 'required|min:6',
            'nomor_ktp'     => 'required|numeric|digits_between:10,16|unique:members,nomor_ktp',
        ];

        $msg = [
            'required' => ':attribute wajib di isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => ':attribute Sudah Ada',
            'mimes'    => 'Hanya Bisa berupa Gambar',
            'max'      => 'Maximal 1Mb',
        ];

        $request->validate($rules, $msg);

        $folder = 'data/images/';
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $fotos = time() . "." . $foto_file->getClientOriginalExtension();
        }

        if ($request->hasFile('foto')) {
            $foto_file->move($folder, $fotos);
        }

        $data['nama_member']   = $request->nama_member;
        $data['email']         = $request->email;
        $data['password']      = bcrypt($request->password);
        $data['no_hp']         = $request->no_hp;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['nomor_ktp']     = $request->nomor_ktp;
        $data['foto']          = $fotos;
        $data['created_at']    = Carbon::now();

        Member::insert($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Created Data'
            ]
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Member::find($id);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Data',
                'data'    => $data
            ]
        ];

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Member::find($id);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Data',
                'data'    => $data
            ]
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'nama_member'   => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'no_hp'         => 'required|regex:/^[0-9]+$/|min:8|max:13|unique:members,no_hp,' . $id . ',id',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'email'         => 'required|unique:users,email,' . $id . ',id',
            'nomor_ktp'     => 'required|numeric|digits_between:10,16|unique:members,nomor_ktp,' . $id . ',id',
        ];

        if (!empty($request->password)) {
            $rules = [
                'password' => 'required|min:6'
            ];
        }

        if (!empty($request->password)) {
            $rules = [
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ];
        }
        $msg = [
            'required' => ':attribute wajib di isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => ':attribute Sudah Ada',
            'mimes'    => 'Hanya Bisa berupa Gambar',
            'max'      => 'Maximal 1Mb',
        ];


        $request->validate($rules, $msg);

        $folder = 'data/images/';
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $fotos = time() . "." . $foto_file->getClientOriginalExtension();
        }

        $book_olds = Member::find($id);
        $foto_lama = $book_olds->foto;

        if ($request->hasFile('foto')) {
            $foto_file->move($folder, $fotos);
            File::delete($folder . $foto_lama);
        }

        $data['nama_member']   = $request->nama_member;
        $data['email']         = $request->email;
        if (!empty($request->password)) {
            $data['password']      = bcrypt($request->password);
        }
        $data['no_hp']         = $request->no_hp;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['nomor_ktp']     = $request->nomor_ktp;
        $data['foto']          = (empty($fotos) ? $foto_lama : $fotos);
        $data['updated_at'] = Carbon::now();

        Member::where('id', $id)->update($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Updated Data'
            ]
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $folder     = 'data/images/';
        //*-start delete image-*//
        $member_old = Member::find($id);
        $foto_lama  = $member_old->foto;
        File::delete($folder . $foto_lama);
        //*-start delete image-*//


        Member::where('id', $id)->delete();

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Delete Data'
            ]
        ];

        return response()->json($response);
    }

    public function list_member()
    {
        //
        $data = Member::all();

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'List Data Json',
                'data'    => $data
            ]
        ];

        return response()->json($response);
    }
}
