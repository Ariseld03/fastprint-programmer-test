<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\FastprintAPI;
use App\Models\Product;
use App\Models\Category;
use App\Models\Status;

class FastPrint extends BaseController
{
    public function index()
    {
        $api = new FastprintAPI();
        $productModel= new Product();
        $categoryModel= new Category();
        $statusModel= new Status();
        $response = $api->fetch();
        $insert=[];
        foreach($response['body']['data'] as $product){             
            $kategoriId=$categoryModel->getOrCreateIdByName($product['kategori']);
            $statusId=$statusModel->getOrCreateIdByName($product['status']);
            
            $insert[]=[
                'id_produk'=>$product['id_produk'],
                'nama_produk'=>$product['nama_produk'],
                'harga'=>(double)$product['harga'],
                'kategori_id'=>$kategoriId,
                'status_id'=>$statusId,
            ];
            return $this->response->setJSON($insert);   
        }
        $productModel->insertBatch($insert);
    }
}
