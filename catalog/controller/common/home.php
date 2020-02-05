<?php
class ControllerCommonHome extends Controller {
	static $cat_rolly = 59;
	static $cat_pizza = 68;
	static $cat_noodles = 71;
	static $banner_rolly = 10;
	static $banner_pizza = 11;

	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('design/banner');

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['theme_url'] = '/catalog/view/theme/sushi';

		$data['main_rolly'] =$this->filterByTagMain(self::$cat_rolly);
		$data['main_pizzas'] = $this->filterByTagMain(self::$cat_pizza);
		$data['main_noodles'] = $this->filterByTagMain(self::$cat_noodles);

		$data['link_rolly'] = $this->url->link('product/category', 'path='.self::$cat_rolly);
		$data['link_pizza'] = $this->url->link('product/category', 'path='.self::$cat_pizza);
		$data['link_noodles'] = $this->url->link('product/category', 'path='.self::$cat_noodles);;

		//banners
		$data['bannerRolly'] = $this->model_design_banner->getBanner(self::$banner_rolly);
		$data['bannerPizza'] = $this->model_design_banner->getBanner(self::$banner_pizza);

		$data['deliveries'] = array();

		$results = $this->config->get('config_deliveries')[$this->config->get('config_language_id')];

		foreach ($results as $result) {
            $data['deliveries'][] = array(
                'title' => $result['price'] . ' (' . $result['subtitle'] . '):',
                'description' => $result['addresses']
            );
        }

		$data['payments'] = array(
		    array('title' => 'наличными:', 'description' => $this->config->get('config_cash'))
        );

        $data['kits'] = array(
            array('title' => 'палочки', 'description' => $this->config->get('config_sticks_home'), 'view' => $this->config->get('config_sticks_ishome')),
            array('title' => 'соевый соус', 'description' => $this->config->get('config_soy_home'), 'view' => $this->config->get('config_soy_ishome')),
            array('title' => 'имбирь', 'description' => $this->config->get('config_ginger_home'), 'view' => $this->config->get('config_ginger_ishome')),
            array('title' => 'вассаби', 'description' => $this->config->get('config_wasabi_home'), 'view' => $this->config->get('config_wasabi_ishome')),
            array('title' => 'салфетки', 'description' => $this->config->get('config_napkins_home'), 'view' => $this->config->get('config_napkins_ishome')),
            array('title' => 'сюрприз', 'description' => $this->config->get('config_surprise_home'), 'view' => $this->config->get('config_surprise_ishome')),
        );

		$this->response->setOutput($this->load->view('common/home', $data));
	}

	private function filterByTagMain($category_id){
		$elements = $this->model_catalog_product->getProducts(array(
			'filter_category_id' => $category_id
		));

		$result = array();

		foreach ($elements as $item) :
			$url = $this->url->link('product/product', 'product_id=' . $item['product_id']);
			$item['href'] = $url;

			$tags = array_map('trim', explode(',', $item['tag']));
			if (in_array('main', $tags)) {
                if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($item['price'], $item['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $price = false;
                }

                if ((float)$item['special']) {
                    $special = $this->currency->format($this->tax->calculate($item['special'], $item['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $special = false;
                }

                if ((float)$item['special']) {
                    $special_percent = '-' . (int)ceil( ($item['price'] - $item['special']) / $item['price'] * 100 ) . '%';
                } else {
                    $special_percent = false;
                }

                $item['price'] = $price;
                $item['special_percent'] = $special_percent;
                $item['special'] = $special;

			    array_push($result, $item);
			}
		endforeach;

		return $result;
	}
}
