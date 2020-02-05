<?php
class ControllerCommonCart extends Controller {
    public function index() {
        $this->load->language('common/cart');

        $products = $this->cart->getProducts();
        foreach ( $products as $key => $product )
            $products[$key]['price'] = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
        $data['products'] = $products;
        $data['cart_total'] = $this->currency->format($this->cart->getSubTotal(), $this->session->data['currency']);
        $data['count'] = $this->cart->countProducts();

        $data['cart'] = $this->url->link('checkout/cart');

        return $this->load->view('common/cart', $data);
    }

    public function info() {
        $this->response->setOutput($this->index());
    }
}
