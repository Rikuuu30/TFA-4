<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        $featuredProducts = [
            ['rank' => '01', 'name' => 'Apex 12 oz Training Gloves', 'sku' => 'BOX-GLV-120', 'category' => 'Boxing', 'price' => '₱2,450', 'stock' => 18, 'sold' => 14],
            ['rank' => '02', 'name' => 'Tatami Core BJJ Gi', 'sku' => 'BJJ-GI-014', 'category' => 'Grappling', 'price' => '₱4,890', 'stock' => 9, 'sold' => 11],
            ['rank' => '03', 'name' => 'ProFlex Hand Wraps 4.5 m', 'sku' => 'BOX-WRP-045', 'category' => 'Accessories', 'price' => '₱420', 'stock' => 34, 'sold' => 9],
            ['rank' => '04', 'name' => 'WTF-Style Reversible Chest Guard', 'sku' => 'TKD-GRD-203', 'category' => 'Protection', 'price' => '₱3,250', 'stock' => 12, 'sold' => 7],
        ];

        $recentTransactions = [
            ['receipt' => 'KS-1048', 'customer' => 'Jian Pineda', 'items' => 'Gloves, wraps', 'method' => 'GCash', 'time' => '2:42 PM', 'total' => '₱2,870'],
            ['receipt' => 'KS-1047', 'customer' => 'Tristan Jamito', 'items' => 'BJJ gi', 'method' => 'Card', 'time' => '1:18 PM', 'total' => '₱4,890'],
            ['receipt' => 'KS-1046', 'customer' => 'Walk-in customer', 'items' => 'Mouthguard, tape', 'method' => 'Cash', 'time' => '12:31 PM', 'total' => '₱680'],
            ['receipt' => 'KS-1045', 'customer' => 'Angelo Josh', 'items' => 'Karate kumite belt', 'method' => 'GCash', 'time' => '11:56 AM', 'total' => '₱790'],
            ['receipt' => 'KS-1044', 'customer' => 'Sean Kacey', 'items' => 'Foot protector', 'method' => 'Card', 'time' => '10:24 AM', 'total' => '₱1,850'],
        ];

        $stockAlerts = [
            ['name' => 'Youth Red Sparring Headguard', 'sku' => 'KRT-HDG-YRD', 'remaining' => 2, 'level' => 'critical'],
            ['name' => 'BJJ White Belt A2', 'sku' => 'BJJ-BLT-WA2', 'remaining' => 3, 'level' => 'critical'],
            ['name' => 'Muay Thai Ankle Supports', 'sku' => 'MT-ANK-001', 'remaining' => 5, 'level' => 'low'],
            ['name' => 'Double-Weave Judo Gi A3', 'sku' => 'JDO-GI-203', 'remaining' => 6, 'level' => 'low'],
        ];

        return view('pages/home', [
            'pageTitle'          => 'Store Dashboard',
            'activePage'         => 'home',
            'featuredProducts'   => $featuredProducts,
            'recentTransactions' => $recentTransactions,
            'stockAlerts'        => $stockAlerts,
        ]);
    }

    public function about(): string
    {
        return view('pages/about', [
            'pageTitle'  => 'About',
            'activePage' => 'about',
        ]);
    }
}
