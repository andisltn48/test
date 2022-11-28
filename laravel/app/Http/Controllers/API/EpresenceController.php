<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Epresence;
use Auth;

class EpresenceController extends Controller
{
    public function insertPresence(Request $request)
    {
        $create = Epresence::create([
            'id_users' => Auth::user()->id,
            'type' => $request->type,
            'waktu' => $request->waktu
        ]);

        return response()->json([
            'message' => 'berhasil input presence',
            'data' => $create
        ],200);
    }

    public function approvePresence($id)
    {
        $presence = Epresence::findOrFail($id);
        $presence->update([
            'is_approve' => 1
        ]);

        return response()->json([
            'message' => 'berhasil approve presence',
            'data' => $presence
        ],200);
    }

    public function getPresence()
    {
        $usersId = User::where('npp_supervisor',Auth::user()->npp)->pluck('id');
        $presence = Epresence::whereIn('id_users',$usersId)->get();
        $response = null;
        $checkData = [
            'id_user' => 0,
            'waktu' => 0,
        ];
        if ($presence) {
            foreach ($presence as $key => $value) {

                $newTanggal = date('Y-m-d',strtotime($value->waktu));

                if ($checkData['id_user'] != $value->id_users && $checkData['waktu'] != $newTanggal)
                {
                    $presenceIn = Epresence::where('id_users',$value->id_users)->whereDate('waktu',$newTanggal)->where('type','IN')->first();
                    $presenceOut= Epresence::where('id_users',$value->id_users)->whereDate('waktu',$newTanggal)->where('type','OUT')->first();
                    $user = User::find($value->id_users);

                    $data['id'] = $value->id;
                    $data['nama_user'] = $user->name;
                    $data['tanggal'] = $newTanggal;
                    $data['waktu_masuk'] = date('H:i:s',strtotime($presenceIn->waktu));
                    $data['waktu_keluar'] = date('H:i:s',strtotime($presenceOut->waktu));
                    $data['status_masuk'] = $presenceIn->is_approve == 1 ? 'APPROVE' : 'REJECT';
                    $data['status_keluar'] = $presenceOut->is_approve == 1 ? 'APPROVE' : 'REJECT';

                    $response[] = $data;
                    $checkData['id_user'] = $value->id_users;
                    $checkData['waktu'] = $newTanggal;
                } else {
                    if ($checkData['waktu'] != $newTanggal)
                    {

                        $presenceIn = Epresence::where('id_users',$value->id_users)->whereDate('waktu',$newTanggal)->where('type','IN')->first();
                        $presenceOut= Epresence::where('id_users',$value->id_users)->whereDate('waktu',$newTanggal)->where('type','OUT')->first();
                        $user = User::find($value->id_users);

                        $data['id'] = $value->id;
                        $data['nama_user'] = $user->name;
                        $data['tanggal'] = $newTanggal;
                        $data['waktu_masuk'] = date('H:i:s',strtotime($presenceIn->waktu));
                        $data['waktu_keluar'] = date('H:i:s',strtotime($presenceOut->waktu));
                        $data['status_masuk'] = $presenceIn->is_approve == 1 ? 'APPROVE' : 'REJECT';
                        $data['status_keluar'] = $presenceOut->is_approve == 1 ? 'APPROVE' : 'REJECT';

                        $response[] = $data;
                        $checkData['id_user'] = $value->id_users;
                        $checkData['waktu'] = $newTanggal;
                    }
                }
            }
            return response()->json([
                'message' => 'berhasil get presence',
                'data' => $response
            ],200);
        }
        
    }
}
