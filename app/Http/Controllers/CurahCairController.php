<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipperCC;
use App\Models\CommodityCC;
use App\Models\ShipperProductionCC;
use App\Models\CommodityProductionCC;

class CurahCairController extends Controller
{
    // ============================================================
    // DASHBOARD CURAH CAIR
    // ============================================================

    /**
     * Dashboard utama (4 card analisis + data komoditas dan shipper + chart top + chart produksi per tahun)
     */
public function dashboard(Request $request)
{
    // === Summary data ===
    $totalShippers    = ShipperCC::count();
    $totalCommodities = CommodityCC::count();
    $totalProduksi    = ShipperProductionCC::sum('produksi');

    // Top 5 Shippers
    $topShippers = ShipperProductionCC::with('shipper')
        ->selectRaw('shipper_id, SUM(produksi) as total')
        ->groupBy('shipper_id')
        ->orderByDesc('total')
        ->take(5)
        ->get();

    // Top 5 Commodities
    $topCommodities = CommodityProductionCC::with('commodity')
        ->selectRaw('commodity_id, SUM(produksi) as total')
        ->groupBy('commodity_id')
        ->orderByDesc('total')
        ->take(5)
        ->get();

    // Produksi per Tahun (tren tahunan) - tetap dari shipper
    $produksiPerTahun = ShipperProductionCC::selectRaw('tahun, SUM(produksi) as total')
        ->groupBy('tahun')
        ->orderBy('tahun', 'asc')
        ->get();

    $labels       = $produksiPerTahun->pluck('tahun');
    $dataProduksi = $produksiPerTahun->pluck('total');

    // === Filter Perbandingan ===
    $jenis       = $request->get('jenis', 'commodity'); // default commodity
    $bulanFilter = (int) $request->get('bulan', 12);

    // Tentukan sumber tahun & model produksi sesuai jenis
    if ($jenis === 'shipper') {
        $listNama = ShipperCC::select('id', 'name')->orderBy('name')->get();
        $productionModel = ShipperProductionCC::class;
        $foreignKey = 'shipper_id';
    } else {
        $listNama = CommodityCC::select('id', 'name')->orderBy('name')->get();
        $productionModel = CommodityProductionCC::class;
        $foreignKey = 'commodity_id';
    }

    // Ambil list tahun dari model produksi yang sesuai
    $listTahun = $productionModel::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    // Default tahun bila tidak ada di request
    $tahun1 = $request->get('tahun1', $listTahun->first() ?? now()->year);
    $tahun2 = $request->get('tahun2', $listTahun->first() ?? now()->year);

    $id1 = $request->get('id1');
    $id2 = $request->get('id2');

    // Default id1 & id2 kalau kosong
    if (!$id1 && $listNama->count() > 0) {
        $id1 = $listNama->first()->id;
    }
    if (!$id2 && $listNama->count() > 1) {
        $id2 = $listNama->skip(1)->first()->id;
    }

    // === Grafik 1 === (fresh query dari model)
    $raw1 = $productionModel::selectRaw('bulan, SUM(produksi) as total')
        ->when($id1, fn($q) => $q->where($foreignKey, $id1))
        ->where('tahun', $tahun1)
        ->whereBetween('bulan', [1, $bulanFilter])
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->all();

    $data1 = array_values(array_replace(array_fill(1, $bulanFilter, 0), $raw1));

    // === Grafik 2 === (fresh query terpisah)
    $raw2 = $productionModel::selectRaw('bulan, SUM(produksi) as total')
        ->when($id2, fn($q) => $q->where($foreignKey, $id2))
        ->where('tahun', $tahun2)
        ->whereBetween('bulan', [1, $bulanFilter])
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->all();

    $data2 = array_values(array_replace(array_fill(1, $bulanFilter, 0), $raw2));

    return view('curahCair.app', compact(
        'totalShippers',
        'totalCommodities',
        'totalProduksi',
        'topShippers',
        'topCommodities',
        'labels',
        'dataProduksi',
        'listTahun',
        'jenis','bulanFilter','tahun1','tahun2','id1','id2','listNama','data1','data2'
    ));
}







    // ============================================================
    // DATA PRODUKSI
    // ============================================================

     /**
     * view shipper produksi dan komoditas produksi
     */
    
    public function dataShipper(Request $request)
    {
        $shippers = ShipperCC::orderBy('name')->get();
        $queryShipper = ShipperProductionCC::with('shipper');

        if ($request->bulan)
            $queryShipper->where('bulan', $request->bulan);
        if ($request->tahun)
            $queryShipper->where('tahun', $request->tahun);

        $produksi = $queryShipper->get();

        return view('curahCair.data.shipper', compact('shippers', 'produksi'));
    }

    public function dataCommodity(Request $request)
    {
        $commodities = CommodityCC::orderBy('name')->get();
        $queryCommodity = CommodityProductionCC::with('commodity');

        if ($request->bulan)
            $queryCommodity->where('bulan', $request->bulan);
        if ($request->tahun)
            $queryCommodity->where('tahun', $request->tahun);

        $produksiCommodity = $queryCommodity->get();

        return view('curahCair.data.commodity', compact('commodities', 'produksiCommodity'));
    }

     /**
     * CRUD shipper produksi dan komoditas produksi
     */
    
     // ---- shipper ----
    public function createShipper()
    {
        $shippers = ShipperCC::all();
        return view('curahCair.create.ShipperProduksi', compact('shippers'));
    }

    public function storeShipper(Request $request)
    {
        $request->validate([
            'shipper_id' => 'required|exists:shippers_cc,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'produksi' => 'required|numeric|min:0',
        ]);

        ShipperProductionCC::create($request->only(['shipper_id', 'bulan', 'tahun', 'produksi']));

        return redirect()->route('Data_CC', ['type' => 'shipper'])
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function editShipper($id)
    {
        $data = ShipperProductionCC::findOrFail($id);
        $shippers = ShipperCC::all();
        return view('curahCair.edit.ShipperProduksi', compact('data', 'shippers'));
    }

    public function updateShipper(Request $request, $id)
    {
        $request->validate([
            'shipper_id' => 'required|exists:shippers_cc,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'produksi' => 'required|numeric|min:0',
        ]);

        $data = ShipperProductionCC::findOrFail($id);
        $data->update($request->only(['shipper_id', 'bulan', 'tahun', 'produksi']));

        return redirect()->route('Data_CC', ['type' => 'shipper'])
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroyShipper($id)
    {
        ShipperProductionCC::destroy($id);
        return redirect()->route('Data_CC', ['type' => 'shipper'])
            ->with('success', 'Data berhasil dihapus');
    }

     // ---- komoditas ----
    public function createCommodity()
    {
        $commodities = CommodityCC::all();
        return view('curahCair.create.CommodityProduksi', compact('commodities'));
    }

    public function storeCommodity(Request $request)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities_cc,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'produksi' => 'required|numeric|min:0',
        ]);

        CommodityProductionCC::create($request->only(['commodity_id', 'bulan', 'tahun', 'produksi']));

        return redirect()->route('Data_CC', ['type' => 'commodity'])
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function editCommodity($id)
    {
        $data = CommodityProductionCC::findOrFail($id);
        $commodities = CommodityCC::all();
        return view('curahCair.edit.CommodityProduksi', compact('data', 'commodities'));
    }

    public function updateCommodity(Request $request, $id)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities_cc,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'produksi' => 'required|numeric|min:0',
        ]);

        $data = CommodityProductionCC::findOrFail($id);
        $data->update($request->only(['commodity_id', 'bulan', 'tahun', 'produksi']));

        return redirect()->route('Data_CC', ['type' => 'commodity'])
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroyCommodity($id)
    {
        CommodityProductionCC::destroy($id);
        return redirect()->route('Data_CC', ['type' => 'commodity'])
            ->with('success', 'Data berhasil dihapus');
    }

    /**
     * CRUD nama shipper dan komoditas 
     */

     // ---- shipper----
     
    public function createShipperName()
    {
        return view('curahCair.create.shippername');
    }

    public function storeShipperName(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ShipperCC::create(['name' => $request->name]);

        return redirect()->route('Data_CC') // ✅ diarahkan ke Data Produksi
            ->with('success', 'Shipper berhasil ditambahkan');
    }

    public function editShipperName($id)
    {
        $shipper = ShipperCC::findOrFail($id);
        return view('curahCair.edit.shippername', compact('shipper'));
    }

    public function updateShipperName(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $shipper = ShipperCC::findOrFail($id);
        $shipper->update(['name' => $request->name]);

        return redirect()->route('Data_CC') // ✅ balik ke Data Produksi
            ->with('success', 'Shipper berhasil diperbarui');
    }

    public function destroyShipperName($id)
    {
        ShipperCC::destroy($id);
        return redirect()->route('Data_CC') // ✅ balik ke Data Produksi
            ->with('success', 'Shipper berhasil dihapus');
    }

    // ---- komoditas ----
    public function createCommodityName()
    {
        return view('curahCair.create.commodityname');
    }

    public function storeCommodityName(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        CommodityCC::create(['name' => $request->name]);

        return redirect()->route('Data_CC') // ✅ balik ke Data Produksi
            ->with('success', 'Commodity berhasil ditambahkan');
    }

    public function editCommodityName($id)
    {
        $commodity = CommodityCC::findOrFail($id);
        return view('curahCair.edit.commodityname', compact('commodity'));
    }

    public function updateCommodityName(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $commodity = CommodityCC::findOrFail($id);
        $commodity->update(['name' => $request->name]);

        return redirect()->route('Data_CC') // ✅ balik ke Data Produksi
            ->with('success', 'Commodity berhasil diperbarui');
    }

    public function destroyCommodityName($id)
    {
        CommodityCC::destroy($id);
        return redirect()->route('Data_CC') // ✅ balik ke Data Produksi
            ->with('success', 'Commodity berhasil dihapus');
    }

    // ============================================================
    // ANALISIS SHIPPER
    // ============================================================

    public function analisisShipper(Request $request)
{
    // === Filter Bar Chart ===
    $tahunBar = $request->tahun_bar ?? now()->year;
    $bulanBar = $request->bulan_bar ?? null;
    $shipperId = $request->shipper_id ?? 'all';

    $queryBar = ShipperProductionCC::selectRaw('bulan, SUM(produksi) as total')
        ->where('tahun', $tahunBar);

    if ($shipperId !== 'all') {
        $queryBar->where('shipper_id', $shipperId);
    }

    if ($bulanBar) {
        $queryBar->whereBetween('bulan', [1, $bulanBar]);
    }

    $produksiPriode = $queryBar->groupBy('bulan')->orderBy('bulan')->get();

    $dataPriode = [];
    for ($i = 1; $i <= ($bulanBar ?? 12); $i++) {
        $dataPriode[] = $produksiPriode->firstWhere('bulan', $i)->total ?? 0;
    }

    // === Filter Pie Chart ===
    $tahunPie = $request->tahun_pie ?? now()->year;
    $bulanPie = $request->bulan_pie ?? null;

    $queryPie = ShipperProductionCC::with('shipper')
        ->selectRaw('shipper_id, SUM(produksi) as total')
        ->where('tahun', $tahunPie);

    if ($bulanPie) {
        $queryPie->where('bulan', $bulanPie);
    }

    $kontribusi = $queryPie->groupBy('shipper_id')
        ->havingRaw('SUM(produksi) > 0')
        ->orderByDesc('total')
        ->get();

    $totalAllShippers = $kontribusi->sum('total');
    $topShippers = $kontribusi->take(5);

    // Dropdown
    $listTahun = ShipperProductionCC::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
    $listShipper = ShipperCC::orderBy('name')->get();

    return view('curahCair.analisis.shipper', compact(
        'tahunBar','bulanBar','shipperId','dataPriode',
        'tahunPie','bulanPie','kontribusi','topShippers','totalAllShippers',
        'listTahun','listShipper'
    ));
}


    // ============================================================
    // ANALISIS KOMODITAS
    // ============================================================

 public function analisisKomoditas(Request $request)
{
    // === Filter Bar Chart ===
    $tahunBar = $request->tahun_bar ?? now()->year;
    $bulanBar = $request->bulan_bar ?? null;
    $commodityId = $request->commodity_id ?? 'all';

    // Bar Chart Query
    $queryBar = CommodityProductionCC::selectRaw('bulan, SUM(produksi) as total')
        ->where('tahun', $tahunBar);

    if ($commodityId !== 'all') {
        $queryBar->where('commodity_id', $commodityId);
    }

    if ($bulanBar) {
        $queryBar->whereBetween('bulan', [1, $bulanBar]);
    }

    $produksiPriode = $queryBar->groupBy('bulan')->orderBy('bulan')->get();

    $dataPriode = [];
    for ($i = 1; $i <= ($bulanBar ?? 12); $i++) {
        $dataPriode[] = $produksiPriode->firstWhere('bulan', $i)->total ?? 0;
    }

    // === Filter Pie Chart ===
    $tahunPie = $request->tahun_pie ?? now()->year;
    $bulanPie = $request->bulan_pie ?? null;

    $queryPie = CommodityProductionCC::with('commodity')
        ->selectRaw('commodity_id, SUM(produksi) as total')
        ->where('tahun', $tahunPie);

    if ($bulanPie) {
        $queryPie->where('bulan', $bulanPie);
    }

    $kontribusi = $queryPie->groupBy('commodity_id')
        ->havingRaw('SUM(produksi) > 0')
        ->orderByDesc('total')
        ->get();

    $totalAllKomoditas = $kontribusi->sum('total');
    $topKomoditas = $kontribusi->take(5);

    // Dropdown
    $listTahun = CommodityProductionCC::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
    $listKomoditas = CommodityCC::orderBy('name')->get();

    return view('curahCair.analisis.komoditas', compact(
        'tahunBar','bulanBar','commodityId','dataPriode',
        'tahunPie','bulanPie','kontribusi','topKomoditas','totalAllKomoditas',
        'listTahun','listKomoditas'
    ));
}


}
