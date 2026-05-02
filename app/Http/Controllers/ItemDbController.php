<?php

namespace App\Http\Controllers;

use App\Repositories\ItemDbRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemDbController extends Controller
{
    public function __construct(private readonly ItemDbRepository $items) {}

    public function search(Request $request): View
    {
        $q = (string) $request->query('query', $request->query('q', ''));
        $results = $q === '' ? collect() : $this->items->search($q);

        return view('services.itemdb.search', [
            'q' => $q,
            'results' => $results,
            'categories' => $this->items->categories(),
        ]);
    }

    public function view(int $id): View
    {
        $item = $this->items->find($id);
        abort_unless($item !== null, 404);

        return view('services.itemdb.item', ['item' => $item]);
    }
}
