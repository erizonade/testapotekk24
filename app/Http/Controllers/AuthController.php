<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('/auth/login');
    }

    public function login()
    {

        $credentials = $this->request->validate(
            [
                'email'     => ['required', 'email'],
                'password'  => ['required']
            ],
            [
                'required'  => ':attribute wajib di isi',
            ]
        );

        if (Auth::guard('member')->attempt($credentials)) {

            $this->request->session()->regenerate();
            $response = [
                'response' => [
                    'success' => '200',
                    'url'     => '/member/dashboard'
                ]
            ];
        } else if (Auth::guard('user')->attempt($credentials)) {

            $this->request->session()->regenerate();
            $response = [
                'response' => [
                    'success' => '200',
                    'url'     => '/admin/dashboard'
                ]
            ];
        } else {

            $response = [
                'response' => [
                    'error'   => '401',
                    'message' => 'Email dan Password Salah'
                ]
            ];
        }

        return response()->json($response);
    }

    public function registrasi(Request $request)
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
                'message' => 'Success Register Data'
            ]
        ];

        return response()->json($response);
    }

    public function logout()
    {
        if (Auth::guard('member')->check()) {
            Auth::guard('member')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect('/');
    }
}
