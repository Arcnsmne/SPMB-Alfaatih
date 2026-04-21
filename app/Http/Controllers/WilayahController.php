<?php

namespace App\Http\Controllers;

use App\Models\{Wilayah, Province, Regency, District, Village};
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $provinces = Province::orderBy('name')->get();
        return view('admin.wilayah.index', compact('provinces'));
    }

    public function create()
    {
        return redirect()->route('admin.wilayah.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:province,regency,district,village',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|string'
        ]);

        switch($request->type) {
            case 'province':
                Province::create(['id' => $this->generateId('province'), 'name' => $request->name]);
                break;
            case 'regency':
                Regency::create(['id' => $this->generateId('regency'), 'name' => $request->name, 'province_id' => $request->parent_id]);
                break;
            case 'district':
                District::create(['id' => $this->generateId('district'), 'name' => $request->name, 'regency_id' => $request->parent_id]);
                break;
            case 'village':
                Village::create(['id' => $this->generateId('village'), 'name' => $request->name, 'district_id' => $request->parent_id]);
                break;
        }

        return redirect()->route('admin.wilayah.index')->with('success', 'Data wilayah berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Try to find in all models
        $data = Province::find($id) ?? Regency::find($id) ?? District::find($id) ?? Village::find($id);
        return response()->json($data);
    }

    public function edit($id)
    {
        return redirect()->route('admin.wilayah.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:province,regency,district,village',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|string'
        ]);

        switch($request->type) {
            case 'province':
                Province::find($id)->update(['name' => $request->name]);
                break;
            case 'regency':
                Regency::find($id)->update(['name' => $request->name, 'province_id' => $request->parent_id]);
                break;
            case 'district':
                District::find($id)->update(['name' => $request->name, 'regency_id' => $request->parent_id]);
                break;
            case 'village':
                Village::find($id)->update(['name' => $request->name, 'district_id' => $request->parent_id]);
                break;
        }

        return redirect()->route('admin.wilayah.index')->with('success', 'Data wilayah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $deleted = Province::destroy($id) || Regency::destroy($id) || District::destroy($id) || Village::destroy($id);
        
        if($deleted) {
            return redirect()->route('admin.wilayah.index')->with('success', 'Data wilayah berhasil dihapus!');
        }
        
        return redirect()->route('admin.wilayah.index')->with('error', 'Data tidak ditemukan!');
    }

    private function generateId($type)
    {
        $prefix = ['province' => '1', 'regency' => '2', 'district' => '3', 'village' => '4'];
        $lastId = match($type) {
            'province' => Province::max('id'),
            'regency' => Regency::max('id'),
            'district' => District::max('id'),
            'village' => Village::max('id')
        };
        
        return $prefix[$type] . str_pad((intval($lastId) + 1), 4, '0', STR_PAD_LEFT);
    }

    public function getProvinces()
    {
        return response()->json(Province::orderBy('name')->get());
    }

    public function getRegencies($provinceId)
    {
        return response()->json(Regency::where('province_id', $provinceId)->orderBy('name')->get());
    }

    public function getDistricts($regencyId)
    {
        return response()->json(District::where('regency_id', $regencyId)->orderBy('name')->get());
    }

    public function getVillages($districtId)
    {
        return response()->json(Village::where('district_id', $districtId)->orderBy('name')->get());
    }

    public function getByLevel(Request $request)
    {
        $type       = $request->type;
        $search     = $request->search;
        $page       = $request->get('page', 1);
        $provinceId = $request->province_id;
        $regencyId  = $request->regency_id;

        switch ($type) {
            case 'province':
                $query = Province::query();
                if ($search) $query->where('name', 'like', "%{$search}%");
                $total = $query->count();
                $data  = $query->orderBy('name')->paginate(50, ['*'], 'page', $page);
                $items = collect($data->items())->map(fn($r) => [
                    'id' => $r->id, 'name' => $r->name, 'parent_name' => '-'
                ]);
                break;

            case 'regency':
                $query = Regency::with('province');
                if ($provinceId) $query->where('province_id', $provinceId);
                if ($search) $query->where('name', 'like', "%{$search}%");
                $total = $query->count();
                $data  = $query->orderBy('name')->paginate(50, ['*'], 'page', $page);
                $items = collect($data->items())->map(fn($r) => [
                    'id' => $r->id, 'name' => $r->name, 'parent_name' => $r->province->name ?? '-'
                ]);
                break;

            case 'district':
                $query = District::with('regency.province');
                if ($regencyId) $query->where('regency_id', $regencyId);
                elseif ($provinceId) $query->whereHas('regency', fn($q) => $q->where('province_id', $provinceId));
                if ($search) $query->where('name', 'like', "%{$search}%");
                $total = $query->count();
                $data  = $query->orderBy('name')->paginate(50, ['*'], 'page', $page);
                $items = collect($data->items())->map(fn($r) => [
                    'id'           => $r->id,
                    'name'         => $r->name,
                    'parent_name'  => $r->regency->name ?? '-',
                    'province_name'=> $r->regency->province->name ?? '-',
                ]);
                break;

            case 'village':
                $query = Village::with('district.regency.province');
                if ($regencyId) $query->whereHas('district', fn($q) => $q->where('regency_id', $regencyId));
                elseif ($provinceId) $query->whereHas('district.regency', fn($q) => $q->where('province_id', $provinceId));
                if ($search) $query->where('name', 'like', "%{$search}%");
                $total = $query->count();
                $data  = $query->orderBy('name')->paginate(50, ['*'], 'page', $page);
                $items = collect($data->items())->map(fn($r) => [
                    'id'           => $r->id,
                    'name'         => $r->name,
                    'parent_name'  => $r->district->name ?? '-',
                    'regency_name' => $r->district->regency->name ?? '-',
                    'province_name'=> $r->district->regency->province->name ?? '-',
                ]);
                break;

            default:
                return response()->json(['data' => [], 'total' => 0, 'pages' => 0]);
        }

        return response()->json([
            'data'  => $items,
            'total' => $total,
            'pages' => $data->lastPage()
        ]);
    }
}
