<?php

use Predis\Client;

class Product
{

    private $db;
    private $redis;

    public function __construct()
    {
        $this->db = new Database();
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
        ]);
    }

    public function getProduct()
    {
        $products = $this->redis->get('products');
        if ($products === false) {
            try {
                $this->db->query('SELECT * FROM products ORDER BY created_at DESC');
                $this->db->execute();
                $products = $this->db->fetchAll();

                $this->redis->set('products', json_encode($products));
            } catch (Exception $e) {
                error_log('Error fetching database: ' . $e->getMessage());
                return [];
            }
        } else {
            $products = json_decode($products);
        }
        return $products;

    }


    public function add($data)
    {

        $this->db->query('INSERT INTO products ( name, price , discount,amount ,image,code) VALUES (:name , :price ,:discount,:amount,:image,:code)');
        // Bind value
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':discount', $data['discount']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':code', $data['code']);


        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function show($id)
    {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->fetch();
        return $row;
    }


    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM products WHERE id = :id');

        $this->db->bind(':id', $id);
        $row = $this->db->fetch();
        return $row;
    }

    public function getUserProductById($id, $phone)
    {
        $this->db->query('SELECT * FROM orders INNER JOIN products ON orders.code = products.code WHERE products.id = :id AND orders.phone LIKE :phone AND products.discount = 1');


        $this->db->bind(':id', $id);
        $this->db->bind(':phone', $phone);
        $row = $this->db->fetch();
        return $row;
    }

    public function update($data)
    {

        $this->db->query('UPDATE products SET name = :name , price = :price,discount = :discount,amount = :amount,image = :image,code = :code  WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':discount', $data['discount']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':code', $data['code']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function counter($id)
    {
        $this->db->query('UPDATE products SET amount = amount-1   WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM products WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //sort product

    public function sort($sort)
    {
        switch ($sort) {
            case 'new':
                $orderBy = 'ORDER BY created_at DESC';
                break;
            case 'old':
                $orderBy = 'ORDER BY created_at ASC';
                break;
            case 'min':
                $orderBy = 'ORDER BY price ASC';
                break;
            case 'max':
                $orderBy = 'ORDER BY price DESC';
                break;
            case 'name':
                $orderBy = 'ORDER BY name ASC';
                break;
            default:
                $orderBy = 'ORDER BY created_at DESC';
        }


        $this->db->query('SELECT * FROM products ' . $orderBy);
        $this->db->execute();
        return $this->db->fetchAll();
    }

}
