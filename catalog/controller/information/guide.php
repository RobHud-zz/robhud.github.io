<?php
class ControllerInformationGuide extends Controller {
	public function index() {
		$this->load->language('information/guide');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['deliveries'] = array();

        $results = $this->config->get('config_deliveries')[$this->config->get('config_language_id')];

        foreach ($results as $result) {
            $data['deliveries'][] = array(
                'title' => utf8_strtoupper($result['price']),
                'subtitle' => '(' . $result['subtitle'] . ')',
                'description' => $result['addresses']
            );
        }

        $data['payments'] = array(
            array('title' => utf8_strtoupper('наличными'), 'description' => $this->config->get('config_cash'), 'icon' => '#cash')
        );

        $data['kits'] = array(
            array('icon' => '#palochki', 'description' => $this->config->get('config_sticks')),
            array('icon' => '#sous', 'description' => $this->config->get('config_soy')),
            array('icon' => '#imbir', 'description' => $this->config->get('config_ginger')),
            array('icon' => '#vassabi', 'description' => $this->config->get('config_wasabi')),
            array('icon' => '#servetki', 'description' => $this->config->get('config_napkins')),
            array('icon' => '#surprise', 'description' => $this->config->get('config_surprise')),
        );

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['theme_url'] = '/catalog/view/theme/sushi';

		$this->response->setOutput($this->load->view('information/guide', $data));
	}
}
