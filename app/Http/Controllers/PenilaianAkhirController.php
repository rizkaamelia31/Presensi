// app/Http/Controllers/PenilaianAkhirController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianAkhir;

class PenilaianAkhirController extends Controller
{
    public function create()
    {
        return view('penilaian_akhir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria1' => 'required|numeric|min:0|max:100',
            'criteria2' => 'required|numeric|min:0|max:100',
            'criteria3' => 'required|numeric|min:0|max:100',
            'criteria4' => 'required|numeric|min:0|max:100',
            'criteria5' => 'required|numeric|min:0|max:100',
            'criteria6' => 'required|numeric|min:0|max:100',
            'criteria7' => 'required|numeric|min:0|max:100',
        ]);

        $total = $request->criteria1 + $request->criteria2 + $request->criteria3 + $request->criteria4 + $request->criteria5 + $request->criteria6 + $request->criteria7;

        if ($total != 100) {
            return back()->withErrors(['total' => 'Total bobot harus 100%.']);
        }

        PenilaianAkhir::create([
            'user_id' => auth()->id(),
            'criteria1' => $request->criteria1,
            'criteria2' => $request->criteria2,
            'criteria3' => $request->criteria3,
            'criteria4' => $request->criteria4,
            'criteria5' => $request->criteria5,
            'criteria6' => $request->criteria6,
            'criteria7' => $request->criteria7,
        ]);

        return redirect()->route('penilaian_akhir.index')->with('success', 'Bobot penilaian berhasil disimpan.');
    }
}
