<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     //
    //     // $datas = User::all();
    //     // return response()->json($datas);
    //     // $datas = User::all();
    //     $datas = User::selectRaw('*, users.id as id, divisions.name as division_name, users.name as name, members.gender as member_gender, members.address as member_address, members.nip as member_nip, members.nip as member_nip ')->leftjoin('members', 'members.user_id', '=', 'users.id')
    //         ->leftjoin('divisions', 'members.division_id', '=', 'divisions.id')->where('roles', 'MEMBER')->get();
    //     // dd($datas);

    //     return view('admin.usermanagement.usermanagement', compact('datas'));
    // }
    public function index(Request $request)
    {
        $datas = User::selectRaw('*, users.id as id, divisions.name as division_name, users.name as name, members.gender as member_gender, members.address as member_address, members.nip as member_nip, members.nip as member_nip ')
            ->leftJoin('members', 'members.user_id', '=', 'users.id')
            ->leftJoin('divisions', 'members.division_id', '=', 'divisions.id')
            ->where('roles', 'MEMBER')
            ->orderBy('users.id', 'desc') // Change 'users.id' to the actual column you want to use for sorting
            ->simplePaginate(10); // Set the number of items per page

        return view('admin.usermanagement.usermanagement', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $divisions = Division::all();
        return view('admin.usermanagement.adduser', compact('divisions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required',
                'division_id' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'nip' => 'required|unique:members',
            ], [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'phone.required' => 'No Hp wajib diisi',
                'password.required' => 'Password wajib diisi',
                'division_id.required' => 'Divisi wajib diisi',
                'gender.required' => 'Jenis Kelamin wajib diisi',
                'address.required' => 'Alamat wajib diisi',
                'nip.required' => 'NIP wajib diisi',
            ]);

            // Buat user baru
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
            $user->roles = 'MEMBER';
            $user->save();

            $member = new Member();
            $member->user_id = $user->id;
            $member->name = $user->name;
            $member->division_id = $request->input('division_id');
            $member->gender = $request->input('gender');
            $member->address = $request->input('address');
            $member->nip = $request->input('nip');
            $member->save();

            return redirect('/admin/usermanagement')->with(['success' => 'Data Berhasil Ditambah!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Data Gagal Ditambah!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = User::with(['member', 'member.division'])->findOrFail($id);

            return view('admin.usermanagement.detailuser', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        {

            // $datas = User::find($id);

            $divisions = Division::all();
            // $members = Member::all();
            // $admins = Admin::all();
            $datas = User::selectRaw('*, users.name as users_name, divisions.name as division_name, users.name as name, members.gender as member_gender, members.address as member_address, members.nip as member_nip, members.nip as member_nip ')->leftjoin('members', 'members.user_id', '=', 'users.id')
                ->leftjoin('divisions', 'members.division_id', '=', 'divisions.id')->where('users.id', $id)->first();
            // $roomfacility = RoomFacility::all();
            // dd($datas);
            return view('admin.usermanagement.edituser', compact('datas', 'divisions', 'id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;

            if ($request->password !== '') {
                $data['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($data);

            Member::where('user_id', $id)->update([
                'division_id' => $request->division_id,
                'address' => $request->address,
                'gender' => $request->gender,
                'nip' => $request->nip,
            ]);

            return redirect()->to('admin/usermanagement')->with(['success' => 'Data Berhasil Diupdate!']);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $datas = User::findOrFail($id);
        $datas->delete();

        if ($datas) {
            //redirect dengan pesan sukses
            return redirect()->route('usermanagement')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usermanagement')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
