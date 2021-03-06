<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Street;
use App\Models\Lamp;

class StreetController extends Controller
{
    /**
     * Lấy danh sách tất cả các tuyến đường
     *
     * @return void
     */
    public function list()
    {
        $data['streets'] = Street::all();
        return view('admin.streets.list', $data);
    }

    /**
     * Lấy danh sách tất cả các tuyến đường
     *
     * @return void
     */
    public function show($street_id)
    {
        $data['street'] = Street::findOrFail($street_id);
        return view('admin.streets.view', $data);
    }

    /**
     * Nhập thông tin để thêm tuyến đường mới
     *
     * @return void
     */
    public function create()
    {
        $data['provinces'] = Province::all();
        return view('admin.streets.create', $data);
    }


    /**
     * Thêm tuyến đường và các đèn vào CSDL
     *
     * @return void
     */
    public function store(Request $req)
    {
        $lamps = Lamp::whereIn('uid', $req->lamp_uid)->get();
        if($lamps->count() > 0) {
            return redirect()->back()->withInput()->withError('Trùng các id '.$lamps->pluck('uid'));
        }

        $data = $req->validate([
            'name' => 'required|string',
            'domain' => 'required|string',
            'ward_id' => 'required|integer',
            'district_id' => 'required|integer',
            'province_id' => 'required|integer'
        ]);
        $street = Street::create($data);

        foreach($req->lamp_uid as $lamp_uid) {
            $lamp_data = [
                'uid' => $lamp_uid,
                'street_id' => $street->id
            ];
            $lamp_id = Lamp::create($lamp_data);
        }

        return redirect()->route('user.streets.list');
    }

    /**
     * Sửa thông tin một tuyến đường nào đó
     *
     * @return void
     */
    public function edit($street_id)
    {
        $data['provinces'] = Province::all();
        // $data['districts'] = District::all();
        // $data['wards'] = Ward::all();
        $data['street'] = Street::findOrFail($street_id);
        return view('admin.streets.edit', $data);
    }
    
    /**
     * Lưu lại thay đổi những thay đổi chỉnh sửa
     * Những đèn nào không còn thuộc tuyến thì xoá đi
     * Thêm những đèn mới vào
     *
     * @return void
     */
    public function update($street_id, Request $req)
    {
        $street = Street::findOrFail($street_id);
        
        $data = $req->validate([
            'name' => 'required|string',
            'domain' => 'required|string',
            'ward_id' => 'required|integer',
            'district_id' => 'required|integer',
            'province_id' => 'required|integer'
        ]);
        $street->update($data);


        $lampofstreet = $street->lamps->pluck('uid')->toArray();
        $willadd = array_diff($req->lamp_uid, $lampofstreet);
        $willdel = array_diff($lampofstreet, $req->lamp_uid);
        Lamp::whereIn('uid', $willdel)->delete();
        
        foreach($willadd as $lamp_uid) {
            $lamp_data = [
                'uid' => $lamp_uid,
                'street_id' => $street->id
            ];
            $lamp_id = Lamp::create($lamp_data);
        }

        return redirect()->route('user.streets.edit', ['street'=>$street->id])->with('success', 'Lưu thay đổi thành công!'); 
    }

    /**
     * Xoá một tuyến đường
     *
     * @return void
     */
    public function delete($street_id)
    {
        $street = Street::findOrFail($street_id);
        $street->lamps()->delete();
        $street->delete();
        return redirect()->route('user.street.list.get');
    }

    public function reset($street_id)
    {
        $street = Street::findOrFail($street_id);
        foreach ($street->lamps as $lamp) {
            $lamp->update([
                'state' => 'normal', 
                'status' => 'off', 
                'level' => 10
            ]);
        } 
        
        $street->update([
            'state' => 'normal', 
            'status' => 'off', 
            'level' => 10
        ]);

        return redirect()->back();
    }
}