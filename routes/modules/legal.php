<?php

use Illuminate\Support\Facades\Route;

Route::view('/terms', 'legal.terms.terms')->name('terms');
Route::get('/terms/{slug}', function (string $slug) {
    $view = 'legal.terms.'.str_replace('-', '_', $slug);
    abort_unless(view()->exists($view), 404);
    return view($view);
})->where('slug', '[A-Za-z0-9_\-]+')->name('terms.show');

Route::view('/privacy', 'legal.privacy.privacy')->name('privacy');

Route::get('/rules', function () {
    return view('legal.rules.index', [
        'rules' => collect([
            'rule_account_sharing', 'rule_advert_blocking', 'rule_advertising_websites',
            'rule_bug_exploitation', 'rule_encouraging_rule_breaking', 'rule_forum_misuse',
            'rule_inappropriate_language', 'rule_multiple_logging', 'rule_password_scamming',
            'rule_personal_information', 'rule_real_world_trading', 'rule_staff_impersonation',
            'rule_third_party_software',
        ])->map(fn ($slug) => [
            'slug' => str_replace('rule_', '', $slug),
            'view' => 'legal.rules.'.$slug,
            'title' => str_replace('_', ' ', ucwords(substr($slug, 5), '_')),
        ]),
    ]);
})->name('rules');

Route::get('/rules/{slug}', function (string $slug) {
    $view = 'legal.rules.rule_'.str_replace('-', '_', $slug);
    abort_unless(view()->exists($view), 404);
    return view($view);
})->where('slug', '[A-Za-z0-9_\-]+')->name('rules.show');
