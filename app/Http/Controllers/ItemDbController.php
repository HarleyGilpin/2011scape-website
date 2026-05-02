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
        if (preg_match('/viewitem(?:\.ws)?.*?obj=(\d+)/', $any, $m)) {
            $item = $this->items->find((int) $m[1]);
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
