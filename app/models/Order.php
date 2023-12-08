<?php
use Predis\Client;
class Order{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
        ]);
    }

    public function getOrder()
    {
        $orders = $this->redis->get('orders');

        if ($orders === false) {
            try {
                $this->db->query('SELECT * FROM orders');
                $this->db->execute();
                $orders= $this->db->fetchAll();
                $this->redis->set('orders', json_encode($orders));
            } catch (Exception $e) {
                error_log('Error fetching database: ' . $e->getMessage());
                return [];
            }
        } else {
            $orders = json_decode($orders);
        }
        return $orders;
    }

    public function add($data){
        $this->db->query('INSERT INTO orders ( code , price,phone ) VALUES ( :code ,:price,:phone)');
        // Bind value
        $this->db->bind(':code',$data['code']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':phone',$data['phone']);


        // Execute
        if( $this->db->execute() ){
            return true;
        }else{
            return false;
        }
    }
}
