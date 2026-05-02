<?php

namespace App\Http\Controllers;

use App\Repositories\ItemDbRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemDbController extends Controller
{
    public function __construct(private readonly ItemDbRepository $items) {}

    public function route(Request $request, string $any): View
    {
        $obj = $request->query('obj');
        if ($obj === null && preg_match('/viewitem(?:\.ws)?\/?(\d+)?/', $any, $m) && isset($m[1]) && $m[1] !== '') {
            $obj = $m[1];
        }

        if ($obj !== null && $obj !== '' && str_starts_with($any, 'viewitem')) {
            $item = $this->items->find((int) $obj);
            abort_unless($item !== null, 404);

            return view('services.itemdb.item', ['item' => $item]);
        }

        $q = (string) $request->query('query', $request->query('q', ''));
        $results = $q === '' ? collect() : $this->items->search($q);

        return view('services.itemdb.search', [
            'q' => $q,
            'results' => $results,
            'categories' => $this->items->categories(),
        ]);
    }
}
