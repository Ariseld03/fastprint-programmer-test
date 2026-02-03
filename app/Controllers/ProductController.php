<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Product;
use App\Models\Category;
use App\Services\FastprintAPI;

class ProductController extends BaseController
{
   protected $modelProduct;
   protected $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelCategory = new Category();
    }

    public function index()
    {
        $api = new FastprintAPI();
        $apiDebug=$api->fetch();
        return view('product/index', [
            'produk' => $this->modelProduct->enableToSellOnly(),
            'apiDebug' => $apiDebug
        ]);
    }

    public function create()
    {
         return view('product/create', [
            'kategori' => $this->modelCategory->findAll()
        ]);
    }

    public function store()
    {
        $rules = [
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|integer'
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->route('produk.create')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->modelProduct->insert([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'status_id'   => 1 // Bisa Dijual
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
   }

    public function edit($id)
    {
        return view('product/edit', [
            'produk'   => $this->modelProduct->find($id),
            'kategori' => $this->modelCategory->findAll()
        ]);
    }

    public function update($id)
    {
        $rules = [
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|integer'
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->route('produk.edit', [$id])
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->modelProduct->update($id, [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'kategori_id' => $this->request->getPost('kategori_id'),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
  }

    public function delete($id)
    {
        $this->modelProduct->delete($id);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

}
